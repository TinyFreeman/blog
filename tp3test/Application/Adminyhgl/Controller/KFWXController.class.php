<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class KFWXController extends AdminController {

	public function _initialize(){
		
		parent::_initialize(6);  //权限id，在config/autority.php中配置

	}
	


    public function index(){
		$map['t'] = urldecode(I('get.t'));
		$map['wx'] = urldecode(I('get.wx'));
		
		$um = D('AdminUser');
		
		$fm = D('AdminWxFans');
		$today_time = $fm->todayTime();
		
  		$m = D('AdminWx');
		
		//$where = "";
		//$where .= empty($t)?"":" t in ($t) ";
		$where = ' 1 ';
		$where .= empty($map['wx'])?'':' and a.wx like \'%' . $map['wx'] . '%\' ';
		$where .= empty($map['t'])?'':' and a.t=' . $map['t'] . ' ';
		
		$count      = $m->where($where)->count();
		$Page       = new \Think\PageAdmin($count,10);
		$show       = $Page->show();
		
		$list = $m->alias('a')->field('a.*,b.name ad_name,c.username tgs')->join('__ADMIN_T__ b on a.t = b.id')->join('__ADMIN_USER__ c on b.uid = c.id')->where($where)->order('a.t desc')->limit($Page->firstRow.','.$Page->listRows)->select();
//echo '<pre>';print_r($m);exit;		
		foreach($list as $k=>$v){
			$r = $fm->where(array('wx_id'=>$v['id'],'time'=>$today_time))->find();
			$list[$k]['fans_num_today'] = empty($r['fans_num'])?0:$r['fans_num'];
			
			$fans_num_all = $fm->where(array('wx_id'=>$v['id']))->sum('fans_num');
			$list[$k]['fans_num_all'] = empty($fans_num_all)?0:$fans_num_all;		
		}

		$this->assign('list',$list);
		$this->assign('page',$show);  
		$this->assign('map',$map);
		
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
			
			//$user_t = $m->userT($u->getUserId());   //取出当前用户所属的所有t
			$user_t = $m->alias('a')->field('a.*,b.username tgs')->join('__ADMIN_USER__ b on a.uid = b.id')->select();
	
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
	
	public function all_action(){
		
		$do = I('post.do');
		
		if($do == 'del'){
			
			$m = D('AdminWx');
			$fm = D('AdminWxFans');
			
			$ids = array();	
			$ids = I('post.ids');
			
			foreach($ids as $id){
				
				if($m->delete($id)){			
					$fm->where('wx_id='.$id)->delete();
					
				}
			}
			
			$this->success('删除成功');
			
		}


	}

}