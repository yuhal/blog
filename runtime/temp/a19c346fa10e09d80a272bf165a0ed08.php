<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"G:\Daily\design\yuhaI/application/blog\view\index\index.html";i:1515749483;s:53:"G:\Daily\design\yuhaI/application/blog\view\base.html";i:1515749480;s:58:"G:\Daily\design\yuhaI/application/blog\view\index\nav.html";i:1508377926;s:59:"G:\Daily\design\yuhaI/application/blog\view\index\side.html";i:1515749689;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>
<?php if(empty($title)): ?>__NICK_NAME__的博客<?php else: ?><?php echo $title; ?> | __NICK_NAME__的博客<?php endif; ?>
</title>
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

<style>
    am-pagination li:first-child{
        padding:50px;
    }  
    #Pagination a{
        margin-left:5px;
        float: left;
    }
    .am-pagination{
        float: left;
    }
</style>
<script>
    function showlist(obj,page){
        var title = $("#title").val();
        var url = "/Index/index";
        var data = {p:obj,title:title};
        $.ajax({
            type: "GET",
            url: url,
            data: data,
            dataType: "json",
            success: function(data){
                var html = '';
                $.each(data, function(data, info){
                    html += '<article class="am-g blog-entry-article">' +
                        '<div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-img" style="width:400px;height:155px;overflow: hidden;">'+
                        '<a target="_blank" href="/details/'+info.article_id+'"><img src="'+info.pic+'" alt="" class="am-u-sm-12"></a>'+
                        '</div>'+
                        '<div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-text">'+
                        '<span>'+
                        '<a style="color:'+info.color+'" href="/categories/'+info.value+'" class="blog">'+info.value+' &nbsp;</a>'+
                        '</span>'+
                        '<span> @__NICK_NAME__ &nbsp; </span>'+
                        '<span>'+info.create_time+'</span>'+
                        '<h1><a target="_blank" href="/details/'+info.article_id+'">'+info.article_title+'</a></h1>';
                    if(info.note.length>=100){
                        html +='<p>'+info.note.substring(0,100)+'</p>';
                    }else{
                        html +='<p>'+info.note+'</p>';
                    }
                    html +='<p><a href="" class="blog-continue">continue reading</a></p>'+
                        '</div>'+
                        '</article>';
                });
                $('#list').html(html);
                if(obj==1){
                    $('.prev').attr('href','javascript:showlist(1,"'+page+'")');
                }else{
                    var prev = parseInt(obj)-1;
                    $('.prev').attr('href','javascript:showlist("'+prev+'","'+page+'")');
                }
                if(obj==page){
                    $('.next').attr('href','javascript:showlist("'+page+'","'+page+'")');
                }else{
                    var next = parseInt(obj)+1;
                    $('.next').attr('href','javascript:showlist("'+next+'","'+page+'")');
                }
            }
        });
        var progress = $.AMUI.progress;
        progress.done(true);
    }
</script>
<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed">
    <div class="am-u-md-8 am-u-sm-12">
        <?php if($title): ?>  
        <script>
        $(function(){
            toRed("<?php echo $title; ?>");
        });       
        function toRed(content){
            var bodyHtml = $(".tle").html();
            var x = bodyHtml.replace(new RegExp(content,"gm"),"<font color='red'>"+content+"</font>");
            $(".tle").html(x);
            var bodyHtml = $(".alc").html();
            var x = bodyHtml.replace(new RegExp(content,"gm"),"<font color='red'>"+content+"</font>");
            $(".alc").html(x);
        }
        </script>           
        <h7 class="am-article-title blog-text-center"><?php echo $title; ?>&nbsp;的搜索结果</h7>
        <?php endif; ?>
        <div id="list">
            <?php if(is_array($allart) || $allart instanceof \think\Collection): $i = 0; $__LIST__ = $allart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <article class="am-g blog-entry-article">
                <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-img" style="width:400px;height:155px;overflow: hidden;">
                    <a target="_blank" href="/details/<?php echo $v['article_id']; ?>"><img src="<?php echo $v['pic']; ?>" alt="" class="am-u-sm-12"></a>
                </div>
                <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-text">
                <span>
                	<a style="color:<?php echo $v['color']; ?>" href="/categories/<?php echo $v['value']; ?>" class="blog"><?php echo $v['value']; ?> &nbsp;</a>
                </span>
                    <span> @__NICK_NAME__ &nbsp;</span>
                    <span><?php echo $v['create_time']; ?></span>
                    <h1><a class="tle" target="_blank" href="/details/<?php echo $v['article_id']; ?>"><?php echo $v['article_title']; ?></a></h1>
                    <?php if(mb_strlen($v['note'],'utf8')>=100): ?>
                    <p class="alc"><?php echo mb_substr($v['note'],0,100,'utf8'); ?>...</p>
                    <?php else: ?>
                    <p class="alc"><?php echo $v['note']; ?></p>
                    <?php endif; ?>
                </div>
            </article>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php if(is_mobile_request()==false || $allart==null): ?>
        <ul class="am-pagination" style="margin-right: 105px">
            <li class="am-pagination-prev">
                <?php if($p==1): ?>
                <a class="prev" href="javascript:showlist(1,<?php echo $page; ?>);">&laquo; Prev</a>
                <?php else: ?>
                <a class="prev" href="javascript:showlist(<?php echo $p-1; ?>,<?php echo $page; ?>);">&laquo; Prev</a>
                <?php endif; ?>
            </li>
        </ul>
        <?php endif; ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#Pagination").pagination(<?php echo $page; ?>);
            });
        </script>
        <ul class="am-pagination" id="Pagination" >
        </ul>
        <?php if(is_mobile_request()==false || $allart==null): ?>
        <ul class="am-pagination" style="float: right">
            <li class="am-pagination-next">
                <?php if($p==$page): ?>
                <a class="next" href="javascript:showlist(<?php echo $page; ?>,<?php echo $page; ?>);">&raquo; Next</a>
                <?php else: ?>
                <a class="next" href="javascript:showlist(<?php echo $p+1; ?>,<?php echo $page; ?>);">Next &raquo;</a>
                <?php endif; ?>
            </li>
        </ul>
        <?php endif; ?>
    </div>

