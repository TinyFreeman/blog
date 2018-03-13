<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class UserController extends Controller {  

    public function index(){

		$m = D('AdminUser');
		
		$where = '';
		
		$m->setWhere($where);
		
		$count      = $m->count();

		$Page       = new \Think\PageAdmin($count,10);
		$show       = $Page->show();
		
		$limit = $Page->firstRow.','.$Page->listRows;
		
		$m->setLimit($limit);
		
		$list = $m->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		
    	$this->display();
    }
	
	public function add(){
		
		if(IS_POST){
			
			$m = D('AdminUser');
			$data = I('post.');
			
			if($m->add($data)){
				$this->success('添加成功', 'User/index');
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
			
			if($m->save($data)){
				$this->success('添加成功', 'User/index');
			} else {
				$this->error('添加失败');
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
	
	

}