<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class AllorderController extends AdminController {

	public function _initialize(){
		
		parent::_initialize(3);  //权限id，在config/autority.php中配置

	}
	
	 
	

	//八字测算订单列表
    public function index_bzcs(){		
		 $order_num = urldecode(I('get.order_num'));	
		 $bm = D("bzcs_c"); 	
		 $where = "b_order_num='$order_num'";



		  $list = $bm->where($where)->select();
 
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('list',$list);
    	$this->display();
    }
	
	//八字合婚订单列表
	public function index_bzhh(){		
		 $order_num = urldecode(I('get.order_num'));	
		 $bm = D("bzhh_c"); 	
		 $where = "b_order_num='$order_num'";



		  $list = $bm->where($where)->select();
 
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('list',$list);
    	$this->display();
    }
	
	//姓名分析订单列表
	public function index_xmfx(){		
		 $order_num = urldecode(I('get.order_num'));	
		 $bm = D("xmfx_c"); 	
		 $where = "b_order_num='$order_num'";



		  $list = $bm->where($where)->select();
 
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('list',$list);
    	$this->display();
    }
	
    //在线起名订单列表
    public function index_zxqm(){		
		 $order_num = urldecode(I('get.order_num'));	
		 $bm = D("zxqm_c"); 	
		 $where = "b_order_num='$order_num'";



		  $list = $bm->where($where)->select();
 
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('list',$list);
    	$this->display();
    }
	
//紫薇排盘订单列表
	public function index_zwpp(){		
		
		$order_num = urldecode(I('get.order_num'));	
		 $bm = D("zwpp_c"); 	
		 $where = "b_order_num='$order_num'";



		  $list = $bm->where($where)->select();
 
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('list',$list);
    	$this->display();
    }



    //周公解梦订单列表
	public function index_zgjm(){		
		
		$order_num = urldecode(I('get.order_num'));	
		 $bm = D("zgjm_c"); 	
		 $where = "b_order_num='$order_num'";



		  $list = $bm->where($where)->select();
 
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('list',$list);
    	$this->display();
    }
	
	public function index(){		
		 $order_num = urldecode(I('get.order_num'));	
		 $cstype = urldecode(I('get.cstype'));
		 $bm = D("order_c"); 	
		 $where = "b_order_num='$order_num'";



		  $list = $bm->where($where)->select();
//echo '<pre>';print_r($bm);exit; 
		$this->assign('pay_status', C('PAY_STATUS'));
		$this->assign('list',$list);
    	$this->display();
    }
	
}