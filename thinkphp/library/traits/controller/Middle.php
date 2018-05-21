<?php 
namespace traits\controller;
use think\Session;

trait Middle
{
	public function checkdomain(){
		$url=explode(".", $_SERVER['HTTP_HOST']);
		$domain = isset($url[0]) ? $url[0] : 'www';
		$site_info = getUser(['domain'=>$domain]);
		if($site_info){
			session('domain',$domain);
     		session('site_info_'.$domain,$site_info);
        	return $site_info;
        }else{
        	$this->redirect('http://www.yuhal.com');
        }

	}
	
	
}
