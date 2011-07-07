<?php

class HatenaSyntaxRenderer extends AgaviRenderer
{
	
	/**
	 * Create an HatenaSyntax instance.
	 * 
	 * @return HatenaSyntax
	 */
	protected function createEngineInstance()
	{
		if(!class_exists('HatenaSyntax')) {
			$fp = @fopen('HatenaSyntax.php', 'r', true);
			if(!$fp) {
				$error = sprintf('%s requires openpear/HatenaSyntax.', __CLASS__);
				throw new AgaviRenderException($error);
			}
			fclose($fp);
			include_once('HatenaSyntax.php');
		}
		
		return new HatenaSyntax();
	}
	
	/**
	 * Render the presentation and return the result.
	 *
	 * @param      AgaviTemplateLayer The template layer to render.
	 * @param      array              The template variables. ignored.
	 * @param      array              The slots. ignored.
	 * @param      array              Associative array of additional assigns.
	 *
	 * @return     string A rendered result.
	 *
	 * @author     TANAKA Koichi <mugeso@mugeso.com>
	 */
	public function render(AgaviTemplateLayer $layer, array &$attributes = array(), array &$slots = array(), array &$moreAssigns = array())
	{
		$hatenaSyntax = $this->createEngineInstance();
		
		$config = $this->getParameter('config', array());
		return $hatenaSyntax->render(file_get_contents($layer->getResourceStreamIdentifier()), $config);
	}
}
?>
