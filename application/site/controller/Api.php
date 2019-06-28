<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-09-19
 * Time: 11:35
 */

namespace app\site\controller;
header("Content-type:text/html;charset=utf-8");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods:GET,POST");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers
ini_set('allow_url_include', 'On');
ini_set('allow_url_fopen', 'On');
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

    /**
     * 图片列表
     * @param $bucket
     */
    public function listImage($bucket){
        config('sdk.qiniu_sdk',$this->Sdk->getSdkInfoByWhere(array('sdk_name'=>'qiniu_sdk')));
        $qiniu_sdk = config('sdk.qiniu_sdk');
        $Qiniu = new \qiniu\QiniuSdk($qiniu_sdk);
        $buckets = current($Qiniu->buckets(['shared'=>session('site_info.qiniu_account')]));
        if(in_array($bucket, $buckets)){
            $qiniu_sdk['bucket'] = $bucket;
            $pictures = [];
            $domains = current((new \qiniu\QiniuSdk($qiniu_sdk))->domains());
            foreach ($domains as $k => $v) {
                if(strstr($v, 'picture')){
                    $domain = $v;
                    $re = (new \qiniu\QiniuSdk($qiniu_sdk))->listFiles();
                    if(isset($re[0]['items'])){
                        $pictures = array_column($re[0]['items'], 'key');
                        foreach ($pictures as $key => $value) {
                            $pictures[$key] = 'https://'.$domain.'/'.$value;//普通图
                            if(isImage($value)==false){
                                unset($pictures[$key]);
                            }
                        }
                        $pictures = arrayKeyAsc($pictures);
                    }
                }
            }
            echo json_encode(['list'=>$pictures]);exit;
        }else{
            echo json_encode(['error'=>404]);exit;
        }
    }

}