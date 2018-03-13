<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class AuthorityController extends AdminController { 

	public function _initialize(){
		
		parent::_initialize(1);  //权限id，在config/autority.php中配置

	} 

	public function edit(){
		
		if(IS_POST){
		
			$m = D('AdminRoleAuthority');
			$data = I('post.');
			
			if($m->save($data)){
				$this->success('添加成功', U('Role/index'));
			} else {
				$this->error('添加失败');
			}
			
		} else {
			
			$roleid = I('get.roleid');
			
			$this->assign('roleid', I('get.roleid'));
			
			$m = D('AdminRoleAuthority');
			$a = $m->find($roleid);
					
			$this->assign('role_authority', explode(',', $a['authority']));
			
			$this->assign('authority', C('AUTHORITY'));
			
			$this->display();
			
		}
		
	}
}