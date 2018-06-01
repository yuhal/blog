<?php
namespace app\site\model;
use think\Model;
use traits\model\SoftDelete;

class ArticleType extends Model{

    /**
     * 使用软删除
     */
    use SoftDelete;

    /**
     * 开启自动写入创建时间
     */
    protected static $deleteTime = 'delete_time';
    protected $ceateTime  = true;
    
    /**
     * 数据类型转换
     */
    protected $type = [
        'update_time'  =>  'datetime:Y/m/d',
    ];

     /**
     * 关联查询该分类下的所有文章
     */
	public function getArticle(){
        return $this->hasMany('Article','type_id');
    }

    /**
     * 关联查询该分类下的所有文章
     */
    public function getAllArticle(){
        return $this->belongsToMany('Article');
    }
}
