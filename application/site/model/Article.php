<?php
namespace app\site\model;
use think\Model;
use traits\model\SoftDelete;

class Article extends Model{

    use softdelete;

    // 设置当前模型对应的完整数据表名称
    protected $table = 'yh_article';

    protected $type = [
        'create_time'  =>  'datetime:Y/m/d',
    ];

    function __construct(){
        $this->expire_time = config('redis.expire_time');
    }

    /**
     * 关联查询某个文章的详情
     * @return \think\model\relation\HasMany
     */
    public function getDes()
    {
        //var_dump('<pre>',$this);exit;
        return $this->hasMany('ArticleDes');
    }

    /**
     * 根据搜索条件获取所有的文章的数量
     * @param $where
     */
	public function getAllArticleCountByWhere($where){
        return db('article')->where($where)->count();
	}

	/**
	 * 查询上一篇id
	 * @param $id
	 */ 
	public function getLastidById($id){
        return $this->field('article_id')->where("article_id < {$id}")->order('create_time desc')->value('article_id');
	} 

	/**
	 * 查询下一篇id
	 * @param $id
	 */ 
	public function getNextidById($id){
        return $this->field('article_id')->where("article_id > {$id}")->order('article_id asc')->value('article_id');

	}

	/**
	 * 查询所有的文章
	 * @param $p
     * @param $where
     * @param $limit
	 */
	public function getAllArticleByWhere($p,$where,$pageSize){
        $start = ($p-1)*$pageSize;
        $data = $this->alias('a')
        ->join('article_type b','b.id=a.type_id')
        ->field('a.article_id,a.tag_ids,a.article_title,a.create_time,a.note,b.value,b.color')
        ->where($where)
        ->order('a.create_time desc')
        ->limit($start,$pageSize)
        ->select();
        foreach ($data as $key => $value) {
           $data[$key]['pic'] = getOnePicturesByGroupName();
        }
        return $data; 
	}

    /**
     * @param $tag_id
     * @return \data|\strings
     */
	public function getAllArticleByTag($tag_id){
        $data = $this->alias('a')
            ->join('article_type b','b.id=a.type_id')
            ->field('a.article_id,a.tag_ids,a.article_title,a.create_time,a.note,b.value,b.color')
            ->order('a.create_time desc')
            ->select();
        if($data){
            foreach ($data as $k=>$v){
                $data[$k]['pic'] = getOnePicturesByGroupName();
                $arr = ishav_str_array(',',$v['tag_ids']);
                if(!in_array($tag_id,$arr)){
                    unset($data[$k]);
                }
            }
            return $data;    
        }else{
            return false;
        }
        
    }

	/**
	 * 查询每一年所有的文章
	 * @param $year
	 */
	public function getAllArticleByYear(){
        $timeslot = $this->field("min(create_time) as min_ctime,max(create_time) as max_ctime")->find();
        if($timeslot){
            $years['start'] = date("Y",strtotime($timeslot['min_ctime']));
            $years['end'] = date("Y",strtotime($timeslot['max_ctime']));
            for($year=$years['end'];$year>=$years['start'];$year--){
                for($i=12;$i>=1;$i--){
                $x = $year.'-'.$i.'-1';
                $y = $year.'-'.$i.'-'.date("t",strtotime("{$year}-{$i}"));
                $data[$year][$i] = $this->alias('a')
                    ->join('article_type b','b.id=a.type_id')
                    ->field('a.article_id,a.article_title,from_unixtime(unix_timestamp(a.create_time),"%Y/%m/%d") as create_time,a.note,b.value,b.color')
                    ->where("a.create_time between '{$x}' and '{$y}'")
                    ->order('a.create_time desc')
                    ->select();
                if(empty($data[$year][$i])){
                        unset($data[$year][$i]);
                    }
                }
            }
            return $data;   
        }else{
            return false;
        }
	}

	/**
	 * 查询某个文章的详情
	 * @param string $where 
	 */
	public function getArticleByWhere($where){
        return $this->alias('a')
		->join('article_type b','b.id=a.type_id')
		->field('a.article_title,a.create_time,a.note,b.color,b.show_type,b.value,a.article_id,a.tag_ids')
		->where($where)
		->find();
	}

    
}
