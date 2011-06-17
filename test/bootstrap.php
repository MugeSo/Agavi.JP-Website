<?php
$there = 'C:\php\pear\agavi';

set_include_path($there . PATH_SEPARATOR .
		realpath($there . '/testing') . PATH_SEPARATOR .
		get_include_path());

// load Agavi basics
require_once('agavi/agavi.php');

// AgaviTesting class
require_once('agavi/testing/AgaviTesting.class.php');

// load config
require_once realpath(__DIR__ . '/../app/config.php');

AgaviConfig::set('core.testing_dir', realpath(__DIR__));
AgaviConfig::set('core.default_context', 'console');

AgaviTesting::bootstrap('testing');
?>
