<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class TongjiController extends AdminController {

	public function _initialize(){
		
		parent::_initialize(4);  //权限id，在config/autority.php中配置

	}
	


    public function index(){
		$tm = D('Tongji');
		$bcm = D('BzcsUser');
		$bhm = D('BzhhUser');
		$xfm = D('XmfxUser');
		$zxq = D('OrderAll');
		$zgj = D('ZgjmUser');
		$zwp = D('ZwppUser');


		//今日时间戳
		$time_start_today = strtotime(date('Y-m-d',time()).' 00:00');
		$time_end_today = strtotime(date('Y-m-d',time()).' 23:59');
		//昨日时间戳
		$time_start_yesterday = strtotime(date('Y-m-d',time()-3600*24).' 00:00');
		$time_end_yesterday = strtotime(date('Y-m-d',time()-3600*24).' 23:59');
		//本周时间戳
		$time_start_week = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
		$time_end_week = mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
		//本月时间戳
		$time_start_month = mktime(0,0,0,date('m'),1,date('Y'));
		$time_end_month = mktime(23,59,59,date('m'),date('t'),date('Y'));
		
		//八字测试统计
		$bacs_today_no_pay = $tm->pay($bcm, 0, $time_start_today, $time_end_today);
		$bacs_today_pay = $tm->pay($bcm, 1, $time_start_today, $time_end_today);
		
		$bacs_yesterday_no_pay = $tm->pay($bcm, 0, $time_start_yesterday, $time_end_yesterday);
		$bacs_yesterday_pay = $tm->pay($bcm, 1, $time_start_yesterday, $time_end_yesterday);
		
		$bacs_week_no_pay = $tm->pay($bcm, 0, $time_start_week, $time_end_week);
		$bacs_week_pay = $tm->pay($bcm, 1, $time_start_week, $time_end_week);
		
		$bacs_month_no_pay = $tm->pay($bcm, 0, $time_start_month, $time_end_month);
		$bacs_month_pay = $tm->pay($bcm, 1, $time_start_month, $time_end_month);
		
		$this->assign('bacs_today_no_pay',$bacs_today_no_pay);
		$this->assign('bacs_today_pay',$bacs_today_pay);
		$this->assign('bacs_yesterday_no_pay',$bacs_yesterday_no_pay);
		$this->assign('bacs_yesterday_pay',$bacs_yesterday_pay);
		$this->assign('bacs_week_no_pay',$bacs_week_no_pay);
		$this->assign('bacs_week_pay',$bacs_week_pay);
		$this->assign('bacs_month_no_pay',$bacs_month_no_pay);
		$this->assign('bacs_month_pay',$bacs_month_pay);
		
		//八字合婚统计
		$bzhh_today_no_pay = $tm->pay($bhm, 0, $time_start_today, $time_end_today);
		$bzhh_today_pay = $tm->pay($bhm, 1, $time_start_today, $time_end_today);
		
		$bzhh_yesterday_no_pay = $tm->pay($bhm, 0, $time_start_yesterday, $time_end_yesterday);
		$bzhh_yesterday_pay = $tm->pay($bhm, 1, $time_start_yesterday, $time_end_yesterday);
		
		$bzhh_week_no_pay = $tm->pay($bhm, 0, $time_start_week, $time_end_week);
		$bzhh_week_pay = $tm->pay($bhm, 1, $time_start_week, $time_end_week);		
		$bzhh_month_no_pay = $tm->pay($bhm, 0, $time_start_month, $time_end_month);
		$bzhh_month_pay = $tm->pay($bhm, 1, $time_start_month, $time_end_month);
		
		$this->assign('bzhh_today_no_pay',$bzhh_today_no_pay);
		$this->assign('bzhh_today_pay',$bzhh_today_pay);
		$this->assign('bzhh_yesterday_no_pay',$bzhh_yesterday_no_pay);
		$this->assign('bzhh_yesterday_pay',$bzhh_yesterday_pay);
		$this->assign('bzhh_week_no_pay',$bzhh_week_no_pay);
		$this->assign('bzhh_week_pay',$bzhh_week_pay);
		$this->assign('bzhh_month_no_pay',$bzhh_month_no_pay);
		$this->assign('bzhh_month_pay',$bzhh_month_pay);
		
		//姓名分析统计
		$xmfx_today_no_pay = $tm->pay($xfm, 0, $time_start_today, $time_end_today);
		$xmfx_today_pay = $tm->pay($xfm, 1, $time_start_today, $time_end_today);
		
		$xmfx_yesterday_no_pay = $tm->pay($xfm, 0, $time_start_yesterday, $time_end_yesterday);
		$xmfx_yesterday_pay = $tm->pay($xfm, 1, $time_start_yesterday, $time_end_yesterday);
		
		$xmfx_week_no_pay = $tm->pay($xfm, 0, $time_start_week, $time_end_week);
		$xmfx_week_pay = $tm->pay($xfm, 1, $time_start_week, $time_end_week);		
		$xmfx_month_no_pay = $tm->pay($xfm, 0, $time_start_month, $time_end_month);
		$xmfx_month_pay = $tm->pay($xfm, 1, $time_start_month, $time_end_month);
		
		$this->assign('xmfx_today_no_pay',$xmfx_today_no_pay);
		$this->assign('xmfx_today_pay',$xmfx_today_pay);
		$this->assign('xmfx_yesterday_no_pay',$xmfx_yesterday_no_pay);
		$this->assign('xmfx_yesterday_pay',$xmfx_yesterday_pay);
		$this->assign('xmfx_week_no_pay',$xmfx_week_no_pay);
		$this->assign('xmfx_week_pay',$xmfx_week_pay);
		$this->assign('xmfx_month_no_pay',$xmfx_month_no_pay);
		$this->assign('xmfx_month_pay',$xmfx_month_pay);


		//在线起名统计
		$zxqm_where = ' and order_f = \'zxqm_user\' ';
		$zxqm_today_no_pay = $tm->pay($zxq, 0, $time_start_today, $time_end_today, $zxqm_where);
		$zxqm_today_pay = $tm->pay($zxq, 1, $time_start_today, $time_end_today, $zxqm_where);
		
		$zxqm_yesterday_no_pay = $tm->pay($zxq, 0, $time_start_yesterday, $time_end_yesterday, $zxqm_where);
		$zxqm_yesterday_pay = $tm->pay($zxq, 1, $time_start_yesterday, $time_end_yesterday, $zxqm_where);
		
		$zxqm_week_no_pay = $tm->pay($zxq, 0, $time_start_week, $time_end_week, $zxqm_where);
		$zxqm_week_pay = $tm->pay($zxq, 1, $time_start_week, $time_end_week, $zxqm_where);		
		$zxqm_month_no_pay = $tm->pay($zxq, 0, $time_start_month, $time_end_month, $zxqm_where);
		$zxqm_month_pay = $tm->pay($zxq, 1, $time_start_month, $time_end_month, $zxqm_where);
		 
		$this->assign('zxqm_today_no_pay',$zxqm_today_no_pay);
		$this->assign('zxqm_today_pay',$zxqm_today_pay);
		$this->assign('zxqm_yesterday_no_pay',$zxqm_yesterday_no_pay);
		$this->assign('zxqm_yesterday_pay',$zxqm_yesterday_pay);
		$this->assign('zxqm_week_no_pay',$zxqm_week_no_pay);
		$this->assign('zxqm_week_pay',$zxqm_week_pay);
		$this->assign('zxqm_month_no_pay',$zxqm_month_no_pay);
		$this->assign('zxqm_month_pay',$zxqm_month_pay);

		//紫薇排盘统计
		$zwpp_today_no_pay = $tm->pay($zwp, 0, $time_start_today, $time_end_today);
		$zwpp_today_pay = $tm->pay($zwp, 1, $time_start_today, $time_end_today);
		
		$zwpp_yesterday_no_pay = $tm->pay($zwp, 0, $time_start_yesterday, $time_end_yesterday);
		$zwpp_yesterday_pay = $tm->pay($zwp, 1, $time_start_yesterday, $time_end_yesterday);
		
		$zwpp_week_no_pay = $tm->pay($zwp, 0, $time_start_week, $time_end_week);
		$zwpp_week_pay = $tm->pay($zwp, 1, $time_start_week, $time_end_week);		
		$zwpp_month_no_pay = $tm->pay($zwp, 0, $time_start_month, $time_end_month);
		$zwpp_month_pay = $tm->pay($zwp, 1, $time_start_month, $time_end_month);
		 
		$this->assign('zwpp_today_no_pay',$zwpp_today_no_pay);
		$this->assign('zwpp_today_pay',$zwpp_today_pay);
		$this->assign('zwpp_yesterday_no_pay',$zwpp_yesterday_no_pay);
		$this->assign('zwpp_yesterday_pay',$zwpp_yesterday_pay);
		$this->assign('zwpp_week_no_pay',$zwpp_week_no_pay);
		$this->assign('zwpp_week_pay',$zwpp_week_pay);
		$this->assign('zwpp_month_no_pay',$zwpp_month_no_pay);
		$this->assign('zwpp_month_pay',$zwpp_month_pay);

		//周公解梦统计
		$zgjm_today_no_pay = $tm->pay($zgj, 0, $time_start_today, $time_end_today);
		$zgjm_today_pay = $tm->pay($zgj, 1, $time_start_today, $time_end_today);
		
		$zgjm_yesterday_no_pay = $tm->pay($zgj, 0, $time_start_yesterday, $time_end_yesterday);
		$zgjm_yesterday_pay = $tm->pay($zgj, 1, $time_start_yesterday, $time_end_yesterday);
		
		$zgjm_week_no_pay = $tm->pay($zgj, 0, $time_start_week, $time_end_week);
		$zgjm_week_pay = $tm->pay($zgj, 1, $time_start_week, $time_end_week);		
		$zgjm_month_no_pay = $tm->pay($zgj, 0, $time_start_month, $time_end_month);
		$zgjm_month_pay = $tm->pay($zgj, 1, $time_start_month, $time_end_month);
		 
		$this->assign('zgjm_today_no_pay',$zgjm_today_no_pay);
		$this->assign('zgjm_today_pay',$zgjm_today_pay);
		$this->assign('zgjm_yesterday_no_pay',$zgjm_yesterday_no_pay);
		$this->assign('zgjm_yesterday_pay',$zgjm_yesterday_pay);
		$this->assign('zgjm_week_no_pay',$zgjm_week_no_pay);
		$this->assign('zgjm_week_pay',$zgjm_week_pay);
		$this->assign('zgjm_month_no_pay',$zgjm_month_no_pay);
		$this->assign('zgjm_month_pay',$zgjm_month_pay);
		
		//抽签统计
		$chouqian_type = array_keys(C('CHOUQIAN_TYPE'));
		foreach($chouqian_type as $v){
			$in_where .= "'$v',";
		}
		$in_where = trim($in_where, ',');
		$chouqian_where = " and order_f in ($in_where) ";
//echo $chouqian_where;exit;
		$chouqian_today_no_pay = $tm->pay($zxq, 0, $time_start_today, $time_end_today, $chouqian_where);
		$chouqian_today_pay = $tm->pay($zxq, 1, $time_start_today, $time_end_today, $chouqian_where);
		
		$chouqian_yesterday_no_pay = $tm->pay($zxq, 0, $time_start_yesterday, $time_end_yesterday, $chouqian_where);
		$chouqian_yesterday_pay = $tm->pay($zxq, 1, $time_start_yesterday, $time_end_yesterday, $chouqian_where);
		
		$chouqian_week_no_pay = $tm->pay($zxq, 0, $time_start_week, $time_end_week, $chouqian_where);
		$chouqian_week_pay = $tm->pay($zxq, 1, $time_start_week, $time_end_week, $chouqian_where);		
		$chouqian_month_no_pay = $tm->pay($zxq, 0, $time_start_month, $time_end_month, $chouqian_where);
		$chouqian_month_pay = $tm->pay($zxq, 1, $time_start_month, $time_end_month, $chouqian_where);
		 
		$this->assign('chouqian_today_no_pay',$chouqian_today_no_pay);
		$this->assign('chouqian_today_pay',$chouqian_today_pay);
		$this->assign('chouqian_yesterday_no_pay',$chouqian_yesterday_no_pay);
		$this->assign('chouqian_yesterday_pay',$chouqian_yesterday_pay);
		$this->assign('chouqian_week_no_pay',$chouqian_week_no_pay);
		$this->assign('chouqian_week_pay',$chouqian_week_pay);
		$this->assign('chouqian_month_no_pay',$chouqian_month_no_pay);
		$this->assign('chouqian_month_pay',$chouqian_month_pay);
		
    	$this->display();
    }
	
	//推广商排行
	public function index_tgs(){
		$m = M();
		$um = D('AdminUser');
		
		//今日时间戳
		$time_start_today = strtotime(date('Y-m-d',time()).' 00:00');
		$time_end_today = strtotime(date('Y-m-d',time()).' 23:59');
		//昨日时间戳
		$time_start_yesterday = strtotime(date('Y-m-d',time()-3600*24).' 00:00');
		$time_end_yesterday = strtotime(date('Y-m-d',time()-3600*24).' 23:59');
		
		$sql = 'select sum(all_table.pay_fee) pay_fee,sum(all_table.pay_count) pay_count,all_table.uid from ((select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_bzcs_user a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_today.' and add_time <= '.$time_end_today.' GROUP BY b.uid) union all (select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_bzhh_user a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_today.' and add_time <= '.$time_end_today.' GROUP BY b.uid) union all (select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_xmfx_user a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_today.' and add_time <= '.$time_end_today.' GROUP BY b.uid) union all (select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_order_all a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_today.' and add_time <= '.$time_end_today.' GROUP BY b.uid) union all (select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_zgjm_user a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_today.' and add_time <= '.$time_end_today.' GROUP BY b.uid) union all (select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_zwpp_user a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_today.' and add_time <= '.$time_end_today.' GROUP BY b.uid)) all_table GROUP BY all_table.uid order by all_table.pay_fee desc limit 5';		
		$today = $m->query($sql);
//echo '<pre>';print_r($m);exit;
		foreach($today as $k=>$v){
			$username = $um->field('username')->find($v['uid']);
			$today[$k]['tgs'] = $username['username'];	
		}		
		$this->assign('today',$today);
		
		$sql = 'select sum(all_table.pay_fee) pay_fee,sum(all_table.pay_count) pay_count,all_table.uid from ((select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_bzcs_user a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_yesterday.' and add_time <= '.$time_end_yesterday.' GROUP BY b.uid) union all (select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_bzhh_user a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_yesterday.' and add_time <= '.$time_end_yesterday.' GROUP BY b.uid) union all (select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_xmfx_user a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_yesterday.' and add_time <= '.$time_end_yesterday.' GROUP BY b.uid) union all (select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_order_all a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_yesterday.' and add_time <= '.$time_end_yesterday.' GROUP BY b.uid) union all (select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_zgjm_user a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_yesterday.' and add_time <= '.$time_end_yesterday.' GROUP BY b.uid) union all (select sum(pay_fee) pay_fee,count(*) pay_count,b.uid from ces_zwpp_user a inner join ces_admin_t b on a.t = b.id where a.is_pay=1 and add_time >= '.$time_start_yesterday.' and add_time <= '.$time_end_yesterday.' GROUP BY b.uid)) all_table GROUP BY all_table.uid order by all_table.pay_fee desc limit 5';
		
		$yesterday = $m->query($sql);
		foreach($yesterday as $k=>$v){
			$username = $um->field('username')->find($v['uid']);
			$yesterday[$k]['tgs'] = $username['username'];	
		}		
		$this->assign('yesterday',$yesterday);
		
    	$this->display();
    }
	
	//广告位排行
	public function index_t(){
		$m = M();
		$um = D('AdminUser');
		
		//今日时间戳
		$time_start_today = strtotime(date('Y-m-d',time()).' 00:00');
		$time_end_today = strtotime(date('Y-m-d',time()).' 23:59');
		//昨日时间戳
		$time_start_yesterday = strtotime(date('Y-m-d',time()-3600*24).' 00:00');
		$time_end_yesterday = strtotime(date('Y-m-d',time()-3600*24).' 23:59');
			
		$sql = 'select sum(all_table.pay_fee) pay_fee,sum(all_table.pay_count) pay_count,all_table.t from ((select sum(pay_fee) pay_fee,count(*) pay_count,t from ces_bzcs_user where is_pay=1 and t is not null and add_time >= '.$time_start_today.' and add_time <= '.$time_end_today.' GROUP BY t) union all (select sum(pay_fee) pay_fee,count(*) pay_count,t from ces_bzhh_user where is_pay=1 and t is not null and add_time >= '.$time_start_today.' and add_time <= '.$time_end_today.' GROUP BY t) union all (select sum(pay_fee) pay_fee,count(*) pay_count,t from ces_xmfx_user where is_pay=1 and t is not null and add_time >= '.$time_start_today.' and add_time <= '.$time_end_today.' GROUP BY t)) all_table GROUP BY all_table.t order by all_table.pay_fee desc limit 5';
			
		$today = $m->query($sql);
		
		foreach($today as $k=>$v){
			$username = $um->field('username,b.name t_name')->alias('a')->join('__ADMIN_T__ b on b.uid=a.id')->where('b.id='.$v['t'])->find();
			$today[$k]['tgs'] = $username['username'];
			$today[$k]['t_name'] = $username['t_name'];			
		}		
		$this->assign('today',$today);
		
		$sql = 'select sum(all_table.pay_fee) pay_fee,sum(all_table.pay_count) pay_count,all_table.t from ((select sum(pay_fee) pay_fee,count(*) pay_count,t from ces_bzcs_user where is_pay=1 and t is not null and add_time >= '.$time_start_yesterday.' and add_time <= '.$time_end_yesterday.' GROUP BY t) union all (select sum(pay_fee) pay_fee,count(*) pay_count,t from ces_bzhh_user where is_pay=1 and t is not null and add_time >= '.$time_start_yesterday.' and add_time <= '.$time_end_yesterday.' GROUP BY t) union all (select sum(pay_fee) pay_fee,count(*) pay_count,t from ces_xmfx_user where is_pay=1 and t is not null and add_time >= '.$time_start_yesterday.' and add_time <= '.$time_end_yesterday.' GROUP BY t)) all_table GROUP BY all_table.t order by all_table.pay_fee desc limit 5';
		
		$yesterday = $m->query($sql);
		
		foreach($yesterday as $k=>$v){
			$username = $um->field('username,b.name t_name')->alias('a')->join('__ADMIN_T__ b on b.uid=a.id')->where('b.id='.$v['t'])->find();
			$yesterday[$k]['tgs'] = $username['username'];	
			$yesterday[$k]['t_name'] = $username['t_name'];
		}		
		$this->assign('yesterday',$yesterday);
		
    	$this->display();
    }
}