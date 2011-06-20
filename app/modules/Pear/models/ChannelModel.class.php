<?php

class Pear_ChannelModel extends AgaviJpWebPearBaseModel
{
	protected $server;
	
	public function setServer($server)
	{
		$this->server = $server;
	}
	
	public function getVersion($package)
	{
		$latest = $this->getLatest($package);
		$stable = $this->getStable($package);
		
		if(version_compare($latest, $stable, '==')) {
			return array(
				'stable'=>$stable,
				'development'=>null
			);
		}
		
		return array(
				'stable'=>$stable,
				'development'=>$latest			
		);
	}
	
	public function getStable($package)
	{
		return file_get_contents('http://' . $this->server . '/rest/r/' . $package .'/stable.txt');
	}
	
	public function getLatest($package)
	{
		return file_get_contents('http://' . $this->server . '/rest/r/' . $package .'/latest.txt');
	}
}

?>