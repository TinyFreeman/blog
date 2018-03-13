<?php

namespace Home\Widget;
use Think\Controller;

class IncludeWidget extends Controller {
    public function foot(){

		$arr = array(
			'Question' => 2,
			'SuCe' => 3,
			'XueTang' => 4,
			'Personal' => 5,
			'Orderyh' => 5,
			'Fs' => 5
			
		);
		
		$this->assign('i', $arr[CONTROLLER_NAME]);
		
        $this->display('Include:foot');
    }
}