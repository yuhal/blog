<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-09-19
 * Time: 11:35
 */

namespace app\site\controller;
use app\blog\model\Tags;

class Tag extends Base
{
    /**
     * @param $tag
     * @return mixed
     */
    public function index($tag){
        $list = Tags::getbyvalue($tag);
        if(empty($list)){
            return $this->fetch('error/error',['code'=>404,'msg'=>'File not found']);
        }
        $allart = $this->Article->getAllArticleByTag($list['id']);
        $this->assign('allart',$allart);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function taginfo(){
        if(request()->isAjax()){
            return $this->Tag;
        }
    }
}