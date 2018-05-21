<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/data/home/bxu2713790162/htdocs/application/blog/view/details/index.html";i:1515749482;s:63:"/data/home/bxu2713790162/htdocs/application/blog/view/base.html";i:1516793579;s:68:"/data/home/bxu2713790162/htdocs/application/blog/view/index/nav.html";i:1508377926;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
   <!--  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $content['article_title']; ?> | __NICK_NAME__的博客</title>
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

<script type="text/javascript">
window.onload=function(){
  $(".am-article-bd a").attr("target","_blank");
} 
</script>
<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed blog-content">
  <?php if(is_mobile_request()==false): ?>
	<div style="position:fixed;width:130px;top:90px;left:0px;overflow: hidden;">
	 <ul id="amul" class="am-pagination blog-article-margin">
	 	 <li><a style="cursor: pointer"><span class="am-icon-list"> &nbsp;</span>目录</a></li>
         <?php if(is_array($content['des']) || $content['des'] instanceof \think\Collection): $k = 0; $__LIST__ = $content['des'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
         <li class="amulli"><a href="#<?php echo $v['name']; ?>"><?php echo $k; ?>&nbsp;<?php echo $v['name']; ?></a></li>
         <?php endforeach; endif; else: echo "" ;endif; ?>
     </ul>
	</div> 
  <?php endif; ?>
    <div id="detail" class="am-u-sm-12">
      <article class="am-article blog-article-p">
        <div class="am-article-hd">
          <h1 style="font-size:32px;" class="am-article-title blog-text-center"><?php echo $content['article_title']; ?></h1>
          <p class="am-article-meta blog-text-center">
            <span>
			      <a style="color: <?php echo $content['color']; ?>;" href="/categories/<?php echo $content['value']; ?>" class="blog>"><?php echo $content['value']; ?> &nbsp;</a>
            </span>-
            <span><a href=""><i class="am-icon-at am-icon-fw"></i>__NICK_NAME__ &nbsp;</a></span>-
            <span><a href=""><?php echo $content['create_time']; ?></a></span>
          </p>
        </div>        
        <div class="am-article-bd">
        <p class="class="am-article-lead"">
            <?php if(is_array($content['des']) || $content['des'] instanceof \think\Collection): $i = 0; $__LIST__ = $content['des'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <h1 id="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></h1><hr/><?php echo htmlspecialchars_decode($v['text']); endforeach; endif; else: echo "" ;endif; ?>
        </p>
        </div>
      </article>
        <div class="am-g blog-article-widget blog-article-margin">
          <div id="share" class="am-u-lg-4 am-u-md-5 am-u-sm-7 am-u-sm-centered blog-text-center">
              <?php echo $content['tags']; ?>
            <hr>
            <span title="share to" class="am-icon-share am-icon-fw am-primary"></span>&nbsp;&nbsp;&nbsp;
            <a title="Sina" target="_blank" href="http://service.weibo.com/share/share.php?title=<?php echo $content['article_title']; ?>"><span class="am-icon-weibo am-icon-fw blog-icon"></span></a>
            <a title="Facebook" href="javascript:window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(document.location.href)+'&amp;t='+encodeURIComponent(document.title),'toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=600, height=450,top=100,left=350');void(0)">
                <span class="am-icon-facebook am-icon-fw am-primary blog-icon"></span>
            </a>
            <script type="text/javascript">document.write(['<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=',encodeURIComponent(location.href),'&title=',encodeURIComponent(document.title),'" target="_blank"   title="Qzone"><span class="am-icon-star am-icon-fw am-primary blog-icon"></span></a>'].join(''));</script>
            <a title="Wechat" target="_blank" href=""><span class="am-icon-wechat am-icon-fw blog-icon"></span></a>

          </div>
        </div>
        <hr>
        <ul class="am-pagination blog-article-margin">
        <?php if($content['lastid'] && !$content['nextid']): ?>
        	<li class="am-pagination-prev"><a href="/details/<?php echo $content['lastid']; ?>">&laquo; 一切的回顾</a></li>
        <?php elseif($content['nextid'] && !$content['lastid']): ?>  
        	<li class="am-pagination-next"><a href="/details/<?php echo $content['nextid']; ?>">不远的未来 &raquo;</a></li>

        </ul> 	<?php else: ?>
        <li class="am-pagination-prev"><a href="/details/<?php echo $content['lastid']; ?>">&laquo; 一切的回顾</a></li>
        <li class="am-pagination-next"><a href="/details/<?php echo $content['nextid']; ?>">不远的未来 &raquo;</a></li>
        <?php endif; ?>
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