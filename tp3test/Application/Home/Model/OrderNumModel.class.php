<?php
namespace Home\Model;
use Think\Model;
 
class OrderNumModel extends Model{
	
/* 	//根据订单号获取订单信息
	public function get_order_info($order_num){
		return $this->where('order_num=\'' . $order_num . '\'')->find();
	} */
	
	//根据支付订单号获取订单信息
	public function get_order_info($pay_order_num){
		return $this->alias('a')->field('a.*,b.pay_order_num')->join('JOIN __PAY_ORDER__ b ON a.order_num = b.order_num')->where('b.pay_order_num=\'' . $pay_order_num . '\'')->find();
	}

	//设置成已支付
	public function set_has_pay($order_num){
		$this->status = 1;
		return $this->where('order_num=\'' . $order_num . '\'')->save();
	}
	
	//核对已支付的订单金额是否正确
	public function check_fee($order_num, $pay_fee){
		$map['order_num'] = $order_num;
		$map['fee'] = $pay_fee;
		return $this->where($map)->find();
	}
}
