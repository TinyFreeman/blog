<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class OrdersController extends AdminController {

	public function _initialize(){
		
		parent::_initialize(3);  //权限id，在config/autority.php中配置

	}
	
	 
	//八字测算订单列表
    public function index(){		
		
		$map['tgs'] = urldecode(I('get.tgs'));
		$map['order_num'] = urldecode(I('get.order_num'));
		$map['t'] = urldecode(I('get.t'));
		$pay_status = urldecode(I('get.pay_status'));
		$add_time_start = urldecode(I('get.addstarttime'));
		$add_time_end = urldecode(I('get.addendtime'));
		
		$map['pay_status'] = ($pay_status !== '')?$pay_status:'-1';
		
		if(empty($map['order_num'])){  //查询订单号的时候，不要带上日期，方便用户
			$map['add_time_start'] = !empty($add_time_start)?trim($add_time_start):date('Y-m-d',time()).' 00:01';
			$map['add_time_end'] = !empty($add_time_end)?trim($add_time_end):date('Y-m-d',time()).' 23:59';
		}

 		$m = D('AdminUser');	

		$is_super_admin = $m->isSuperAdmin();
		
		if(!$is_super_admin){ //不是超级管理员，只能查看自己名下的t
			$uid_all = $m->sonUser($m->getUserId());	
			
			$tm = D('AdminT');		
			$t_all = $tm->userT($uid_all);
			
			if(empty($t_all)){   //如果当前用户还没有t，要给个查不到的默认值，否则下面的where会把所有订单查出来
				$t_all = -1;
			}
		}
		
		if($is_super_admin && (!empty($map['tgs']))){ //如果超级管理员搜索推广商的所有订单
			$tm = D('AdminT');		
			$t_all = $tm->usernameT($map['tgs']);
		}
		
	
		$bm = D('order_all');	
		
		$where = ' 1 ';
		$where .= empty($map['order_num'])?'':' and a.order_num like \'%' . $map['order_num'] . '%\' ';
		$where .= empty($map['t'])?'':' and a.t in (' . $map['t'] . ') ';
		$where .= ($map['pay_status'] == -1)?'':' and a.is_pay = ' . $map['pay_status'] . ' ';
		$where .= empty($map['add_time_start'])?'':' and a.add_time > ' . strtotime($map['add_time_start']) . ' ';
		$where .= empty($map['add_time_end'])?'':' and a.add_time < ' . strtotime($map['add_time_end']) . ' ';
		$where .= empty($t_all)?'':' and a.t in (' . implode(',', $t_all) . ') ';
		
		$count      = $bm->alias('a')->where($where)->count();
		$Page       = new \Think\PageAdmin($count,15);
		
		
		$show       = $Page->show();
		
		$list = $bm->field('a.*,b.name t_name,c.username tgs')->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('a.add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
 //echo '<pre>';print_r($bm);exit;
//	
		$this->assign('list',$list);
		$this->assign('page',$show); 
		
		$pay_fee_all = $bm->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->sum('a.pay_fee');
		
		$this->assign('pay_fee_all', $pay_fee_all);
		
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('pay_type', C('PAY_TYPE'));

		$this->assign('ftype', C('FTYPE'));
	  
	 
		
		$this->assign('map',$map);
		
		$this->assign('is_super_admin',$is_super_admin);
		
    	$this->display();
    }
 

}