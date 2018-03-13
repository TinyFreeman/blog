<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class PjController extends AdminController {

	public function _initialize(){
		
		parent::_initialize(2);  //权限id，在config/autority.php中配置

	}
	


    public function index(){
	 	 
  		$m = D('PayTiao');
		
		$where = "1";
	 
		$count      = $m->where($where)->count();
		$Page       = new \Think\PageAdmin($count,10);
		$show       = $Page->show();
		
		$list = $m->field('*')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		 

		$this->assign('list',$list);
		$this->assign('page',$show);  
		
		
    	$this->display();
    }
	
	public function add(){
		
		if(IS_POST){
			
			$m = D('PayTiao');
			$data = I('post.');
		 	
			 
			
			if($m->add($data)){
				$this->success('添加成功', U('index'));
			} else {
				$this->error('添加失败');
			}
			
		} else {
			
			 
			
			$this->display();
			
		}
		
	}
	
	public function update(){
		
		if(IS_POST){
			
			$m = D('PayTiao');
			$data = I('post.');			
			 
		 	// print_r($data);die;
			 
			
			if($m->save($data) !== false){				
				$this->success('修改成功', U('index'));
			} else {
				$this->error('修改失败');
			}
			
		} else {
			
			$id = I('get.id');
		 
			$m = D('PayTiao');
			
			$r = $m->find($id);	
			 
			$this->assign('pj',$r);
			

			$this->display();
			
		}
		
	}
	
	public function del(){
	
		$id = I('get.id');
		
		$m = D('PayTiao');
			
		if($m->delete($id)){
			 
		 
			$this->success('删除成功', U('index'));
		} else {
			$this->error('删除失败');			
		}

	}
	
	


}