<?php
namespace app\site\controller;

class TimeLine extends Base
{	
    public function index()
    {
    	$file = $this->Article->getAllArticleByYear();
		$this->assign('file',$file);
    	return	$this->fetch();
	}
}
