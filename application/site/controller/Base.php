<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-09-19
 * Time: 11:35
 */

namespace app\site\controller;
use think\Controller;
use traits\controller\Middle;

header('content-type:text/html; charset=utf-8');

class Base extends Controller
{
    /**
     * 使用中间件
     */ 
    use Middle;

    /**
     * 初始化操作
     */ 
    public function __construct()
    {     
        parent::__construct();
        $this->assign('site_info',$this->checkdomain());
        $this->Information = model('site/Information');
        $this->Article = model('site/Article');
        $this->ArticleType = model('site/ArticleType');
        $this->ArticleTags = model('site/ArticleTags');
        $this->pageSize = config('paginate.list_rows');
        $this->assign('Tag',$this->ArticleTags->getAllTags());
    }

    /**
     * Ajax获取最新资讯
     */
    public function ajax_information(){
        if(request()->isAjax())
        {
           return getRandInformation();
        }
    }

    /**
     * Ajax获取标签
     */
    public function ajax_tag(){
        if(request()->isAjax())
        {
           return $this->ArticleTags->taginfo();
        }
    }

    /**
     * Ajax获取站点信息
     */
    public function ajax_siteinfo(){
        if(request()->isAjax())
        {
           return $this->checkdomain();
        }
    }   

    /**
     * Ajax获取广告信息
     */
    public function ajax_sponsorinfo(){
        if(request()->isAjax())
        {
           return 520;
        }
    }  

    /**
     * 404页面
     */
    public function error_page($msg=404){
        return view('public/error',['msg'=>'Sorry, the page you visited did not exist!','code'=>404]);
    }






}