<?php
namespace app\site\model;
use think\Model;

class ArticleDes extends Model{

	/**
	 * 添加文章详情
	 * @param $des
	 */
	public static function adddes($des)
	{
		foreach($des as $k=>$v){
			$des[$k]['pid'] = db('article')->getLastInsID();
			$res = db('des')->insert($des[$k]);
		}			
		return $res;
	} 
	
}
