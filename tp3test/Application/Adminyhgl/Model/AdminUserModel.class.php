<?php
namespace Adminyhgl\Model;
use Think\Model;
 
class AdminUserModel extends Model{
	
	const SALT = 'FP^Ial';
	
	public function user($id){
		$where['id'] = $id;
		return $this->where($where)->find();
	}

	public function add($data){
		$data['password'] = $this->generate_pwd($data['password']);
				
		$data['pid'] = $this->getUserId();
		
		return parent::add($data);  		
	}
	
	public function save($data){
		if(!empty($data['password'])){
			$data['password'] = $this->generate_pwd($data['password']);
		}		
		return parent::save($data);  		
	}
	
	public function generate_pwd($ori_pwd){
		return md5($ori_pwd . self::SALT);
	} 
	
	public function loginVerify($data){
		$r = $this->where(array('username' => $data['username']))->find();
		if($r){
			if($r['password'] == $this->generate_pwd($data['password'])){
				
				$this->storeUserInfo($r);
				return true;
			} 
		}

		return false;
	} 
	
	private function storeUserInfo($user){
		session('username', $user['username']);
		session('userid', $user['id']);
		
		$userAuthority = $this->roleAuthority($user['roleid']);
		session('userroleid', $user['roleid']);
		session('userAuthority', $userAuthority);
	}
	
	private function roleAuthority($roleid){
		$a = D('AdminRoleAuthority');
		return $a->roleAuthority($roleid);
	}
	
	public function getUserId(){
		return session('userid');
	}
	
	public function getAuthority(){
		return session('userAuthority');
	}
	
	public function getUserName(){
		return session('username');
	}
	
	public function isSuperAdmin(){
		return $this->getUserName() == C('ADMIN_USER');
	}
	
	public function isLog(){
		$un = $this->getUserName();
		return !empty($un);
	}
	
	public function logout(){
		session(null);
	}
	
	public function sonUser($id, $res = array()){
		$res[] = $id;
	
		$r = $this->where(array('pid'=>$id))->select();
		
		if($r){
			
			foreach($r as $v){
				$res = $this->sonUser($v['id'], $res);
			}
			
		}
		
		return $res;
	}
	
}
