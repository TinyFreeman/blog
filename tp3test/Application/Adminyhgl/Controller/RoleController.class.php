<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class RoleController extends AdminController {  

	public function _initialize(){
		
		parent::_initialize(1);  //权限id，在config/autority.php中配置

	}

    public function index(){

		$m = D('AdminRole');
		
		$where = '';
		
		$count      = $m->where($where)->count();
		$Page       = new \Think\PageAdmin($count,10);
		$show       = $Page->show();
		
		$list = $m->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		
    	$this->display();
    }
	
	public function add(){
		
		if(IS_POST){
			
			$m = D('AdminRole');
			$m->create();
			
			if($m->add()){
				$this->success('添加成功', 'index');
			} else {
				$this->error('添加失败');
			}
			
		} else {
			
			$this->display();
			
		}
		
	}
	
	public function update(){
		
		if(IS_POST){
			
			$m = D('AdminRole');
			$data = I('post.');
			
			if($m->save($data)){
				$this->success('添加成功', U('index'));
			} else {
				$this->error('添加失败');
			}
			
		} else {
			
			$id = I('get.id');
			
			$m = D('AdminRole');	

			$this->assign('role',$m->find($id));
			
			$this->display();
			
		}
		
	}
	
	public function del(){
		
		$id = I('get.id');
		
		$m = D('AdminRole');
			
		if($m->delete($id)){
			$this->success('删除成功', U('index'));
		} else {
			$this->error('删除失败');			
		}

	}

}