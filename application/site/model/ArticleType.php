<?php
namespace app\site\model;
use think\Model;
use traits\model\SoftDelete;

class ArticleType extends Model{
    use SoftDelete;
    protected static $deleteTime = 'delete_time';
    protected $type = [
        'update_time'  =>  'datetime:Y/m/d',
    ];

    protected $ceateTime  = true;
    /**
     * @return \think\model\relation\HasMany
     */
	public function getArticle(){
        return $this->hasMany('Article','type_id');
    }
    public function getAllArticle(){
        return $this->belongsToMany('Article');
    }
}
