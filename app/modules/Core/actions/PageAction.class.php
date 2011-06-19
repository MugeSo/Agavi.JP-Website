<?php

class Core_PageAction extends AgaviJpWebCoreBaseAction
{
	public function executeRead(AgaviRequestDataHolder $rd)
	{
		$reader = $this->getContext()->getModel('PageReader', 'Core');
		$reader->open($rd->getParameter('page_name'));
		$this->setAttribute('reader', $reader);
		return 'Success';
	}
}

?>