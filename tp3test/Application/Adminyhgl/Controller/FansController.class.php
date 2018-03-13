<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class FansController extends AdminController { 

	public function _initialize(){
		
		parent::_initialize(2);  //权限id，在config/autority.php中配置

	} 

	public function today_fans(){
		
		if(IS_POST){
		
			$m = D('AdminWxFans');
			$data = I('post.');
			
			if($m->save($data)){
				$this->success('编辑成功', U('WX/index'));
			} else {
				$this->error('编辑失败');
			}
			
		} else {
			
			$wx_id = I('get.wx_id');
			numeric($wx_id);
			
			$m = D('AdminWxFans');
			$today_fans = $m->fansNum($wx_id);			
			$this->assign('today_fans', $today_fans);
			
			$this->assign('wx_id', $wx_id);
			$this->display();			
		}
		
	}
	
	public function index(){
		
		$wx_id = I('get.wx_id');
		numeric($wx_id);
		
		$wm = D('AdminWx');
		$wx = $wm->find($wx_id);
		$this->assign('wx', $wx['wx']);
		
		$add_time_start = urldecode(I('get.addstarttime'));
		$add_time_end = urldecode(I('get.addendtime'));
		$map['add_time_start'] = !empty($add_time_start)?trim($add_time_start):date('Y-m-d',time()).' 00:01';
		$map['add_time_end'] = !empty($add_time_end)?trim($add_time_end):date('Y-m-d',time()).' 23:59';

		$bm = D('AdminWxFans');	
		
		$where = ' a.wx_id = ' . $wx_id;
		$where .= empty($map['add_time_start'])?'':' and a.time >= ' . strtotime($map['add_time_start']) . ' ';
		$where .= empty($map['add_time_end'])?'':' and a.time <= ' . strtotime($map['add_time_end']) . ' ';
		
		$count      = $bm->alias('a')->where($where)->count();
		$Page       = new \Think\PageAdmin($count,15);
		
		
		$show       = $Page->show();
		
		$list = $bm->alias('a')->where($where)->order('a.time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
//echo '<pre>';print_r($bm);exit;
		$this->assign('list',$list);
		$this->assign('page',$show); 
		
		$fans_count = $bm->alias('a')->where($where)->sum('a.fans_num');
		$this->assign('fans_count', $fans_count);
		
		$this->assign('map',$map);
		
		$this->assign('wx_id',$wx_id);
		
		$this->display();
	}
}