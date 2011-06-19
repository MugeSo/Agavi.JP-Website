<?php
class Core_PageFlowTest extends AgaviFlowTestCase
{
	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
		$this->actionName = 'Page';
		$this->moduleName = 'Core';
	}
	
	/**
	 *
	 * @dataProvider validPageNameProvider
	 */
	public function testExecuteHtml($name, $expectedFile)
	{
		AgaviConfigCache::addConfigHandlersFile(AgaviConfig::get('core.testing_dir') . '/fixtures/config/core_pagesconfighandler_config_handlers.xml');
		AgaviConfig::set('modules.core.pages_config', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/config/pages.xml'), true, true);

		$this->input = $name;
		try {
			$this->dispatch(array('page_name'=>$name));
		} catch(Exception $e) {
			$this->fail($e->getMessage() . "\n" . $e->getTraceAsString());
		}
		$this->assertStringEqualsFile($expectedFile, $this->response->getContent());
	}
	
	public function validPageNameProvider()
	{
		return array(
			array('/', AgaviToolkit::expandDirectives('%core.testing_dir%/expected/outputs/main.html')),
			array('/other', AgaviToolkit::expandDirectives('%core.testing_dir%/expected/outputs/other.html')),
			array('/bbs/logs', AgaviToolkit::expandDirectives('%core.testing_dir%/expected/outputs/bbs-logs.html'))
		);
	}
	
	public function tearDown()
	{
		AgaviConfigCache::clear();
	}
}
?>
