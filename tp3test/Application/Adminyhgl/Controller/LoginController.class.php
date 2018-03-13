<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class LoginController extends Controller {  

	public function login(){
		if(IS_POST){
			$m = D('AdminUser');
			if($m->loginVerify(I('post.'))){
				$this->success('登录成功', U('Index/index'));
			} else {
				$this->error('用户名或密码错误');
			}
		} else {
			$this->display('User/login');
		}	
	}
	
	public function logout(){
		$m = D('AdminUser');
		$m->logout();
		$this->success('退出成功', U('login'));
	}

}