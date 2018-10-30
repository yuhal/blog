<?php
namespace app\site\model;
use think\Model;

class Sdk extends Model{
    /**
     * 查询单个sdk内容
     * @param where
     */
    public function getSdkInfoByWhere($where)
    {
        $sdk_info = json_decode($this->where($where)->value('sdk_info'),true);
        return $sdk_info;
    }

    /**
     * 随机查询一张图片
     * @access pubic
     * @return data
     */
    public function getRandPicture()
    {
        config('sdk.qiniu_sdk',$this->getSdkInfoByWhere(array('sdk_name'=>'qiniu_sdk')));
        $qiniu_sdk = config('sdk.qiniu_sdk');
        $Qiniu = new \qiniu\QiniuSdk($qiniu_sdk);
        $buckets = current($Qiniu->buckets(['shared'=>session('site_info.qiniu_account')]));
        foreach ($buckets as $key => $value) {
            if(strstr($value, 'picture')){
                $qiniu_sdk['bucket'] = $value;
                $domains = current((new \qiniu\QiniuSdk($qiniu_sdk))->domains());
                foreach ($domains as $k => $v) {
                    if(strstr($v, 'picture')){
                        $domain = $v;
                        $re = (new \qiniu\QiniuSdk($qiniu_sdk))->listFiles();
                        if(isset($re[0]['items'])){
                            $pictures = array_column($re[0]['items'], 'key');
                            foreach ($pictures as $key => $value) {
                                $pictures[$key] = $domain.'/'.$value;  
                            }
                        }
                    }
                }
            }
        }    
        if($pictures){
            $key = array_rand($pictures);
            return $pictures[$key];      
        }else{
            return '/public/static/images/01.jpg';
        }   
    }

}
