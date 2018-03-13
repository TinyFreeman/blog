<?php
namespace Adminyhgl\Model;
use Think\Model;
 
class AdminWxFansModel extends Model{
	
	public function fansNum($wx_id){
		$map['wx_id'] = $wx_id;
		$map['time'] = $this->todayTime();
		return $this->where($map)->find();
	}
	
	public function save($data){
		if(empty($data['time'])){
			$data['time'] = $this->todayTime();
		}
		return parent::add($data, array(), true);
	}
	
	public function todayTime(){
		return strtotime(date('Y-m-d',time()).' 00:01');
	}
	
}
