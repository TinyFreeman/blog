<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class WXController extends AdminController {

	public function _initialize(){
		
		parent::_initialize(2);  //权限id，在config/autority.php中配置

	}
	


    public function index(){
		$map['t'] = urldecode(I('get.t'));
		$map['wx'] = urldecode(I('get.wx'));
		
		$um = D('AdminUser');
		
		$fm = D('AdminWxFans');
		$today_time = $fm->todayTime();
		
		if(!$um->isSuperAdmin()){ //不是超级管理员，则取出用户所有的t下的微信号
			
			$tm = D('AdminT');
			$t = implode(',', $tm->userT($um->getUserId()));	
			
			if(empty($t)){   //如果当前用户还没有t，要给个查不到的默认值，否则下面的where会把所有微信号查出来
				$t = -1;
			}
		}
		
  		$m = D('AdminWx');
		
		$where = ' 1 ';
		$where .= empty($map['wx'])?'':' and wx like \'%' . $map['wx'] . '%\' ';
		if(!$um->isSuperAdmin()){
			$where .= empty($t)?"":" and t in ($t) ";
		}else{
			$where .= empty($map['t'])?'':' and t=' . $map['t'] . ' ';
		}		
		
		$count      = $m->where($where)->count();
		$Page       = new \Think\PageAdmin($count,10);
		$show       = $Page->show();
		
		$list = $m->field('*')->where($where)->order('t desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		foreach($list as $k=>$v){
			$r = $fm->where(array('wx_id'=>$v['id'],'time'=>$today_time))->find();
			$list[$k]['fans_num_today'] = empty($r['fans_num'])?0:$r['fans_num'];
			
			$fans_num_all = $fm->where(array('wx_id'=>$v['id']))->sum('fans_num');
			$list[$k]['fans_num_all'] = empty($fans_num_all)?0:$fans_num_all;		
		}

		$this->assign('list',$list);
		$this->assign('page',$show);  
		$this->assign('map',$map);
		$this->assign('isSuperAdmin',$um->isSuperAdmin());
		
    	$this->display();
    }
	
	public function add(){
		
		if(IS_POST){
			
			$m = D('AdminWx');
			$data = I('post.');
			$t = I('post.t');
			
			$ran = rand(100,999);
			$filename_qr = 't' . $t . '_qr_' . $ran;

			$data['qrcode'] = upload_pic('qrcode', $filename_qr.'.jpg');	
			
			if($m->add($data)){
				$this->success('添加成功', U('index'));
			} else {
				$this->error('添加失败');
			}
			
		} else {
			
			$m = D('AdminT');
			$u = D('AdminUser');
			
			$user_t = $m->userT($u->getUserId());   //取出当前用户所属的所有t
	
			if(empty($user_t)){  //如果还没有添加有t，是不能添加微信号的，要跳转到先添加t的页面
				header("Content-type:text/html;charset=utf-8");
				$this->redirect('T/add', array(), 3, '微信号是和渠道关联，请先添加一个渠道');
			}
			
			$this->assign('user_t', $user_t);
			
			$this->display();
			
		}
		
	}
	
	public function update(){
		
		if(IS_POST){
			
			$m = D('AdminWx');
			$data = I('post.');			
			$t = I('post.t');
			
			$ran = rand(100,999);
			
			$filename_qr = I('post.qrcode_name');
			if(empty($filename_qr)){				
				$filename_qr = 't' . $t . '_qr_' . $ran . '.jpg';
			}
			
			$qr_up = upload_pic('qrcode', $filename_qr);
			if($qr_up !== false){
				$data['qrcode'] = $qr_up;
			}
			
			if($m->save($data) !== false){				
				$this->success('修改成功', U('index'));
			} else {
				$this->error('修改失败');
			}
			
		} else {
			
			$id = I('get.id');
			
			$m = D('AdminWx');
			
			$r = $m->find($id);	

			$this->assign('wx',$r);
			
			$this->assign('qrcode_name', end(explode('/', $r['qrcode'])));
			
			$this->display();
			
		}
		
	}
	
	public function del(){
	
		$id = I('get.id');
		
		$m = D('AdminWx');
			
		if($m->delete($id)){
			$fm = D('AdminWxFans');
			$fm->where('wx_id='.$id)->delete();
			$this->success('删除成功', U('index'));
		} else {
			$this->error('删除失败');			
		}

	}
	
	public function index_t(){
		
		$t = I('get.t');		
		numeric($t);
		
		$fm = D('AdminWxFans');
		$today_time = $fm->todayTime();

  		$m = D('AdminWx');
		
		$where = " a.t = {$t} ";
		
		$count      = $m->alias('a')->where($where)->count();
		$Page       = new \Think\PageAdmin($count,10);
		$show       = $Page->show();
		
		//$sql = "select a.*,sum(b.fans_num) fans_num_all,c.fans_num fans_num_today from __PREFIX__admin_wx a left join __PREFIX__admin_wx_fans b on a.id = b.wx_id left join __PREFIX__admin_wx_fans c on a.id = c.wx_id where {$where} order by a.t limit {$Page->firstRow},{$Page->listRows}";
		$list = $m->alias('a')->field('a.*')->where($where)->order('a.t desc')->limit($Page->firstRow.','.$Page->listRows)->select();
//echo $sql;exit;
//echo '<pre>';print_r($m);exit;			
		
		foreach($list as $k=>$v){
			$r = $fm->where(array('wx_id'=>$v['id'],'time'=>$today_time))->find();
			$list[$k]['fans_num_today'] = empty($r['fans_num'])?0:$r['fans_num'];
			
			$fans_num_all = $fm->where(array('wx_id'=>$v['id']))->sum('fans_num');
			$list[$k]['fans_num_all'] = empty($fans_num_all)?0:$fans_num_all;
	//echo '<pre>';print_r($fm);exit;		
		}
		

		$this->assign('list',$list);
		$this->assign('page',$show);  
		
		$this->assign('t', $t);
		
    	$this->display();
    }
	
	public function add_t(){
		
		if(IS_POST){
			
			$m = D('AdminWx');
			$data = I('post.');		
			$t = I('post.t');
			
			$ran = rand(100,999);
			$filename_qr = 't' . $t . '_qr_' . $ran;

			$data['qrcode'] = upload_pic('qrcode', $filename_qr.'.jpg');
			
			if($m->add($data)){
				$this->success('添加成功', U('index_t', array('t'=>$t)));
			} else {
				$this->error('添加失败');
			}
			
		} else {
			$t = I('get.t');
			numeric($t);
			
			$this->assign('t', $t);
			
			$this->display();
			
		}
		
	}
	
	public function update_t(){
		
		if(IS_POST){
			
			$m = D('AdminWx');
			$data = I('post.');
			$t = I('post.t');
			
			$ran = rand(100,999);
			
			$filename_qr = I('post.qrcode_name');
			if(empty($filename_qr)){				
				$filename_qr = 't' . $t . '_qr_' . $ran . '.jpg';
			}
			
			$qr_up = upload_pic('qrcode', $filename_qr);
			if($qr_up !== false){
				$data['qrcode'] = $qr_up;
			}
			
			if($m->save($data) !== false){				
				$this->success('修改成功', U('index_t', array('t'=>$t)));
			} else {
				$this->error('修改失败');
			}
			
		} else {
			$t = I('get.t');
			numeric($t);
			
			$id = I('get.id');
			numeric($id);
			
			$m = D('AdminWx');
			
			$r = $m->find($id);	
			$this->assign('wx',$r);
			
			$this->assign('qrcode_name', end(explode('/', $r['qrcode'])));
			
			$this->assign('t', $t);
			$this->display();
			
		}
		
	}
	
	public function del_t(){
		$t = I('get.t');
		numeric($t);
	
		$id = I('get.id');
		numeric($id);
		
		$m = D('AdminWx');
			
		if($m->delete($id)){
			$this->success('删除成功', U('index_t', array('t'=>$t)));
		} else {
			$this->error('删除失败');			
		}

	}

}