<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-09-19
 * Time: 11:35
 */

namespace app\site\controller;

class Category extends Base
{
    /**
     * 分类页
     * @param $cate
     */
    public function index($cate){
        $ArticleType = $this->ArticleType;
        $list = $ArticleType::getbyvalue($cate);
        if(empty($list))
        {
            $this->redirect('/error');
        }
        $where['type_id'] = $list['id'];
        $allart = $this->ArticleType->getArticle()->where($where)->select();
        foreach ($allart as $key => $value) {
             $allart[$key]['pic'] = $this->Article->getOnePicturesByGroupName();
        }
        $this->assign('list',$list);
        $this->assign('allart',$allart);
        $this->assign('cate',$cate);
        return $this->fetch();
    }

}