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
        //验证站点信息
        $this->site_info = $this->checkdomain();
        $this->site_info['domain'] = 'https://www.yuhal.com';
        session('site_info',$this->site_info);
        $this->assign('site_info',$this->site_info);
        //初始化model
        $this->Information = model('site/Information');
        $this->Article = model('site/Article');
        $this->ArticleType = model('site/ArticleType');
        $this->ArticleTags = model('site/ArticleTags');
        $this->Sdk = model('site/Sdk');
        $this->pageSize = config('paginate.list_rows');
        $this->assign('Tag',$this->ArticleTags->getAllTags());
    }

    /**
     * 获取最新资讯
     */
    public function getInformation(){
        if(request()->isAjax()){
           return getRandInformation();
        }
    }

    /**
     * 404页面
     */
    public function error_page($msg=404){
        return view('public/error',['msg'=>'Sorry, the page you visited did not exist!','code'=>404]);
    }


}