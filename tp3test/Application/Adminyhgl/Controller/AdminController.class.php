<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class AdminController extends Controller {  

    public function _initialize($authority_id){
		$u = D('AdminUser');
		if(!$u->isLog()){
			header("Content-type:text/html;charset=utf-8");
			$this->redirect('Login/login', array(), 1, '请登录...');
		}		
		
		//权限判断
		if(($u->getUserName() != C('ADMIN_USER')) && !empty($authority_id) && !in_array($authority_id, $u->getAuthority())){
			exit('没有权限!');
		}
    }

}