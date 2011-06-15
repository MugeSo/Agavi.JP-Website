<?php

class Core_IndexSuccessView extends AgaviJpWebCoreBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);
		$this->getContext()->getRequest()->appendAttribute('stylesheets', 'css/main.css');
	}
}

?>