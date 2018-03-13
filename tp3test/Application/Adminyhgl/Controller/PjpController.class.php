<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class PjpController extends AdminController {

	public function _initialize(){
		
		parent::_initialize(2);  //权限id，在config/autority.php中配置

	}
	


    public function index(){

	 	if(IS_POST){
			
			$m = D('PayPc');
			$data = I('post.');			
			 
		    
			 
			
			if($m->save($data) !== false){				
				$this->success('修改成功', U('index'));
			} else {
				$this->error('修改失败');
			}
			
		} else {
			
			 
		 
			$m = D('PayPc');
			
			$r = $m->find("1");	
			  
			$this->assign('pj',$r);
			$this->display();
			
		}
    }
	
	 
	
	 
		
 
	
	 
	
	


}