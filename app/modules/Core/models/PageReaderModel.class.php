<?php

class Core_PageReaderModel extends AgaviJpWebCoreBaseModel
{

	protected $filePath;
	protected $layout;
	protected $renderer;
	protected $slots;
	protected $responseAttributes;

	/**
	 * 名前で指定されたページを開く
	 * 
	 * @param string $name 
	 */
	public function open($name)
	{
		$name = '/' . trim($name, '/ ');

		return include AgaviConfigCache::checkConfig(AgaviConfig::get('modules.core.pages_config'));
	}

	/**
	 * ページファイルのパスを取得
	 * 
	 * @return string
	 */
	public function getFilePath()
	{
		return $this->filePath;
	}

	/**
	 * レイアウトを取得
	 * 
	 * @return string
	 */
	public function getLayout()
	{
		return $this->layout;
	}

	/**
	 * レンダラを取得
	 * 
	 * @return string
	 */
	public function getRenderer()
	{
		return $this->renderer;
	}
	
	/**
	 * レスポンス属性を取得
	 * 
	 * @return array
	 */
	public function getResponseAttributes()
	{
		return $this->responseAttributes;
	}
	
	/**
	 * スロットを取得
	 * 
	 * @return array
	 */
	public function getSlots()
	{
		return $this->slots;
	}

}

?>