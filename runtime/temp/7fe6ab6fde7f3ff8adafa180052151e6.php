<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"G:\Daily\design\yuhaI/application/blog\view\timeline\index.html";i:1515749487;s:53:"G:\Daily\design\yuhaI/application/blog\view\base.html";i:1515749480;s:58:"G:\Daily\design\yuhaI/application/blog\view\index\nav.html";i:1508377926;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>归档 | __NICK_NAME__的博客</title>
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
<!-- nav start -->
<nav class="am-g am-g-fixed blog-fixed blog-nav" id="top">
<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only blog-button" data-am-collapse="{target: '#blog-collapse'}" ><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="blog-collapse">
    <ul id="topbar" class="am-nav am-nav-pills am-topbar-nav">
      <li class="am-active"> <a style="cursor: pointer;" href="/"><i class="am-icon-home am-icon-fw"></i>首页</a></li>
      <!--<li><a href="/photo">相册</a></li>-->
      <li><a href="/timeline"><i class="am-icon-archive am-icon-fw"></i>归档</a></li>
      <li><a href="/about"><i class="am-icon-angellist am-icon-fw"></i>关于</a></li>
    </ul>
    <form action="/index" method="get" class="am-topbar-form am-topbar-right am-form-inline" role="search">
      <div class="am-form-group">
        <input type="text" id="title" name="title" class="am-form-field am-input-sm" placeholder="🔍" <?php if(isset($title)): ?> value="<?php echo $title; ?>" <?php endif; ?> >
      </div>
    </form>
  </div>
</nav>
<hr>
<script type="text/javascript">
    var test = window.location.href;
    var host = 'http://'+window.location.host;  
    switch(window.location.href)
    {
    case host+'/timeline':
      $("#topbar li:eq(1)").addClass("am-active");
      $("#topbar li:eq(0)").removeClass("am-active");
      break;
    case host+'/about':
      $("#topbar li:eq(2)").addClass("am-active");
      $("#topbar li:eq(0)").removeClass("am-active");
      break; 
    default:
      $("#topbar li:eq(0)").addClass("am-active");
    }       
</script>
<!-- nav end -->
<!--顶部-->
<!--主内容-->

<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <div class="am-u-sm-12">
        <h1 class="blog-text-center">-- 归档 --</h1>
        <?php if(is_array($file) || $file instanceof \think\Collection): $i = 0; $__LIST__ = $file;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <div class="timeline-year">
            <h1><?php echo $key; ?></h1>
            <hr>
            <?php if(is_array($v) || $v instanceof \think\Collection): $i = 0; $__LIST__ = $v;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>               
                <ul>
                    <h3><?php echo $key; ?>月</h3>
                    <hr>
                    <?php if(is_array($v2) || $v2 instanceof \think\Collection): $i = 0; $__LIST__ = $v2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v3): $mod = ($i % 2 );++$i;?>
                    <li>
                        <span class="am-u-sm-4 am-u-md-2 timeline-span"><?php echo $v3['create_time']; ?></span>
                        <span class="am-u-sm-8 am-u-md-6">
                            <a href="/details/<?php echo $v3['article_id']; ?>">
                            <?php if(strlen($v3['article_title'])>=108): ?>
                                <?php echo mb_substr($v3['article_title'],0,30,'utf8'); ?>...
                            <?php else: ?>
                                <?php echo $v3['article_title']; endif; ?>
                            </a>
                        </span>
                        <span class="am-u-sm-4 am-u-md-2 am-hide-sm-only">
                            <a style="color:<?php echo $v3['color']; ?>" target="_blank" href="/categories/<?php echo $v3['value']; ?>" class="blog"><?php echo $v3['value']; ?> &nbsp;</a>
                        </span>
                        <span class="am-u-sm-4 am-u-md-2 am-hide-sm-only">__NICK_NAME__</span>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <br>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <hr>
    </div>
</div>
<!-- content end -->

<!--主内容-->
<!--侧边栏-->

<!--侧边栏-->
<!--底部-->

<footer class="blog-footer">
    <div class="blog-text-center">
        Blog Produced by yuhal. Designed by yuhal. © 2017 All Right Reserve.
 </div>
</footer>
<script>
    function redirect(obj) {
        window.location.href=obj.href;
    }
</script>
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="__STATIC__/assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script type="text/javascript" src="__STATIC__/pages/js/jquery.pagination.js"></script>
<script src="__STATIC__/assets/js/amazeui.min.js"></script>
<script src="__STATIC__/assets/js/amazeui.min.js"></script>
<script src="__STATIC__/assets/js/pinto.min.js"></script>
<script src="__STATIC__/assets/js/img.js"></script>
<script src="__STATIC__/assets/js/layer/layer.js"></script>
</body>
</html>

<!--底部-->