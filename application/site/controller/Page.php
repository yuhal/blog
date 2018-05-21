<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-09-29
 * Time: 14:17
 */

namespace app\site\controller;


class Page extends Base
{
    public function pageerror($msg=404){
    	return view('error',['msg'=>$msg]);
    }
}