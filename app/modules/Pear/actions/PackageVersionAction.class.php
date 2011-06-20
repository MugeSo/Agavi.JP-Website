<?php

class Pear_PackageVersionAction extends AgaviJpWebPearBaseAction
{
	public function executeRead(AgaviRequestDataHolder $rd)
	{
		$channel = $this->getContext()->getModel('Channel', 'Pear');
		$channel->setServer($rd->getParameter('server'));
		$this->setAttribute('version', $channel->getVersion($rd->getParameter('package')));
		return 'Success';
	}
}

?>