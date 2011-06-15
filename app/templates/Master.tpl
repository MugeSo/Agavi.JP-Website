<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<base href="{$ro->getBaseHref()}" />
		<title>{if isset($t._title)}{$t._title} - {/if}{AgaviConfig::get('core.app_name')}</title>
		
		<link rel="stylesheet" type="text/css" href="css/global.css" />
{foreach $rq->getAttribute('stylesheets', null, array())|array_unique AS $src}
		<link rel="stylesheet" type="text/css" href="{$src}" />
{/foreach}
	</head>
	<body>
	<div id="header">
		<div id="sitename"><a href=""><img src="images/logo.png" alt="Agavi.jp" width="109" height="24"/></a></div>
    </div>
    <div id="content">
		{if isset($t._title)}<h1>{$t._title}</h1>{/if}
		{$inner}
    </div>
    <div id="footer">
		<p id="footer-copyright">&copy;2011 agavi.jp.</p>
	</div>
	</body>
</html>
