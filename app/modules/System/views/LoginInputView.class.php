<?php

class System_LoginInputView extends AgaviJpWebSystemBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Login');
	}
}

?>