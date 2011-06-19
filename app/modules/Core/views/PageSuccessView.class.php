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
		
		foreach ($reader->getSlots() as $name => $slot) {
			$layer->setSlot($name, $this->createSlotContainer($slot['module'], $slot['action'], $slot['arguments'], $slot['output_type'], $slot['request_method']));
		}
		
		// TODO: agavi-1.1 以降では responseのattributeにセットする
		$attributes = &$this->getContext()->getRequest()->getAttributeNamespace();
		$attributes = array_merge_recursive((array)$attributes, (array)$reader->getResponseAttributes());
		$this->getContext()->getRequest()->setAttributes($attributes);
	}

}

?>