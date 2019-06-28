<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 hsttp://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'id'   =>'\d+',
        'p'    =>'\d+',
    ],
    /*********首页*********/
        'index'=>'site/index/index',
    /*********详情页*********/
        'article/:id'=>'site/index/article',
    /*********分类页*********/
        'categories/:cate'=>'site/category/index',
    /*********标签页*********/
        'tag/:tag'=>'site/tag/index',
    /*********关于*********/
        'about'=>'site/index/about',
    /*********归档*********/
        'timeline'=>'site/index/timeline',
    /*********今日头条*********/
        //最新咨询信息
        'getInformation'=>'site/base/getInformation',
    /*********Api*********/
        'api/listArticle/[:p]'=>'site/api/listArticle',
        'api/article/:article_id'=>'site/api/article',
        'api/listImage/:bucket'=>'site/api/listImage',
    /*********pub*********/
        //空路由
        '__MISS__'=>'site/base/error_page', 
        //error页面
        'error/[:msg]'=>'site/base/error_page',
];
