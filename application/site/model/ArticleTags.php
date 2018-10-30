<?php
namespace app\site\model;
use think\Model;
use traits\model\SoftDelete;

class ArticleTags extends Model{

	/**
	 * 使用软删除
	 */
	use softdelete;

	/**
	 * 数据类型转换
	 */
    protected $type = [
        'update_time'  =>  'datetime:Y/m/d',
    ];

    /**
	 * 查询所有的标签
	 */
	public function getAllTags()
	{
	    return $this->field("value")->order("update_time desc")->select();
    }
}
