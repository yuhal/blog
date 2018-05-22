<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-09-19
 * Time: 11:35
 */

namespace app\site\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use traits\controller\Middle;

header('content-type:text/html; charset=utf-8');

class Base extends Controller
{

    use Middle;

    public function __construct()
    {     
        parent::__construct();
        $this->assign('site_info',$this->checkdomain());
        $this->Information = model('site/Information');
        $this->Article = model('site/Article');
        $this->ArticleType = model('site/ArticleType');
        $this->ArticleTags = model('site/ArticleTags');
        $this->assign('Tag',$this->ArticleTags->getAllTags());
    }

    public function ajax_information(){
        if(request()->isAjax()){
           return getRandInformation();
        }
    }

    public function ajax_tag(){
        if(request()->isAjax()){
           return $this->ArticleTags->taginfo();
        }
    }




}