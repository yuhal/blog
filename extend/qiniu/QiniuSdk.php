<?php
namespace qiniu;

require 'php-sdk/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Qiniu\Storage\BucketManager;

class QiniuSdk{

	public $sdk_info;

	function __construct($info){
		$this->sdk_info = $info;
		$this->Auth = new Auth($this->sdk_info['accessKey'],$this->sdk_info['secretKey']);
		$this->uploadMgr = new UploadManager();
		$this->bucketMgr = new BucketManager($this->Auth);
	}
	
	public function __call($name, $arguments=null){
		$arguments = current($arguments);
		if(method_exists($this->bucketMgr, $name)){
			switch ($name) {
				case 'buckets':
	    			return $this->bucketMgr->buckets($arguments['shared']);
	    		break;
	    		case 'domains':
	    			return $this->bucketMgr->domains($this->sdk_info['bucket']);
	    		break;
				case 'listFiles':
	    			return $this->bucketMgr->listFiles($this->sdk_info['bucket']);
	    		break;
	    		case 'rename':
	    			return $this->bucketMgr->rename($this->sdk_info['bucket'],$arguments['oldname'],$arguments['newname']);
	    		break;
	    		case 'delete':
	    			return $this->bucketMgr->delete($this->sdk_info['bucket'],$arguments['oldname']);
	    		break;
	    		case 'move':
	    			return $this->bucketMgr->move($arguments['from_bucket'], $arguments['from_key'], $arguments['to_bucket'], $arguments['to_key']);
	    		break;
	    		case 'copy':
	    			return $this->bucketMgr->copy($arguments['from_bucket'], $arguments['from_key'], $arguments['to_bucket'], $arguments['to_key']);
	    		break;
	    		case 'fetch':
	    			return $this->bucketMgr->fetch($arguments['url'],$this->sdk_info['bucket']);
	    		break;
	    	}	
		}elseif(method_exists($this->uploadMgr, $name)){
			switch ($name) {
				case 'putFile':
					$arguments['token'] = $this->Auth->uploadToken($this->sdk_info['bucket']);
					$re = $this->uploadMgr->putFile($arguments['token'],$arguments['file'],$arguments['filepath']);
					if(isset($re[0]['key'])){
						return true;
					}else{
						return false;
					}
	    		break;
	    	}
		}elseif(method_exists($this->Auth, $name)){
			switch ($name) {
				case 'uploadToken':
					$token = $this->Auth->uploadToken($this->sdk_info['bucket']);
					if($token){
						return $token;
					}else{
						return false;
					}
				break;
				case 'privateDownloadUrl':
					$token = $this->Auth->privateDownloadUrl($arguments['baseUrl']);
					if($token){
						return $token;
					}else{
						return false;
					}
	    		break;
	    	}
		}else{
			return 404;
		}
    }
}