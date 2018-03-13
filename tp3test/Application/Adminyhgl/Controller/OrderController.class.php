<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class OrderController extends AdminController {

	public function _initialize(){
		
		parent::_initialize(3);  //权限id，在config/autority.php中配置

	}
	
	//订单总表
    public function index_all(){		
		
		$map['tgs'] = urldecode(I('get.tgs'));
		$map['order_num'] = urldecode(I('get.order_num'));
		$map['t'] = urldecode(I('get.t'));
		$pay_status = urldecode(I('get.pay_status'));
		$add_time_start = urldecode(I('get.addstarttime'));
		$add_time_end = urldecode(I('get.addendtime'));
		
		$map['pay_status'] = isset($pay_status)?$pay_status:'-1';
		
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
		
	
		$bm = D('BzcsUser');	
		
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
		$this->assign('list',$list);
		$this->assign('page',$show); 
		
		$pay_fee_all = $bm->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->sum('a.pay_fee');
		$this->assign('pay_fee_all', $pay_fee_all);
		
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('pay_type', C('PAY_TYPE')); 
		
		$this->assign('map',$map);
		
		$this->assign('is_super_admin',$is_super_admin);
		
    	$this->display();
    }
	

	//八字测算订单列表
    public function index_bzcs(){		
		$export = I('get.export');
		
		$map['tgs'] = urldecode(I('get.tgs'));
		$map['order_num'] = urldecode(I('get.order_num'));
		$map['t'] = urldecode(I('get.t'));
		$pay_status = urldecode(I('get.pay_status'));
		$pay_type = urldecode(I('get.pay_type'));
		$add_time_start = urldecode(I('get.addstarttime'));
		$add_time_end = urldecode(I('get.addendtime'));
		$map['xing'] = urldecode(I('get.xing'));
		$map['ming'] = urldecode(I('get.ming'));
		
		$map['pay_status'] = ($pay_status !== '')?$pay_status:'-1';
		$map['pay_type'] = ($pay_type !== '')?$pay_type:'-1';
		
		if(empty($map['order_num'])){  //查询订单号的时候，不要带上日期，方便用户
			$map['add_time_start'] = !empty($add_time_start)?trim($add_time_start):date('Y-m-d',time()).' 00:00:00';
			$map['add_time_end'] = !empty($add_time_end)?trim($add_time_end):date('Y-m-d',time()+24*3600).' 00:00:00';
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
		
	
		$bm = D('BzcsUser');	
		
		$where = ' 1 ';
		$where .= empty($map['order_num'])?'':' and a.order_num = \'' . $map['order_num'] . '\' ';
		$where .= empty($map['t'])?'':' and a.t in (' . $map['t'] . ') ';
		$where .= ($map['pay_status'] == -1)?'':' and a.is_pay = \'' . $map['pay_status'] . '\' ';
		$where .= ($map['pay_type'] == -1)?'':' and a.pay_type = ' . $map['pay_type'] . ' ';
		$where .= empty($map['add_time_start'])?'':' and a.add_time > \'' . strtotime($map['add_time_start']) . '\' ';
		$where .= empty($map['add_time_end'])?'':' and a.add_time < \'' . strtotime($map['add_time_end']) . '\' ';
		$where .= empty($t_all)?'':' and a.t in (' . implode(',', $t_all) . ') ';
		$where .= empty($map['xing'])?'':' and a.xing=\'' . $map['xing'] . '\' ';
		$where .= empty($map['ming'])?'':' and a.ming=\'' . $map['ming'] . '\' ';
		
		$count      = $bm->alias('a')->where($where)->count();
		$Page       = new \Think\PageAdmin($count,15);
		
		
		$show       = $Page->show();
		
		if($export == 'export'){
			$list = $bm->field('a.*,b.name t_name,c.username tgs')->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('a.add_time desc')->select();
		} else { 
			$list = $bm->field('a.*,b.name t_name,c.username tgs')->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('a.add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		}
//echo '<pre>';print_r($bm);exit;
//if(!empty($map['order_num'])){echo '<pre>';print_r($bm);exit;}
		if($export == 'export'){
	
			$SEX = C('SEX');
			$pay_status = C('PAY_STATUS');
			$pay_type = C('PAY_TYPE');
			
			$Html='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><body>'.chr(13).chr(10);
			$Html.="<table border=1>
			<tr align='center'>
			  <th>订单号</th>
			  <th>姓名</th>
			  <th>出生日期</th>
			  <th>出生时辰</th>
			  <th>性别</th>
			  <th>支付状态</th>
			  <th>支付金额</th>
			  <th>支付方式</th>
			  <th>支付时间</th>
			  <th>测算时间</th>
			  <th>推广商</th>
			  <th>广告位</th>
			  <th>t值</th>
			</tr>";
			
			foreach($list as $vo){
				
				$Html.="<tr align=center>
					<td>".$vo['order_num']."</td>
					<td>".$vo['xing'].$vo['ming']."</td>
					<td>{$vo['year']}年{$vo['month']}月{$vo['day']}日</td>
					<td>".$vo['hour']."</td>
					<td>".$SEX[$vo['sex']]."</td>
					<td>".$pay_status[$vo['is_pay']]."</td>
					<td>".round($vo['pay_fee'] / 100, 2)."</td>
					<td>".$pay_type[$vo['pay_type']]."</td>
					<td>".date('Y-m-d H:i:s', $vo['pay_time'])."</td>
					<td>".date('Y-m-d H:i:s', $vo['add_time'])."</td>
					<td>".$vo['tgs']."</td>
					<td>".$vo['t_name']."</td>
					<td>".$vo['t']."</td>
				</tr>";
			}
			
			$Html.='</table>';
			$Html.='</body></html>';
			$mime_type = 'application/vnd.ms-excel';//导出excel2003
			$mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';//导出excel2007
			header('Content-Type: ' . $mime_type);
			header("Content-Disposition: attachment; filename=".date('Y-m-d',time()).".xls");
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma:private');
			echo $Html;
							
			exit;//必须退出
		}

		$this->assign('list',$list);
		$this->assign('page',$show); 
		
		$pay_fee_all = $bm->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->sum('a.pay_fee');
		$this->assign('pay_fee_all', $pay_fee_all);
		
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('pay_type', C('PAY_TYPE')); 
		$this->assign('SEX', C('SEX'));
		
		$this->assign('map',$map);
		
		$this->assign('is_super_admin',$is_super_admin);
		
    	$this->display();
    }
	
	//八字合婚订单列表
	public function index_bzhh(){		
		$export = I('get.export');
		
		$map['tgs'] = urldecode(I('get.tgs'));
		$map['order_num'] = urldecode(I('get.order_num'));
		$map['t'] = urldecode(I('get.t'));
		$pay_status = urldecode(I('get.pay_status'));
		$add_time_start = urldecode(I('get.addstarttime'));
		$add_time_end = urldecode(I('get.addendtime'));
		$map['nanname'] = urldecode(I('get.nanname'));
		
		$map['pay_status'] = ($pay_status !== '')?$pay_status:'-1';
		
		if(empty($map['order_num'])){  //查询订单号的时候，不要带上日期，方便用户
			$map['add_time_start'] = !empty($add_time_start)?trim($add_time_start):date('Y-m-d',time()).' 00:00:00';
			$map['add_time_end'] = !empty($add_time_end)?trim($add_time_end):date('Y-m-d',time()+24*3600).' 00:00:00';
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
		
	
		$bm = D('BzhhUser');	
		
		$where = ' 1 ';
		$where .= empty($map['order_num'])?'':' and a.order_num like \'%' . $map['order_num'] . '%\' ';
		$where .= empty($map['t'])?'':' and a.t in (' . $map['t'] . ') ';
		$where .= ($map['pay_status'] == -1)?'':' and a.is_pay = ' . $map['pay_status'] . ' ';
		$where .= empty($map['add_time_start'])?'':' and a.add_time > ' . strtotime($map['add_time_start']) . ' ';
		$where .= empty($map['add_time_end'])?'':' and a.add_time < ' . strtotime($map['add_time_end']) . ' ';
		$where .= empty($t_all)?'':' and a.t in (' . implode(',', $t_all) . ') ';
		$where .= empty($map['nanname'])?'':' and a.nanname=\'' . $map['nanname'] . '\' ';
		
		$count      = $bm->alias('a')->where($where)->count();
		$Page       = new \Think\PageAdmin($count,15);
		
		
		$show       = $Page->show();
		
		if($export == 'export'){
			$list = $bm->field('a.*,b.name t_name,c.username tgs')->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('a.add_time desc')->select();
		} else { 
			$list = $bm->field('a.*,b.name t_name,c.username tgs')->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('a.add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		}
//echo '<pre>';print_r($bm);exit;

		if($export == 'export'){
	
			$SEX = C('SEX');
			$pay_status = C('PAY_STATUS');
			$pay_type = C('PAY_TYPE');
			
			$Html='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><body>'.chr(13).chr(10);
			$Html.="<table border=1>
			<tr align='center'>
			  <th>订单号</th>
			  <th>男方姓名</th>
			  <th>男方出生日期</th>
			  <th>女方姓名</th>
			  <th>女方出生日期</th>
			  <th>支付状态</th>
			  <th>支付金额</th>
			  <th>支付方式</th>
			  <th>支付时间</th>
			  <th>测算时间</th>
			  <th>推广商</th>
			  <th>广告位</th>
			  <th>t值</th>
			</tr>";
			
			foreach($list as $vo){
				
				$Html.="<tr align=center>
					<td>".$vo['order_num']."</td>
					<td>".$vo['nanname']."</td>
					<td>".$vo['nanbirthday']."</td>
					<td>".$vo['nvname']."</td>
					<td>".$vo['nvbirthday']."</td>
					<td>".$pay_status[$vo['is_pay']]."</td>
					<td>".round($vo['pay_fee'] / 100, 2)."</td>
					<td>".$pay_type[$vo['pay_type']]."</td>
					<td>".date('Y-m-d H:i:s', $vo['pay_time'])."</td>
					<td>".date('Y-m-d H:i:s', $vo['add_time'])."</td>
					<td>".$vo['tgs']."</td>
					<td>".$vo['t_name']."</td>
					<td>".$vo['t']."</td>
				</tr>";
			}
			
			$Html.='</table>';
			$Html.='</body></html>';
			$mime_type = 'application/vnd.ms-excel';//导出excel2003
			$mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';//导出excel2007
			header('Content-Type: ' . $mime_type);
			header("Content-Disposition: attachment; filename=".date('Y-m-d',time()).".xls");
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma:private');
			echo $Html;
							
			exit;//必须退出
		}
		
		$this->assign('list',$list);
		$this->assign('page',$show); 
		
		$pay_fee_all = $bm->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->sum('a.pay_fee');
		$this->assign('pay_fee_all', $pay_fee_all);
		
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('pay_type', C('PAY_TYPE')); 
		
		$this->assign('map',$map);
		
		$this->assign('is_super_admin',$is_super_admin);
		
    	$this->display();
    }
	
	//姓名分析订单列表
	public function index_xmfx(){		
		$export = I('get.export');
		
		$map['tgs'] = urldecode(I('get.tgs'));
		$map['order_num'] = urldecode(I('get.order_num'));
		$map['t'] = urldecode(I('get.t'));
		$pay_status = urldecode(I('get.pay_status'));
		$add_time_start = urldecode(I('get.addstarttime'));
		$add_time_end = urldecode(I('get.addendtime'));
		$map['xing'] = urldecode(I('get.xing'));
		$map['ming'] = urldecode(I('get.ming'));
		
		$map['pay_status'] = ($pay_status !== '')?$pay_status:'-1';
		
		if(empty($map['order_num'])){  //查询订单号的时候，不要带上日期，方便用户
			$map['add_time_start'] = !empty($add_time_start)?trim($add_time_start):date('Y-m-d',time()).' 00:00:00';
			$map['add_time_end'] = !empty($add_time_end)?trim($add_time_end):date('Y-m-d',time()+24*3600).' 00:00:00';
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
		
	
		$bm = D('XmfxUser');	
		
		$where = ' 1 ';
		$where .= empty($map['order_num'])?'':' and a.order_num like \'%' . $map['order_num'] . '%\' ';
		$where .= empty($map['t'])?'':' and a.t in (' . $map['t'] . ') ';
		$where .= ($map['pay_status'] == -1)?'':' and a.is_pay = ' . $map['pay_status'] . ' ';
		$where .= empty($map['add_time_start'])?'':' and a.add_time > ' . strtotime($map['add_time_start']) . ' ';
		$where .= empty($map['add_time_end'])?'':' and a.add_time < ' . strtotime($map['add_time_end']) . ' ';
		$where .= empty($t_all)?'':' and a.t in (' . implode(',', $t_all) . ') ';
		$where .= empty($map['xing'])?'':' and a.xing=\'' . $map['xing'] . '\' ';
		$where .= empty($map['ming'])?'':' and a.ming=\'' . $map['ming'] . '\' ';
		
		$count      = $bm->alias('a')->where($where)->count();
		$Page       = new \Think\PageAdmin($count,15);
		
		
		$show       = $Page->show();
		
		if($export == 'export'){
			$list = $bm->field('a.*,b.name t_name,c.username tgs')->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('a.add_time desc')->select();
		} else { 
			$list = $bm->field('a.*,b.name t_name,c.username tgs')->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('a.add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();		
		}
//echo '<pre>';print_r($bm);exit;

		if($export == 'export'){
	
			$SEX = C('SEX');
			$pay_status = C('PAY_STATUS');
			$pay_type = C('PAY_TYPE');
			
			$Html='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><body>'.chr(13).chr(10);
			$Html.="<table border=1>
			<tr align='center'>
			  <th>订单号</th>
			  <th>姓名</th>
			  <th>出生日期</th>
			  <th>出生时辰</th>
			  <th>性别</th>
			  <th>支付状态</th>
			  <th>支付金额</th>
			  <th>支付方式</th>
			  <th>支付时间</th>
			  <th>测算时间</th>
			  <th>推广商</th>
			  <th>广告位</th>
			  <th>t值</th>
			</tr>";
			
			foreach($list as $vo){
				
				$Html.="<tr align=center>
					<td>".$vo['order_num']."</td>
					<td>".$vo['xing'].$vo['ming']."</td>
					<td>{$vo['birthday_y']}-{$vo['birthday_m']}-{$vo['birthday_d']}</td>
					<td>".$vo['birthday_h']."</td>
					<td>".$SEX[$vo['sex']]."</td>
					<td>".$pay_status[$vo['is_pay']]."</td>
					<td>".round($vo['pay_fee'] / 100, 2)."</td>
					<td>".$pay_type[$vo['pay_type']]."</td>
					<td>".date('Y-m-d H:i:s', $vo['pay_time'])."</td>
					<td>".date('Y-m-d H:i:s', $vo['add_time'])."</td>
					<td>".$vo['tgs']."</td>
					<td>".$vo['t_name']."</td>
					<td>".$vo['t']."</td>
				</tr>";
			}
			
			$Html.='</table>';
			$Html.='</body></html>';
			$mime_type = 'application/vnd.ms-excel';//导出excel2003
			$mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';//导出excel2007
			header('Content-Type: ' . $mime_type);
			header("Content-Disposition: attachment; filename=".date('Y-m-d',time()).".xls");
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma:private');
			echo $Html;
							
			exit;//必须退出
		}

		$this->assign('list',$list);
		$this->assign('page',$show); 
		
		$pay_fee_all = $bm->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->sum('a.pay_fee');
		$this->assign('pay_fee_all', $pay_fee_all);
		
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('pay_type', C('PAY_TYPE')); 
		$this->assign('SEX', C('SEX'));
		
		$this->assign('map',$map);
		
		$this->assign('is_super_admin',$is_super_admin);
		
    	$this->display();
    }
	
    //在线起名订单列表
    public function index_zxqm(){		
		$export = I('get.export');
		
		$map['tgs'] = urldecode(I('get.tgs'));
		$map['order_num'] = urldecode(I('get.order_num'));
		$map['t'] = urldecode(I('get.t'));
		$pay_status = urldecode(I('get.pay_status'));
		$pay_type = urldecode(I('get.pay_type'));
		$add_time_start = urldecode(I('get.addstarttime'));
		$add_time_end = urldecode(I('get.addendtime'));
		$map['xing'] = urldecode(I('get.xing'));
		
		$map['pay_status'] = ($pay_status !== '')?$pay_status:'-1';
		$map['pay_type'] = ($pay_type !== '')?$pay_type:'-1';
		
		if(empty($map['order_num'])){  //查询订单号的时候，不要带上日期，方便用户
			$map['add_time_start'] = !empty($add_time_start)?trim($add_time_start):date('Y-m-d',time()).' 00:00:00';
			$map['add_time_end'] = !empty($add_time_end)?trim($add_time_end):date('Y-m-d',time()+24*3600).' 00:00:00';
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
		
	
		$bm = D('ZxqmUser');	
		
		$where = ' 1 ';
		$where .= empty($map['order_num'])?'':' and a.order_num like \'%' . $map['order_num'] . '%\' ';
		$where .= empty($map['t'])?'':' and d.t in (' . $map['t'] . ') ';
		$where .= ($map['pay_status'] == -1)?'':' and d.is_pay = ' . $map['pay_status'] . ' ';
		$where .= ($map['pay_type'] == -1)?'':' and d.pay_type = ' . $map['pay_type'] . ' ';
		$where .= empty($map['add_time_start'])?'':' and d.add_time > ' . strtotime($map['add_time_start']) . ' ';
		$where .= empty($map['add_time_end'])?'':' and d.add_time < ' . strtotime($map['add_time_end']) . ' ';
		$where .= empty($t_all)?'':' and d.t in (' . implode(',', $t_all) . ') ';
		$where .= empty($map['xing'])?'':' and a.xing=\'' . $map['xing'] . '\' ';
		
		$count      = $bm->alias('a')->join('left join __ORDER_ALL__ d on a.order_num = d.order_num ')->where($where)->count();
		$Page       = new \Think\PageAdmin($count,15);
		
		
		$show       = $Page->show();
		
		if($export == 'export'){
			$list = $bm->field('a.*,b.name t_name,c.username tgs,d.*')->alias('a')->join('left join __ORDER_ALL__ d on a.order_num = d.order_num ')->join('left join __ADMIN_T__ b on d.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('d.add_time desc')->select();
		} else {
			$list = $bm->field('a.*,b.name t_name,c.username tgs,d.*')->alias('a')->join('left join __ORDER_ALL__ d on a.order_num = d.order_num ')->join('left join __ADMIN_T__ b on d.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('d.add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();			
		}
//echo '<pre>';print_r($bm);exit;
 
 		if($export == 'export'){
	
			$SEX = C('SEX');
			$pay_status = C('PAY_STATUS');
			$pay_type = C('PAY_TYPE');
			
			$Html='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><body>'.chr(13).chr(10);
			$Html.="<table border=1>
			<tr align='center'>
			  <th>订单号</th>
			  <th>姓</th>
			  <th>出生日期</th>
			  <th>出生时辰</th>
			  <th>性别</th>
			  <th>支付状态</th>
			  <th>支付金额</th>
			  <th>支付方式</th>
			  <th>支付时间</th>
			  <th>测算时间</th>
			  <th>推广商</th>
			  <th>广告位</th>
			  <th>t值</th>
			</tr>";
			
			foreach($list as $vo){
				
				$Html.="<tr align=center>
					<td>".$vo['order_num']."</td>
					<td>".$vo['xing']."</td>
					<td>{$vo['year']}年{$vo['month']}月{$vo['day']}日</td>
					<td>".$vo['hour']."</td>
					<td>".$SEX[$vo['sex']]."</td>
					<td>".$pay_status[$vo['is_pay']]."</td>
					<td>".round($vo['pay_fee'] / 100, 2)."</td>
					<td>".$pay_type[$vo['pay_type']]."</td>
					<td>".date('Y-m-d H:i:s', $vo['pay_time'])."</td>
					<td>".date('Y-m-d H:i:s', $vo['add_time'])."</td>
					<td>".$vo['tgs']."</td>
					<td>".$vo['t_name']."</td>
					<td>".$vo['t']."</td>
				</tr>";
			}
			
			$Html.='</table>';
			$Html.='</body></html>';
			$mime_type = 'application/vnd.ms-excel';//导出excel2003
			$mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';//导出excel2007
			header('Content-Type: ' . $mime_type);
			header("Content-Disposition: attachment; filename=".date('Y-m-d',time()).".xls");
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma:private');
			echo $Html;
							
			exit;//必须退出
		}
		
		$this->assign('list',$list);
		$this->assign('page',$show); 
		
		$pay_fee_all = $bm->alias('a')->join('left join __ORDER_ALL__ d on a.order_num = d.order_num ')->where($where)->sum('d.pay_fee');
		$this->assign('pay_fee_all', $pay_fee_all);
		
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('pay_type', C('PAY_TYPE')); 
		$this->assign('SEX', C('SEX'));
		
		$this->assign('map',$map);
		
		$this->assign('is_super_admin',$is_super_admin);
		
    	$this->display();
    }
	
//紫薇排盘订单列表
	public function index_zwpp(){		
		
		$map['tgs'] = urldecode(I('get.tgs'));
		$map['order_num'] = urldecode(I('get.order_num'));
		$map['t'] = urldecode(I('get.t'));
		$pay_status = urldecode(I('get.pay_status'));
		$add_time_start = urldecode(I('get.addstarttime'));
		$add_time_end = urldecode(I('get.addendtime'));
		
		$map['pay_status'] = ($pay_status !== '')?$pay_status:'-1';
		
		if(empty($map['order_num'])){  //查询订单号的时候，不要带上日期，方便用户
			$map['add_time_start'] = !empty($add_time_start)?trim($add_time_start):date('Y-m-d',time()).' 00:00:00';
			$map['add_time_end'] = !empty($add_time_end)?trim($add_time_end):date('Y-m-d',time()+24*3600).' 00:00:00';
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
		
	
		$bm = D('ZwppUser');	
		
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
		$this->assign('list',$list);
		$this->assign('page',$show); 
		
		$pay_fee_all = $bm->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->sum('a.pay_fee');
		$this->assign('pay_fee_all', $pay_fee_all);
		
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('pay_type', C('PAY_TYPE')); 
		$this->assign('SEX', C('SEX'));
		
		$this->assign('map',$map);
		
		$this->assign('is_super_admin',$is_super_admin);
		
    	$this->display();
    }



    //周公解梦订单列表
	public function index_zgjm(){		
		
		$map['tgs'] = urldecode(I('get.tgs'));
		$map['order_num'] = urldecode(I('get.order_num'));
		$map['t'] = urldecode(I('get.t'));
		$pay_status = urldecode(I('get.pay_status'));
		$add_time_start = urldecode(I('get.addstarttime'));
		$add_time_end = urldecode(I('get.addendtime'));
		
		$map['pay_status'] = ($pay_status !== '')?$pay_status:'-1';
		
		if(empty($map['order_num'])){  //查询订单号的时候，不要带上日期，方便用户
			$map['add_time_start'] = !empty($add_time_start)?trim($add_time_start):date('Y-m-d',time()).' 00:00:00';
			$map['add_time_end'] = !empty($add_time_end)?trim($add_time_end):date('Y-m-d',time()+24*3600).' 00:00:00';
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
		
	
		$bm = D('ZgjmUser');	
		
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
		$this->assign('list',$list);
		$this->assign('page',$show); 
		
		$pay_fee_all = $bm->alias('a')->join('left join __ADMIN_T__ b on a.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->sum('a.pay_fee');
		$this->assign('pay_fee_all', $pay_fee_all);
		
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('pay_type', C('PAY_TYPE')); 
		$this->assign('SEX', C('SEX'));
		
		$this->assign('map',$map);
		
		$this->assign('is_super_admin',$is_super_admin);
		
    	$this->display();
    }
	
	//抽签订单列表
    public function index_chouqian(){		
		$export = I('get.export');
		
		$map['tgs'] = urldecode(I('get.tgs'));
		$map['order_num'] = urldecode(I('get.order_num'));
		$map['t'] = urldecode(I('get.t'));
		$map['number'] = urldecode(I('get.number'));
		$pay_status = urldecode(I('get.pay_status'));
		$pay_type = urldecode(I('get.pay_type'));
		$add_time_start = urldecode(I('get.addstarttime'));
		$add_time_end = urldecode(I('get.addendtime'));
		$chouqian_type = urldecode(I('get.chouqian_type'));
		
		$map['pay_status'] = ($pay_status !== '')?$pay_status:'-1';
		$map['pay_type'] = ($pay_type !== '')?$pay_type:'-1';
		$map['chouqian_type'] = ($chouqian_type !== '')?$chouqian_type:'-1';
		
		if(empty($map['order_num'])){  //查询订单号的时候，不要带上日期，方便用户
			$map['add_time_start'] = !empty($add_time_start)?trim($add_time_start):date('Y-m-d',time()).' 00:00:00';
			$map['add_time_end'] = !empty($add_time_end)?trim($add_time_end):date('Y-m-d',time()+24*3600).' 00:00:00';
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
		
	
		$bm = D('ChouqianUser');	
		

		$where = ' 1 ';		
		$where .= empty($map['order_num'])?'':' and d.order_num like \'%' . $map['order_num'] . '%\' ';
		$where .= empty($map['t'])?'':' and d.t in (' . $map['t'] . ') ';
		$where .= ($map['pay_status'] == -1)?'':' and d.is_pay = ' . $map['pay_status'] . ' ';
		$where .= ($map['pay_type'] == -1)?'':' and d.pay_type = ' . $map['pay_type'] . ' ';
		$where .= empty($map['add_time_start'])?'':' and d.add_time > ' . strtotime($map['add_time_start']) . ' ';
		$where .= empty($map['add_time_end'])?'':' and d.add_time < ' . strtotime($map['add_time_end']) . ' ';
		$where .= empty($t_all)?'':' and d.t in (' . implode(',', $t_all) . ') ';
		$where .= empty($map['number'])?'':' and a.number=\'' . $map['number'] . '\' ';
		$where .= ($map['chouqian_type'] == -1)?'':' and a.chouqian_type = ' . $map['chouqian_type'] . ' ';

		
		$count      = $bm->alias('a')->join('left join __ORDER_ALL__ d on a.order_num = d.order_num ')->where($where)->count();
		$Page       = new \Think\PageAdmin($count,15);
		
		
		$show       = $Page->show();
		
		if($export == 'export'){
			$list = $bm->field('a.*,b.name t_name,c.username tgs,d.*')->alias('a')->join('left join __ORDER_ALL__ d on a.order_num = d.order_num ')->join('left join __ADMIN_T__ b on d.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('d.add_time desc')->select();
		} else {
			$list = $bm->field('a.*,b.name t_name,c.username tgs,d.*')->alias('a')->join('left join __ORDER_ALL__ d on a.order_num = d.order_num ')->join('left join __ADMIN_T__ b on d.t = b.id ')->join('left join __ADMIN_USER__ c on b.uid = c.id ')->where($where)->order('d.add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();			
		}
//echo '<pre>';print_r($bm);exit;
 
 		if($export == 'export'){
	
			$SEX = C('SEX');
			$pay_status = C('PAY_STATUS');
			$pay_type = C('PAY_TYPE');
			$chouqian_type = C('CHOUQIAN_TYPE');
			
			$Html='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><body>'.chr(13).chr(10);
			$Html.="<table border=1>
			<tr align='center'>
			  <th>订单号</th>
			  <th>第几签</th>
			  <th>抽签类型</th>
			  <th>支付状态</th>
			  <th>支付金额</th>
			  <th>支付方式</th>
			  <th>支付时间</th>
			  <th>测算时间</th>
			  <th>推广商</th>
			  <th>广告位</th>
			  <th>t值</th>
			</tr>";
			
			foreach($list as $vo){
				
				$Html.="<tr align=center>
					<td>".$vo['order_num']."</td>
					<td>".$vo['number']."</td>
					<td>".$chouqian_type[$vo['chouqian_type']]."</td>
					<td>".$pay_status[$vo['is_pay']]."</td>
					<td>".round($vo['pay_fee'] / 100, 2)."</td>
					<td>".$pay_type[$vo['pay_type']]."</td>
					<td>".date('Y-m-d H:i:s', $vo['pay_time'])."</td>
					<td>".date('Y-m-d H:i:s', $vo['add_time'])."</td>
					<td>".$vo['tgs']."</td>
					<td>".$vo['t_name']."</td>
					<td>".$vo['t']."</td>
				</tr>";
			}
			
			$Html.='</table>';
			$Html.='</body></html>';
			$mime_type = 'application/vnd.ms-excel';//导出excel2003
			$mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';//导出excel2007
			header('Content-Type: ' . $mime_type);
			header("Content-Disposition: attachment; filename=".date('Y-m-d',time()).".xls");
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma:private');
			echo $Html;
							
			exit;//必须退出
		}
		
		$this->assign('list',$list);
		$this->assign('page',$show); 
		
		$pay_fee_all = $bm->alias('a')->join('left join __ORDER_ALL__ d on a.order_num = d.order_num ')->where($where)->sum('d.pay_fee');
		$this->assign('pay_fee_all', $pay_fee_all);
		
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('pay_type', C('PAY_TYPE')); 
		$this->assign('chouqian_type', C('CHOUQIAN_TYPE'));
		
		$this->assign('map',$map);
		
		$this->assign('is_super_admin',$is_super_admin);
		
    	$this->display();
    }
	
}