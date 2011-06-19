<h1><img src="images/main_title.png" width="900" height="229" alt="Agavi日本語情報サイト" /></h1>
<dl id="latest_release">
	<dt>安定版</dt>
	<dd>1.0.5</dd>
	<dt>開発版</dt>
	<dd>-</dd>
</dl>
<div id="main_introduction">
<p>このサイトはPHPアプリケーションフレームワーク<a href="http://www.agavi.org/" title="Agavi本家サイト">Agavi</a>の日本語情報サイトです。</p>
</div>
<div class="article">
	<h2>はじめる</h2>
	<p>次のコマンドを実行するだけでagaviがインストールされます。</p>
	<code>
$pear channel-discover pear.agavi.org
$pear config-set auto_discover 1
$pear install -a agavi/agavi
	</code>
</div>

<div class="article">
	<h2>このサイトの実装</h2>
	<p>このサイト自体もAgaviで実装されています。<a href="https://github.com/MugeSo/Agavi.JP-Website">ソースコード</a>はgitubで公開していますので参考にしてください。</p>
	<p>現在はCMSぽい機能を実装中です。</p>
	<h3>CMSの実装方法</h3>
	<p>CMSのキモとなる静的ページを処理するPageアクションをCoreモジュールに実装しています。</p>
	<p>静的ページは%core.config_dir%/pages.xmlで管理されており、Pageアクションではこの設定ファイルをCoreモジュールのPageReaderモデル経由で読み込んでいます。</p>
	<p>読み込みが成功するとPageSuccessビューに処理が移り、設定に基づいてレイアウトやレンダラを選択してテンプレートをレンダリングします。</p>
	<p>pages.xmlおよびテンプレートの編集機能は未実装です。</p>
</div>
