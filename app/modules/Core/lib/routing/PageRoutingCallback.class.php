<?php
/**
 * Core_PageRoutingCallback
 * 
 * @author TANAKA Koichi <mugeso@mugeso.com>
 */
class Core_PageRoutingCallback extends AgaviRoutingCallback
{
	public function onMatched(array &$parameters, AgaviExecutionContainer $container)
	{
		$page_name_parameter = $this->getParameter('page_name_parameter', 'page_name');
		if(!isset($parameters[$page_name_parameter])) {
			$error = 'Routing parameter does not contains key "%s" specified as page_name_parameter of routing callback "%s".';
			$error = sprintf($error, $page_name_parameter, __CLASS__);
			throw new AgaviConfigurationException($error);
		}
		
		$reader = $this->getContext()->getModel('PageReader', 'Core');
		return $reader->open($parameters[$page_name_parameter]);
	}
}
?>
