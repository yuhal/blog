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
        'id'   => '\d+',
        'p'    => '\d+',
    ],
    //主页
    ''	                 =>	'site/index/index',
    'index'              => 'site/index/index',
    //详情
    'details/:id'	     =>	'site/details/index',
    //分类
    'categories/:cate'	 =>	'site/category/index',
    //标签
    'tag/:tag'	         =>	'site/tag/index',
    //相册
    'photo'		         =>	'site/img/photo',
    //关于
    'about'              => 'site/index/about',
    //图片
    'img/:id'	         =>	'site/img/index',
    //归档
    'timeline'	         =>	'site/timeline/index',
    //空路由
    '__MISS__'           =>  'site/page/pageerror', 
    //error页面
    'error/[:msg]'       =>  'site/page/pageerror',

    /*-----------API路由--------------*/
    //获取标签信息
    'ajax_tag'           => 'site/index/ajax_tag',
    //获取最新咨询信息
    'ajax_information'   => 'site/index/ajax_information',
    //获取用户信息
    'userinfo'           => 'site/index/userinfo',
];
