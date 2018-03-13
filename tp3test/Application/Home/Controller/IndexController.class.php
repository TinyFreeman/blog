<?php

namespace Home\Controller;
use       Think\Controller;
header("Content-type: text/html; charset=utf-8");
class IndexController extends Controller {
    public $test = 123;

    public function index(){
        
        echo self::test();
 
		echo 22;
    }

    public   function test()
    {
        echo 111;
    }
}	 




	

















 