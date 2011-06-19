<?php

/**
 * 
 *
 * @author Koichi
 */
class PageReaderModelTest extends AgaviModelTestCase
{

	/**
	 *
	 * @group specification
	 * 
	 * @covers Core_PageReaderModel::open
	 * @covers Core_PageReaderModel::getFilePath
	 * @covers Core_PageReaderModel::getLayout
	 * @covers Core_PageReaderModel::getRenderer
	 * @covers Core_PageReaderModel::getResponseAttributes
	 * 
	 * @dataProvider validNameProvider  
	 */
	public function testValidName($name, $filepath, $layout, $renderer, $responseAttrs)
	{
		$reader = $this->getContext()->getModel('PageReader', 'Core');
		/* @var $reader Core_PageReaderModel */

		AgaviConfigCache::addConfigHandlersFile(AgaviConfig::get('core.testing_dir') . '/fixtures/config/core_pagesconfighandler_config_handlers.xml');
		AgaviConfig::set('modules.core.pages_config', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/config/pages.xml'));

		
		$this->assertTrue($reader->open($name));
		$this->assertEquals($filepath, $reader->getFilePath());
		$this->assertEquals($layout, $reader->getLayout());
		$this->assertEquals($renderer, $reader->getRenderer());
		$this->assertEquals($responseAttrs, $reader->getResponseAttributes());
	}
	
	public function validNameProvider()
	{
		return array(
			array('/', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/pages/main.tpl'), null, null, array('stylesheets'=>array('css/main.css'))),
			array('other', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/pages/other.tpl'), 'simple', null, null),
			array('/bbs/logs/', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/pages/bbs-logs.php'), null, 'php', null)
		);
	}
	
	protected function tearDown()
	{
		AgaviConfigCache::clear();
	}
}

?>
