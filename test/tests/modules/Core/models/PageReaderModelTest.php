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
	public function testValidName($name, $filepath, $layout, $renderer, $responseAttrs, $slots)
	{
		$reader = $this->getContext()->getModel('PageReader', 'Core');
		/* @var $reader Core_PageReaderModel */

		AgaviConfigCache::addConfigHandlersFile(AgaviConfig::get('core.testing_dir') . '/fixtures/config/core_pagesconfighandler_config_handlers.xml');
		AgaviConfig::set('modules.core.pages_config', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/config/pages.xml'));

		
		$this->assertTrue($reader->open($name));
		$this->assertEquals($filepath, $reader->getFilePath());
		$this->assertEquals($layout, $reader->getLayout());
		$this->assertEquals($renderer, $reader->getRenderer());
		$this->assertEquals($slots, $reader->getSlots());
		$this->assertEquals($responseAttrs, $reader->getResponseAttributes());
	}
	
	public function validNameProvider()
	{
		$main_slots = array (
  'page' => 
  array (
    'module' => 'Core',
    'action' => 'Page',
    'output_type' => NULL,
    'request_method' => NULL,
    'arguments' => 
    array (
      'page_name' => '/other',
    ),
  ),
  'action' => 
  array (
    'module' => 'Core',
    'action' => 'Page',
    'output_type' => 'html',
    'request_method' => 'read',
    'arguments' => 
    array (
      'page_name' => '/bbs/logs',
    ),
  ),
);
		
		return array(
			array('/', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/pages/main.tpl'), null, null, array('stylesheets'=>array('css/main.css')), $main_slots),
			array('other', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/pages/other.tpl'), 'simple', null, null, array()),
			array('/bbs/logs/', AgaviToolkit::expandDirectives('%core.testing_dir%/fixtures/pages/bbs-logs.php'), null, 'php', null, array())
		);
	}
	
	protected function tearDown()
	{
		AgaviConfigCache::clear();
	}
}

?>
