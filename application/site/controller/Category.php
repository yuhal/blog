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
     * @param string $name
     * @param int $p
     * @return mixed
     */
    public function index($cate){
        $ArticleType = $this->ArticleType;
        $list = $ArticleType::getbyvalue($cate);
        if(empty($list)){
            return $this->fetch('error/error',['code'=>404,'msg'=>'File not found']);
        }
        $where = "type_id = {$list['id']}";
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