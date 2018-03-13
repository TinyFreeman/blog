<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class UserController extends AdminController {

	public function _initialize(){
		
		parent::_initialize(1);  //权限id，在config/autority.php中配置

	}
	
	public function verify(){
		$config =    array(
			'fontSize'    =>    30,    // 验证码字体大小
			'length'      =>    3     // 验证码位数
		);
		$Verify = new \Think\Verify($config);
		$Verify->entry();
	}

    public function index(){
		$map['username'] = urldecode(I('get.username'));
		$map['tuiguang_host'] = urldecode(I('get.tuiguang_host'));

		$m = D('AdminUser');
		
		$where = ' 1 ';
		$where .= empty($map['username'])?'':' and a.username like \'%' . $map['username'] . '%\' ';
		$where .= empty($map['tuiguang_host'])?'':' and a.tuiguang_host like \'%' . $map['tuiguang_host'] . '%\' ';
		
		$count      = $m->alias('a')->where($where)->count();
		$Page       = new \Think\PageAdmin($count,10);
		$show       = $Page->show();
		
		$list = $m->field('a.*,b.name rolename,c.username p_name')->alias('a')->join('left join __ADMIN_ROLE__ b on a.roleid = b.id ')->join('left join __ADMIN_USER__ c on a.pid = c.id ')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('list',$list);
		$this->assign('page',$show);
		
		$this->assign('map',$map);
		
    	$this->display();
    }
	
	public function add(){
		
		if(IS_POST){
			
			$m = D('AdminUser');
			$data = I('post.');
			
			if($m->add($data)){
				$this->success('添加成功', U('index'));
			} else {
				$this->error('添加失败');
			}
			
		} else {
			
			$r = D('AdminRole');
			
			$rolelist = $r->roleList();
			$this->assign('rolelist',$rolelist);
			
			$this->display();
			
		}
		
	}
	
	public function update(){
		
		if(IS_POST){
			
			$m = D('AdminUser');
			$data = I('post.');
			
			if(empty($data['password'])){
				unset($data['password']);
			}
			
			if($m->save($data)){
				$this->success('修改成功', U('index'));
			} else {
				$this->error('修改失败');
			}
			
		} else {
			
			$id = I('get.id');
			
			$m = D('AdminUser');
			
			$user = $m->user($id);	
			$this->assign('user',$user);
			
			$r = D('AdminRole');
			
			$rolelist = $r->roleList();
			$this->assign('rolelist',$rolelist);
			
			$this->display();
			
		}
		
	}
	
	public function del(){
		

			
		$id = I('get.id');
		
		$m = D('AdminUser');
			
		if($m->delete($id)){
			$this->success('删除成功', U('index'));
		} else {
			$this->error('删除失败');			
		}

	}
	
	

}