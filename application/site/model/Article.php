<?php
namespace app\site\model;
use think\Model;
use traits\model\SoftDelete;

class Article extends Model{

    /**
     * 设置当前模型对应的完整数据表名称
     */
    protected $table = 'yh_article';

    /**
     * 数据类型转换
     */
    protected $type = [
        'create_time'  =>  'datetime:Y/m/d',
    ];

    /**
     * 初始化操作
     */
    function __construct(){
        $this->site_info = session('site_info');
        $this->Sdk = model('site/Sdk');
        $this->ArticleTags = model('site/ArticleTags');
    }

    /**
     * 关联查询某个文章的详情
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
	public function getAllArticleCountByWhere($where)
    {
        return db('article')->where($where)->count();
	}

	/**
	 * 查询上一篇文章id
	 * @param $id
	 */ 
	public function getLastidById($id)
    {
        return $this->field('article_id')
        ->where("user_id = {$this->site_info['id']}")
        ->where("article_id < {$id}")
        ->order('create_time desc')
        ->value('article_id');
	} 

	/**
	 * 查询下一篇文章id
	 * @param $id
	 */ 
	public function getNextidById($id)
    {
        return $this->field('article_id')
        ->where("user_id = {$this->site_info['id']}")
        ->where("article_id > {$id}")
        ->order('article_id asc')
        ->value('article_id');

	}

	/**
	 * 分页查询所有的文章
	 * @param $p
     * @param $where
     * @param $pageSize
	 */
	public function getArticle($p,$where,$pageSize)
    {
        $start = ($p-1)*$pageSize;
        $data = $this->alias('a')
        ->join('article_type b','b.id=a.type_id')
        ->field('a.article_id,a.tag_ids,a.article_title,a.create_time,a.note,b.value,b.color')
        ->where($where)
        ->order('a.create_time desc')
        ->limit($start,$pageSize)
        ->select();
        if($data){
            foreach ($data as $key => $value) {
                $data[$key]['pic'] = $this->Sdk->getRandPicture();
                if(!$value['note']) $data[$key]['note'] = $this->getNoteByArticleid($value['article_id']);
            }  
            return $data;  
        }else{
            return '';
        }
	}

    /**
     * 查询所有的文章
     */
    public function getAllArticle()
    {
        $data = $this->alias('a')
        ->join('article_type b','b.id=a.type_id')
        ->field('a.article_id,a.tag_ids,a.article_title,a.create_time,a.note,b.value,b.color')
        ->order('a.create_time desc')
        ->select();
        if($data){
            foreach ($data as $key => $value) {
                $data[$key]['pic'] = $this->Sdk->getRandPicture();
                if(!$value['note']) $data[$key]['note'] = $this->getNoteByArticleid($value['article_id']);
                $arr = ishav_str_array(',',$value['tag_ids']);
                $tags = [];
                foreach ($arr as $k=>$v){
                    $tags[$k]['tag_id'] = $v;
                    $tags[$k]['tag_name'] = $this->ArticleTags::getbyid($v)['value'];
                }
                $data[$key]['tags'] = $tags;
            }  
            return $data;  
        }else{
            return '';
        }
    }

    public function getArticleCount($where){
        return $this->alias('a')->where($where)->count();
    }
 
    /**
     * 获取单个标签下所有的文章
     * @param $tag_id
     */
	public function getAllArticleByTag($tag_id)
    {
        $data = $this->alias('a')
            ->join('article_type b','b.id=a.type_id')
            ->field('a.article_id,a.tag_ids,a.article_title,a.create_time,a.note,b.value,b.color')
            ->order('a.create_time desc')
            ->select();
        if($data){
            foreach ($data as $k=>$v){
                $data[$k]['pic'] = $this->Sdk->getRandPicture();
                $arr = ishav_str_array(',',$v['tag_ids']);
                if(!in_array($tag_id,$arr)){
                    unset($data[$k]);
                }
            }
            return $data;    
        }else{
            return '';
        }
        
    }

	/**
	 * 查询每一年所有的文章
	 * @param $year
	 */
	public function getAllArticleByYear()
    {
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
                    ->where("a.user_id = {$this->site_info['id']}")
                    ->where("a.create_time between '{$x}' and '{$y}'")
                    ->order('a.create_time desc')
                    ->select();
                    if(empty($data[$year][$i])){
                        unset($data[$year][$i]);
                    }else{
                        foreach ($data[$year][$i] as $key => $value) {
                            if(is_mobile_request()==true){
                                $data[$year][$i][$key]['create_time'] = date('m/d',strtotime($value['create_time']));    
                            }
                        }
                    }
                }
            }
            return $data;   
        }else{
            return '';
        }
	}

    /**
     * 查询某个文章的摘要
     * @param $where 
     */
    public function getNoteByArticleid($article_id)
    {
        $data = $this->getDes()
        ->where('article_id',$article_id)
        ->value('text');
        if($data)
        {
            $note = deletehtml(htmlspecialchars_decode($data));
            return $note;
        }else{
            return '';
        }
    }


	/**
	 * 查询某个文章的详情
	 * @param $where 
	 */
	public function getArticleByWhere($where){
        $data = $this->alias('a')
		->join('article_type b','b.id=a.type_id')
		->field('a.article_title,a.create_time,a.note,b.color,a.show_type,b.value,a.article_id,a.tag_ids')
		->where($where)
		->find();
        if($data)
        {
            return $data;
        }else{
            return '';
        }
	}

    
}
