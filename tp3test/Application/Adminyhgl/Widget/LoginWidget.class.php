<?php

namespace Adminyhgl\Widget;
use Think\Controller;
class LoginWidget extends Controller {
    public function user(){
		$u = D('AdminUser');

		$this->assign('username',$u->getUserName());
		
        $this->display('Login:user');
    }
}