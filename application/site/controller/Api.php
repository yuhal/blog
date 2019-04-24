<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-09-19
 * Time: 11:35
 */

namespace app\site\controller;

class Api extends Base
{


    /**
     * 文章列表
     * @param $cate
     */
    public function listArticle(){
    	$where = [];
        $re['count'] = $this->Article->getArticleCount($where);
        $re['article_list'] = $this->Article->getAllArticle();
		echo json_encode($re);exit;
    }

    /**
     * 文章详情
     * @param $cate
     */
    public function article($article_id){
        $where['article_id'] = $article_id;
        $where['user_id'] = $this->site_info['id'];
        $content = $this->Article->getArticleByWhere($where);
        if(empty($content))
        {
            $this->redirect('/error');
        }
        $content['des'] = $this->Article->getDes()->where('article_id',$article_id)->select();
        foreach ($content['des'] as $key => $value) {
            $content['des'][$key]['text'] = htmlspecialchars_decode($value['text']);
        }
        $arr = ishav_str_array(',',$content['tag_ids']);
        $tags = [];
        foreach ($arr as $k=>$v){
            $tags[$k]['tag_id'] = $v;
            $tags[$k]['tag_name'] = $this->ArticleTags::getbyid($v)['value'];
        }
        $content['tags'] = $tags;
        $content['lastid'] = $this->Article->getLastidById($article_id);
        $content['nextid'] = $this->Article->getNextidById($article_id);
        echo json_encode($content);exit;
    }

}