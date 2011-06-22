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
			<div id="social-buttons">
				<iframe src="http://www.facebook.com/plugins/like.php?app_id=123028561116892&amp;href={$ro->gen(null, [], ['relative'=>false])|rawurlencode}&amp;send=false&amp;layout=button_count&amp;width=110&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:21px;" allowTransparency="true"></iframe>
				<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-lang="ja">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
				<a href="http://b.hatena.ne.jp/entry/{$ro->gen(null,[], ['relative'=>false])}" class="hatena-bookmark-button" data-hatena-bookmark-layout="standard" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
			</div>
			<p id="footer-copyright">&copy;{AgaviConfig::get('core.copyright')}</p>
		</div>
	</body>
</html>
