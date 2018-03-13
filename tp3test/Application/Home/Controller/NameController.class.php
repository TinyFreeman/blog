<?php

namespace Home\Controller;
use       Think\Controller;
header("Content-type: text/html; charset=utf-8");
class NameController extends IndexController {
    public function index(){
    	
    	echo $this->test1();
    	
		
    }	

    public function test1()
    {
        echo 222;
    }

		
}	 




	

















 