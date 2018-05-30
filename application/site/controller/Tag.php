<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-09-19
 * Time: 11:35
 */

namespace app\site\controller;

class Tag extends Base
{
    /**
     * @param $tag
     * @return mixed
     */
    public function index($tag){
        $list = $this->ArticleTags::getbyvalue($tag);
        if(empty($list)){
            $this->redirect('/error');
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