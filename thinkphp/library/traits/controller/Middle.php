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
		$domain = $url[0];
		if($domain=='www'){
			$domain = 'hai';
		}
		$site_info = getSiteInfo(['domain'=>$domain]);
		if($site_info)
		{
			foreach ($site_info as $key => $value) {
				$jsonData = json_decode($value,true);
				if(is_array($jsonData)){
					foreach ($jsonData as $key => $value) {
						$site_info[$key] = $value;
					}
				}
			}
        	return $site_info;
        }else
        {
        	$this->redirect("http://yuhal.com/error");
        }

	}
	
}