<!--主内容-->
<!--侧边栏-->
    <div class="am-u-md-4 am-u-sm-12 blog-sidebar">
        <div id="first_sidebar" class="blog-sidebar-widget blog-bor">
            <h2 class="blog-text-center blog-title"><span>微信公众号</span></h2>
            <img src="http://www.3lian.com/js/grey.gif"  class="blog-entry-img" >
            <p>购买广告位</p>
        </div>
        <div id="second_sidebar" class="blog-sidebar-widget blog-bor">
            <h2 class="blog-text-center blog-title"><span>联系我</span></h2>
            <p id="contact">
            </p>
        </div>
        <div class="blog-clear-margin blog-sidebar-widget blog-bor am-g ">
            <h2 class="blog-title"><span>标签云</span></h2>
            <div class="am-u-sm-12 blog-clear-padding">
                <?php if(is_array($Tag) || $Tag instanceof \think\Collection): $i = 0; $__LIST__ = $Tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <a href='/tag/<?php echo $v['value']; ?>' class='blog-tag'><?php echo $v['value']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-title"><span>最新资讯</span></h2>
            <a title='千呼万唤' href='javascript:change();' id="load" data-am-loading="{spinner: 'circle-o-notch', loadingText: '千呼万唤', resetText: ''}"><i class='am-icon-refresh am-icon-fw'></i>千呼万唤</a>
            <ul id="information" class="am-list">
                <li><a>正在加载...</a></li>
            </ul>
        </div>
        
    </div>
</div>
<script>
    var test = window.location.href;
    var host = 'http://'+window.location.host;  
    var url = test.split('#')[0];
    switch(url)
    {
    case host+'/timeline':
      $("#topbar li:eq(1)").addClass("am-active");
      $("#topbar li:eq(0)").removeClass("am-active");
      break;
    case host+'/about':
      $("#topbar li:eq(2)").addClass("am-active");
      $("#topbar li:eq(0)").removeClass("am-active");
      $("#first_sidebar p").hide();    
      about();
      index();
      break; 
    default:
      $("#topbar li:eq(0)").addClass("am-active");
      $("#first_sidebar h2 span").text("赞助商");
      $("#second_sidebar").hide();
      sponsor();
      index();  
    }       
    $('#load').click(function (){
        var $btn = $(this);
        $btn.button('loading');
        setTimeout(function(){
            $btn.button('reset');
        }, 500);
    });
    function change(){
        $.ajax({
            type: "GET",
            url: '/informationinfo',
            dataType: "json",
            success: function (informationinfo) {
                var html = "";
                $.each(informationinfo, function(informationinfo, info){
                    html+="<li><a href='"+info.url+"' target='_blank'>"+info.title.substring(0,18)+"...</title></a></li>";
                });
                $("#information").html(html);
            }
        });
    }
    function index(){
        //加载最新资讯
        $.ajax({
            type: "GET",
            url: "/informationinfo",
            dataType: "json",
            success: function(informationinfo){
                var html = "";
                $.each(informationinfo, function(informationinfo, info){
                    html+="<li><a href='"+info.url+"' target='_blank'>"+info.title.substring(0,17)+"...</title></a></li>";
                });
                $("#information").html(html);
            }
        });
    }
    function about(){
        //加载个人信息
        $.ajax({
            type: "GET",
            url: "/userinfo",
            dataType: "json",
            success: function(userinfo){
                var data = JSON.parse(userinfo.contact);   
                $("#first_sidebar img").attr('src','__STATIC__/images/qrcode_HaI.jpg');
                $("#avatar").attr('src',userinfo.avatar);
                $("#nickname").text(userinfo.nick_name);
                $(".introduce").text(userinfo.introduce);
                var html = '';
                $.each(data, function(data, info){
                    html+="<a target='_blank' title='"+info.name+"' href='"+info.value+"'><span class='am-icon-"+info.name+" am-icon-fw am-primary blog-icon'></span></a> ";
                });
                $("#contact").html(html);
            }
        });
    }
    function sponsor(){
        //加载广告信息
        $.ajax({
            type: "GET",
            url: "/sponsorinfo",
            dataType: "json",
            success: function(info){
                $("#first_sidebar img").attr('src','__STATIC__/images/qrcode_HaI.jpg');
            }
        });
    }
</script>
<!-- content end -->


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