<?php
require_once AgaviToolkit::expandDirectives('%core.module_dir%/Core/lib/routing/PageRoutingCallback.class.php');
class Core_PageRoutingCallbackTest extends AgaviUnitTestCase
{
	public function testOnMatched()
	{
		$this->getContext()->getModel('PageReader', 'Core');
		/* @var $reader Core_PageReaderModel */

		AgaviConfigCache::addConfigHandlersFile(AgaviConfig::get('core.testing_dir') . '/fixtures/config/core_pagesconfighandler_config_handlers.xml');
		AgaviConfig::set('modules.core.pages_config', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/config/pages.xml'));
		
		$route = array();
		$callback = new Core_PageRoutingCallback();
		$callback->initialize($this->getContext(), $route);
		
		$parameters = array(
			'page_name'=>'/'
		);
		
		$this->assertTrue($callback->onMatched($parameters, new AgaviExecutionContainer()));
		
	}
	
	public function testNotMatchedPageName()
	{
		$this->getContext()->getModel('PageReader', 'Core');
		/* @var $reader Core_PageReaderModel */

		AgaviConfigCache::addConfigHandlersFile(AgaviConfig::get('core.testing_dir') . '/fixtures/config/core_pagesconfighandler_config_handlers.xml');
		AgaviConfig::set('modules.core.pages_config', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/config/pages.xml'));
		
		$route = array();
		$callback = new Core_PageRoutingCallback();
		$callback->initialize($this->getContext(), $route);
		
		$parameters = array(
			'page_name'=>'unknown'
		);
		
		$this->assertFalse($callback->onMatched($parameters, new AgaviExecutionContainer()));
	}
	
	/**
	 * 
	 * @expectedException AgaviConfigurationException
	 */
	public function testPageNameParameterMissmatch()
	{
		$this->getContext()->getModel('PageReader', 'Core');
		/* @var $reader Core_PageReaderModel */

		AgaviConfigCache::addConfigHandlersFile(AgaviConfig::get('core.testing_dir') . '/fixtures/config/core_pagesconfighandler_config_handlers.xml');
		AgaviConfig::set('modules.core.pages_config', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/config/pages.xml'));
		
		$route = array();
		$callback = new Core_PageRoutingCallback();
		$callback->initialize($this->getContext(), $route);
		
		$parameters = array();
		
		$callback->onMatched($parameters, new AgaviExecutionContainer());
	}
}
?>
