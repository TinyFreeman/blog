<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class KFTController extends AdminController {

	public function _initialize(){
		
		parent::_initialize(6);  //权限id，在config/autority.php中配置

	}
	


    public function index(){
		
		$map['t'] = urldecode(I('get.t'));
		$map['tgs'] = urldecode(I('get.tgs'));
		$map['name'] = urldecode(I('get.name'));
		$old_map_t = $map['t'];
		
 		$m = D('AdminT');
		$u = D('AdminUser');
		
		//如果有搜索广告位名称，先搜索出对应的t，再合并到搜索的t，看看有没有非法查询
		if(!empty($map['name'])){
			$name_t = $m->field('id t')->where('name like \'%'.$map['name'].'%\'')->select();
			foreach($name_t as $v){
				$name_t_str .= $v['t'] . ',';
			}
			$name_t_str = trim($name_t_str,',');
			if(empty($map['t'])){
				$map['t'] = $name_t_str;
			} else {
				$map['t'] .= ',' . $name_t_str;
			}
		}
		
		$where = ' 1 ';
		$where .= empty($map['t'])?'':' and a.id in (' . $map['t'] . ') ';
		$where .= empty($map['tgs'])?'':' and b.username like \'%' . $map['tgs'] . '%\' ';	
		
		$count      = $m->alias('a')->where($where)->count();
		$Page       = new \Think\PageAdmin($count,10);
		$show       = $Page->show();
		
		$list = $m->alias('a')->field('a.*,b.username tgs')->join('__ADMIN_USER__ b on a.uid = b.id')->where($where)->order('a.id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('list',$list);
		$this->assign('page',$show);

		if($no_serch_t){
			$map['t'] = '';
		}
		
		$this->assign('wx_show', C('CHECK'));		
		
		$map['t'] = $old_map_t;
		$this->assign('map',$map);		
		
    	$this->display();
    }
	
	public function add(){
		
		if(IS_POST){
			
			$m = D('AdminT');
			$data = I('post.');
			
			if($m->add($data)){
				$this->success('添加成功', U('index'));
			} else {
				$this->error('添加失败');
			}
			
		} else {			
			$m = D('AdminT');
			
			$this->assign('t',$m->nextId());
			
			$this->assign('wx_show', C('CHECK'));
			
			$m = D('AdminUser');
			$user_id = $m->getUserId();
			$user_info = $m->find($user_id);
			$tuiguang_host = empty($user_info['tuiguang_host'])?$_SERVER['HTTP_HOST']:$user_info['tuiguang_host'];
			$this->assign('tuiguang_host', $tuiguang_host);
			
			$this->display();
			
		}
		
	}
	
	public function update(){
		
		if(IS_POST){
			
			$m = D('AdminT');
			$data = I('post.');
			
			if($m->save($data)){
				$this->success('修改成功', U('index'));
			} else {
				$this->error('修改失败');
			}
			
		} else {
			
			$id = I('get.id');
			
			$m = D('AdminT');
			
			$t_info = $m->find($id);	

			$this->assign('t_info',$t_info);
			$this->assign('sl_show', C('CHECK'));
			$this->assign('wx_show', C('CHECK'));
			$this->assign('wx_et', C('CHECK'));
			$this->assign('anli_show', C('CHECK'));
			$this->display();
			
		}
		
	}
	
	public function del(){
	
		$id = I('get.id');
		
		$m = D('AdminT');
			
		if($m->delete($id)){
			
			//该t下的所有微信号也要删除
			$wm = D('AdminWx');
			$wm->where(array('t' => $id))->delete();
			
			$this->success('删除成功', U('index'));
		} else {
			$this->error('删除失败');			
		}

	}
	
	public function adurl(){
		$t = I('get.t');
		$this->assign('t',$t);
		$this->assign('host',$_SERVER['HTTP_HOST']);
		$this->display();
	}
	
	public function all_action(){
		
		$do = I('post.do');
		
		if($do == 'add_wx'){
			
			$do_post = I('post.do_post');
			
			//下面的ids应该是t，写错了懒得改了
			if(!empty($do_post)){
				
				$data = I('post.');
				
				$ids = I('post.ids');
				$ids = explode(',', $ids);
				
				$m = D('AdminWx');
				
				foreach($ids as $t){
					
					$data['t'] = $t;
					
					$ran = rand(100,999);
					$filename_qr = 't' . $t . '_qr_' . $ran;

					$data['qrcode'] = upload_pic('qrcode', $filename_qr.'.jpg');
					
					$m->add($data);
				}	
				
				
				$this->success('批量添加成功', U('index'));
				
				
			} else {
				
				$ids = array();	
				$ids = I('post.ids');
				$ids = implode(',', $ids);
				$this->assign('ids',$ids);
				$this->display('all_action_add_wx');
				
			}
			
		}


	}

}