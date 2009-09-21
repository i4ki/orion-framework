<?php

class Exception_Admin_PageNotFound 
	extends OrionException_PageNotFound
{
	public function __construct($msg = '', $code = 0)
	{
		if(Orion::getAttribute(Orion::ATTR_ENV) == Orion::ATTR_ENV_DEV)
		{
			parent::__construct($msg, $code);
		} else
			$this->page404();
	}
	
	public function page404()
	{
		$info = new OrionMagic();
				
		$page = new OrionBuilder_Html(Orion::getAttribute(Orion::ATTR_VIEW_PAGE_404));
		$page = $page->openHtml();
		$page = preg_replace('/\{\>\$pathAdmin\}/', $info->getUrlForPathAdmin(), $page);
		print $page;
		
	}
}