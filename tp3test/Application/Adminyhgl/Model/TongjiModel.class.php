<?php
namespace Adminyhgl\Model;
use Think\Model;
 
class TongjiModel extends Model{
	
	
	public function pay($model, $pay_status, $start_time, $end_time, $where_param = ''){
		$where = ' 1 ';
		$where .= ' and is_pay=' . $pay_status . ' ';
		$where .= ' and add_time >= ' . $start_time . ' ';
		$where .= ' and add_time <=' . $end_time . ' ';
		if(!empty($where_param)){
			$where .= $where_param;
		}
		
		$res['pay_fee'] = fen2yuan($model->where($where)->sum('pay_fee'));   //总金额
		$res['pay_count'] = $model->where($where)->count();        //总笔数
//print_r($model);
		
		return $res;
	}

	 
}
