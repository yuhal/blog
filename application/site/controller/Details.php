<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-09-19
 * Time: 11:35
 */

namespace app\site\controller;
use app\blog\model\Tags;


class Details extends Base
{
    /**
     * @param $id
     * @return mixed
     */
    public function index($id)
    {
        $where = "article_id={$id}";
        $content = $this->Article->getArticleByWhere($where);
        if(empty($content)){
            return $this->fetch('error/error',['code'=>404,'msg'=>'File not found']);
        }
        $content['des'] = $this->Article->getDes()->where("pid={$id}")->select();
        if($content['show_type']==1){
            return $this->fetch('index/about',['content'=>$content]);
        }
        $arr = ishav_str_array(',',$content['tag_ids']);
        if(empty($arr)){
            $str = ''; 
        }elseif(empty($arr[1])){
            $str = '<span title="Tags" class="am-icon-tag"> &nbsp;</span>'; 
        }else{
            $str = '<span title="Tags" class="am-icon-tags"> &nbsp;</span>'; 
        }
        foreach ($arr as $k=>$v){
            $tag = Tags::getbyid($v)['value'];
            $str .= "<a href='/tag/".$tag."'>".$tag."</a> ,";
        }
        $content['tags']=rtrim($str, ",");
        $content['lastid'] = $this->Article->getLastidById($id);
        $content['nextid'] = $this->Article->getNextidById($id);
        $this->assign('content',$content);
        return $this->fetch();
    }

}