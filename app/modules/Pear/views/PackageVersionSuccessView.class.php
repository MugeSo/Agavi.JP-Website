<?php

class Pear_PackageVersionSuccessView extends AgaviJpWebPearBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);
		
		$this->setAttribute('_title', 'PackageVersion');
	}
}

?>