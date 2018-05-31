<?php 
namespace traits\controller;

trait Middle
{
	/**
	 * 中间件检测子域名是否存在
	 */
	public function checkdomain()
	{
		$url=explode(".", input('server.HTTP_HOST'));
		$domain = isset($url[0]) ? $url[0] : 'hai';
		$site_info = getUser(['domain'=>$domain]);
		if($site_info)
		{
			session('domain',$domain);
     		session('site_info_'.$domain,$site_info);
        	return $site_info;
        }else
        {
        	$this->redirect("http://www.yuhal.com");
        }

	}
	
}
