<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use Endroid\QrCode\QrCode;

function getAccessToken($url,$type){
    $res=@file_get_contents('access_token.json');
    $result=json_decode($res,true);     
    $expires_time=isset($result[$type]['expires_time']) ? $result[$type]['expires_time'] : 0;
    //如果过了有效时间，那么重新生成
    if(time()>$expires_time){
        $json=json_decode(http_request($url),true);
        $expires_time=time()+3600;//最大的token保存时间
        $result[$type] = [
            'access_token'=>$json['access_token'],
            'openid'=>isset($json['openid']) ? $json['openid'] : $json['uid'],
            'expires_time'=> $expires_time
        ];
        $save_token = json_encode($result);
        file_put_contents('access_token.json',$save_token);
        return $json;
    }else{
        return $result[$type];
    }        
}

function get_extension($file){
  return substr(strrchr($file, '.'), 1);
}
 
function arrayKeyAsc($arr){
    $new_array = [];
    foreach ($arr as $key => $value) {
        $new_array[] = $value;
    }
    return $new_array;
}

function isImage($filename)
{
 $types = ['gif','GIT','jpeg','JPEG','png','PNG','bmp','BMP','jpg','JPG']; //定义检查的图片类型
 $ext = get_extension($filename);
  if(in_array($ext, $types)){
    return true;
  }else{
    return false;
  }
}
  
/**
 * 取出html标签
 * 
 * @access public
 * @param string str
 * @return string
 * 
 */
function deletehtml($str) {
    $str = trim($str); //清除字符串两边的空格
    $str = str_replace("&nbsp;","",$str);//将空格替换成空
    $str = strip_tags($str); //利用php自带的函数清除html格式。保留P标签
    $str = preg_replace("/\t/","",$str); //使用正则表达式匹配需要替换的内容，如：空格，换行，并将替换为空。
    $str = preg_replace("/\r\n/","",$str); 
    $str = preg_replace("/\r/","",$str); 
    $str = preg_replace("/\n/","",$str); 
    $str = preg_replace("/ /","",$str);
    $str = preg_replace("/&nbsp; /","",$str);  //匹配html中的空格
    return $str; //返回字符串
}

function parse_data($url,$data=''){
    if(!empty($data)){
        $res=http_request($url,$data);
    }else{
        $res=http_request($url);
    }
    if(!empty($res)){
        return json_decode($res);
    }
}


function getSiteInfo($where){
    return db('user')->field('pwd',true)->where($where)->find();
}

function http_request($url,$data=''){
    $ch=curl_init();//初始化（买电话）
    //设置参数
    curl_setopt($ch,CURLOPT_URL,$url);      
    //跳到证书检查
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, FALSE);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//设置内容是不是返回  
    //判断的那个钱是不是有post数据的发送
    if(!empty($data)){
        curl_setopt($ch,CURLOPT_POST,1);//设置post提交数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);//设置post提交数据
    }
    $outopt=curl_exec($ch);//请求的地址输出了什么数据就会返回什么数据
    var_dump($outopt);
    if($outopt === FALSE){
        return "curl 错误信息：".curl_error($ch);
    }   
    curl_close($ch);
    return $outopt;
}

function getQrcode($url){  
    $qrCode=new QrCode();  
    $qrCode->setText($url)
        ->setSize(300)//大小
        ->setLabelFontPath(VENDOR_PATH.'endroid/qrcode/assets/noto_sans.otf')
        ->setErrorCorrectionLevel('high')
        ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
        ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
        ->setLabel('')
        ->setLabelFontSize(16);
    header('Content-Type: '.$qrCode->getContentType());
    echo $qrCode->writeString();
    exit;
}

function unsetArrayElement($arr,$key){
    foreach ($key as $value) {
        unset($arr[$value]);
    }    
    return $arr;
}

function is_mobile_request()  
{  
     $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';  
     $_SERVER['HTTP_USER_AGENT'] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';  
     $mobile_browser = '0';  
     if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))  
      $mobile_browser++;  
     if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))  
      $mobile_browser++;  
     if(isset($_SERVER['HTTP_X_WAP_PROFILE']))  
      $mobile_browser++;  
     if(isset($_SERVER['HTTP_PROFILE']))  
      $mobile_browser++;  
     $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));  
     $mobile_agents = array(  
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',  
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',  
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',  
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',  
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',  
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',  
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',  
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',  
        'wapr','webc','winw','winw','xda','xda-'
        );  
     if(in_array($mobile_ua, $mobile_agents))  
      $mobile_browser++;  
     if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)  
      $mobile_browser++;  
     // Pre-final check to reset everything if the user is on Windows  
     if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)  
      $mobile_browser=0;  
     // But WP7 is also Windows, with a slightly different characteristic  
     if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)  
      $mobile_browser++;  
     if($mobile_browser>0)  
      return true;  
     else
      return false;
}  

function str_content_replace($str){
      return str_replace(array("_","=","+"),'',trim(htmlspecialchars($str)));
}

/**
 * 判断字符串中是否含有某个特殊字符，真假都返回数组
 * @param  $[strstr] [特殊字符]
 * @param [string] $[str] [字符串]
 * @return [arr] $[arr]
 */
function ishav_str_array($strstr,$str){ 
    $re = explode($strstr,$str);
    if($re){
      $arr = $re;
    }else{
      $arr = [$str];
    }
    return $arr;
}

/**
 * 随机查询最新资讯
 * @access pubic
 * @return data
 */
function getRandInformation(){
  return db('information')->limit(5)->order('rand()')->select();
} 

/**
 * @return mixed
 */
function getYears(){
    $year['start'] = date('Y',strtotime($this->min('create_time')));
    $year['end'] =  date('Y',strtotime($this->max('create_time')));
    return $year;
}








