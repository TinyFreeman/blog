<?php
namespace Adminyhgl\Model;
use Think\Model;
 
class AdminRoleAuthorityModel extends Model{
	
	public function save($data){
		$data['authority'] = implode(',', $data['authority']);
		
		return parent::add($data, array(), true);
	}
	
	public function roleAuthority($roleid){
		$r = $this->find($roleid);
		return explode(',', $r['authority']);
	}
}
