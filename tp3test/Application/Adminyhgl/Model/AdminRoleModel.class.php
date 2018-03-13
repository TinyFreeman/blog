<?php
namespace Adminyhgl\Model;
use Think\Model;
 
class AdminRoleModel extends Model{
	
	public function roleList(){
		return $this->select();
	}
}
