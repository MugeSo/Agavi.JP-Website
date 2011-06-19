<?php

class Core_PageSuccessView extends AgaviJpWebCoreBaseView
{

	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$reader = $this->getAttribute('reader');
		/* @var $reader Core_PageReaderModel */

		$this->setupHtml($rd, $reader->getLayout());

		$layer = current($this->getLayers());
		
		/* @var $layer AgaviTemplateLayer */
		$layer->setRenderer($this->getContainer()->getOutputType()->getRenderer($reader->getRenderer()));
		
		$layer->setParameter('targets', array('${directory}/${template}'));
		$layer->setParameter('template', $reader->getFilePath());
		
		// TODO: agavi-1.1 以降では responseのattributeにセットする
		$attributes = &$this->getContext()->getRequest()->getAttributeNamespace();
		$attributes = array_merge_recursive((array)$attributes, (array)$reader->getResponseAttributes());
		$this->getContext()->getRequest()->setAttributes($attributes);
	}

}

?>