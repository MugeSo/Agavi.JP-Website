<?php

/**
 * PageConfigHandler
 *
 * @author Koichi
 */
class Core_PageConfigHandler extends AgaviXmlConfigHandler
{
	const XML_NAMESPACE = 'http://agavi.jp/agavi/config/parts/pages/1.0';

	public function execute(AgaviXmlConfigDomDocument $document)
	{
		// set up our default namespace
		$document->setDefaultNamespace(self::XML_NAMESPACE, 'pages');

		$config = $document->documentURI;

		$pages = array();

		foreach ($document->getConfigurationElements() as $configuration) {
			if ($configuration->has('pages')) {
				foreach ($configuration->get('pages') as $page) {
					$name = '/' . trim($page->getAttribute('name'), '/ ');
					if (!isset($pages[$name])) {
						$pages[$name] = array(
							'layout' => null,
							'renderer' => null,
							'response_attributes' => null
						);
						if (!$page->hasAttribute('file')) {
							// the class path doesn't exist
							$error = 'Configuration file "%s" specifies page "%s" with missing filename';
							$error = sprintf($error, $document->documentURI, $name);

							throw new AgaviParseException($error);
						}
					}

					$slots = array();
					if($page->has('slots')) {
						foreach($page->get('slots') as $slot) {
							if($slot->hasAttribute('page')) {
								$slots[$slot->getAttribute('name')] = array(
									'module' => 'Core',
									'action' => 'Page',
									'output_type' => $slot->getAttribute('output_type'),
									'request_method' => $slot->getAttribute('method'),
									'arguments' => $slot->getAgaviParameters(array('page_name'=>$slot->getAttribute('page'))),
								);
							} else {
								$slots[$slot->getAttribute('name')] = array(
									'module' => $slot->getAttribute('module'),
									'action' => $slot->getAttribute('action'),
									'output_type' => $slot->getAttribute('output_type'),
									'request_method' => $slot->getAttribute('method'),
									'arguments' => $slot->getAgaviParameters(array()),
								);
							}
						}
					}
					
					if($page->hasAttribute('file'))		$pages[$name]['file'] = self::fixPath($page->getAttribute('file'), $name, $document->documentURI);
					if($page->hasAttribute('layout'))	$pages[$name]['layout'] = $page->getAttribute('layout');
					if($page->hasAttribute('renderer'))	$pages[$name]['renderer'] = $page->getAttribute('renderer');
					$pages[$name]['slots'] = $slots;
					if($page->hasChild('response_attributes')) $pages[$name]['response_attributes'] = $page->getChild('response_attributes')->getAgaviParameters();
				}
			}
		}
		
		$code = array();
		
		$code[] = 'switch($name){';
		foreach ($pages as $name => $page) {
			$code[] = sprintf('case %s:', var_export($name, true));
			$code[] = sprintf('$this->filePath = %s;', var_export($page['file'], true));
			$code[] = sprintf('$this->layout = %s;', var_export($page['layout'], true));
			$code[] = sprintf('$this->renderer = %s;', var_export($page['renderer'], true));
			$code[] = sprintf('$this->slots = %s;', var_export($page['slots'], true));
			$code[] = sprintf('$this->responseAttributes = %s;', var_export($page['response_attributes'], true));
			$code[] = 'break;';
		}
		$code[] = 'default:';
		$code[] = 'return false;';
		$code[] = '}';
		$code[] = 'return true;';

		return $this->generate($code);
	}

	protected static function fixPath($file, $name, $documentURI)
	{
		$file = AgaviToolkit::expandDirectives($file);

		$originalFile = $file;
		// if the filename is not absolute we assume its relative to the app dir
		$file = self::replacePath($file);

		if (!($fp = @fopen($file, 'r', true))) {
			if ($originalFile != $file && ($fpOriginal = @fopen($originalFile, 'r', true))) {
				$file = $originalFile;
				$fp = $fpOriginal;
			} else {
				// the class path doesn't exist
				$error = 'Configuration file "%s" specifies page "%s" with ' .
						'nonexistent or unreadable file "%s"';
				$error = sprintf($error, $documentURI, $name, $file);

				throw new AgaviParseException($error);
			}
		}
		fclose($fp);
		
		return $file;
	}

}

?>
