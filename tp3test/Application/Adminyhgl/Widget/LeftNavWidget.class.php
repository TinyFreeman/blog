<?php

namespace Adminyhgl\Widget;
use Think\Controller;
class LeftNavWidget extends Controller {
    public function leftlist(){
		$u = D('AdminUser');
		
		$this->assign('is_super_admin',$u->isSuperAdmin());
		
		$this->assign('userAuthority',$u->getAuthority());
		
        $this->display('LeftNav:leftlist');
    }
}