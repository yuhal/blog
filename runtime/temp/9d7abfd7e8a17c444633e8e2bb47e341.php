<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"/data/home/bxu2713790162/htdocs/application/blog/view/error/error.html";i:1506416672;s:63:"/data/home/bxu2713790162/htdocs/application/blog/view/base.html";i:1516793579;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
   <!--  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $code; ?> &middot; <?php echo $msg; ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="__STATIC__/assets/i/digg_32px_581505_easyicon.net.png">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="__STATIC__/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="apple-touch-icon-precomposed" href="__STATIC__/assets/i/app-icon72x72@2x.png">
    <meta name="msapplication-TileImage" content="__STATIC__/assets/i/app-icon72x72@2x.png">
    <meta name="msapplication-TileColor" content="#0e90d2">
    <link rel="stylesheet" href="__STATIC__/assets/css/amazeui.min.css">
    <link rel="stylesheet" href="__STATIC__/assets/css/app.css">
    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="__STATIC__/assets/js/jquery.min.js"></script>
    <!--<![endif]-->
    <?php if(is_mobile_request()==false): ?>
    <style>
    #detail {
        margin:0 35px 0 45px;
    }
    #amul li a{
        width:100px;
    }
    #amul li:first-child{
        font-size:16px;
        width:105px;
    }
    #amul li:last-child{
        font-size:12px;
        width:100px;
    }
    .amulli{
        font-size:12px;
        width:100px;
    }
    </style> 
    <?php endif; ?>
</head>
<!--顶部-->

<!--顶部-->
<!--主内容-->

<div class="log">
    <div class="am-g">
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-8 am-u-sm-centered log-content">
            <h1 class="log-title am-animation-slide-top"><?php echo $code; ?></h1>
            <p><?php echo $msg; ?></p>
            <p>The site configured at this address does not contain the requested file.</p>
            <p>The Page You Requested Could Not Be Found,make sure that the filename case matches the URL.</p>
            <p>Please go back to the homepage or contact us on the following platforms.</p>
            <p id="contact"></p>
            <p><a href="http://www.yuhal.com"><i class="am-icon-link am-icon-fw"></i>http://www.yuhal.com</a></p>
        </div>
    </div>
    <footer class="log-footer">
        © 2017 Inc , All rights reserved.
    </footer>
</div>
<script>
    window.onload=function() {
        /*加载联系方式*/
        $.ajax({
            type: "GET",
            url: "/userinfo",
            dataType: "json",
            success: function (userinfo) {
                var data = JSON.parse(userinfo.contact);
                var html = '';
                $.each(data, function (data, info) {
                    html += "<a target='_blank' title='" + info.name + "' href='" + info.value + "'><span class='am-icon-" + info.name + " am-icon-fw am-primary blog-icon'></span></a> ";
                });
                $("#contact").html(html);
            }
        });
    };
</script>

<!--主内容-->
<!--侧边栏-->

<!--侧边栏-->
<!--底部-->

<!--底部-->