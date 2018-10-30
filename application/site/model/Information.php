<?php
namespace app\site\model;
use think\Model;

class Information extends Model{

	/**
	 * 随机查询最新资讯
	 */
	public function getInformation()
	{
		return $this->limit(5)->order('rand()')->select();
	} 
}
