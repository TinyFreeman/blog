<?php
namespace Home\Model;
use Think\Model;
 
class PayOrderModel extends Model{

	//根据订单号生成订单表，返回生成的支付订单号
	public function add_pay_table($order_num){
		$data['order_num'] = $order_num;
		
		while(1){
			$data['pay_order_num'] = $order_num . rand(1000, 9999);
			if(!($this->where('pay_order_num=\'' . $data['pay_order_num'] . '\'')->find())){
				break;
			}
		}
		$data['pay_time'] = time();
		$data['is_pay'] = 2;  //2是未支付，1 是已支付
		$this->add($data); 
		return $data['pay_order_num'];	
	}
	
	//设置成已支付
	public function set_has_pay($pay_order_num){
		$this->is_pay = 1;
		return $this->where('pay_order_num=\'' . $pay_order_num . '\'')->save();
	}
	
	//根据支付订单号查询订单号
	public function get_order_num($pay_order_num){
		return $this->where('pay_order_num=\'' . $pay_order_num . '\'')->getField('order_num');;
	}
}
