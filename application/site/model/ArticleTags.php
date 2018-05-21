<?php
namespace app\site\model;
use think\Model;
use traits\model\SoftDelete;

class ArticleTags extends Model{
	use softdelete;

    protected $type = [
        'update_time'  =>  'datetime:Y/m/d',
    ];

	public function getAllTags(){
	    return $this->field("value")->order("update_time desc")->select();
    }
}
