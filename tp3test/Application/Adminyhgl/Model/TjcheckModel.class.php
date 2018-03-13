<?php
namespace Adminyhgl\Model;
use Think\Model;
 
class TjcheckModel extends Model{
	
	
	public function checktj($data){
		 

	  		$pattern1='cnzz.com';
			$pattern2='baidu.com';
			 
			if(!empty($data['bzcs_tongji'])){
				if(!strpos($data['bzcs_tongji'], $pattern1)&&!strpos($data['bzcs_tongji'], $pattern2)){
					return 0;
				}
			}

			if(!empty($data['pc_bzcs_tongji'])){
				if(!strpos($data['pc_bzcs_tongji'], $pattern1)&&!strpos($data['pc_bzcs_tongji'], $pattern2)){
					return 0;
				}
			}

			if(!empty($data['xmfx_tongji'])){
				if(!strpos($data['xmfx_tongji'], $pattern1)&&!strpos($data['xmfx_tongji'], $pattern2)){
					return 0;
				}
			}

			if(!empty($data['pc_xmfx_tongji'])){
				if(!strpos($data['pc_xmfx_tongji'], $pattern1)&&!strpos($data['pc_xmfx_tongji'], $pattern2)){
					return 0;
				}
			}

			if(!empty($data['bzhh_tongji'])){
				if(!strpos($data['bzhh_tongji'], $pattern1)&&!strpos($data['bzhh_tongji'], $pattern2)){
					return 0;
				}
			}

			if(!empty($data['pc_bzhh_tongji'])){
				if(!strpos($data['pc_bzhh_tongji'], $pattern1)&&!strpos($data['pc_bzhh_tongji'], $pattern2)){
					return 0;
				}
			}

			if(!empty($data['zxqm_tongji'])){
				if(!strpos($data['zxqm_tongji'], $pattern1)&&!strpos($data['zxqm_tongji'], $pattern2)){
					return 0;
				}
			}

			if(!empty($data['pc_zxqm_tongji'])){
				if(!strpos($data['pc_zxqm_tongji'], $pattern1)&&!strpos($data['pc_zxqm_tongji'], $pattern2)){
					return 0;
				}
			}

			if(!empty($data['zwpp_tongji'])){
				if(!strpos($data['zwpp_tongji'], $pattern1)&&!strpos($data['zwpp_tongji'], $pattern2)){
					return 0;
				}
			}

			if(!empty($data['zgjm_tongji'])){
				if(!strpos($data['zgjm_tongji'], $pattern1)&&!strpos($data['zgjm_tongji'], $pattern2)){
					return 0;
				}
			}

  
			
		 	
			// $this->lod($data['pc_bzcs_tongji']);
			// $this->lod($data['xmfx_tongji']);
			// $this->lod($data['pc_xmfx_tongji']);
			// $this->lod($data['bzhh_tongji']);
			// $this->lod($data['pc_bzhh_tongji']);
			// $this->lod($data['zxqm_tongji']);
			// $this->lod($data['pc_zxqm_tongji']);
		 

		// $check['bzcs'] = $data['bzcs_tongji'];
		// $check['pc_bzcs'] = $data['pc_bzcs_tongji'];
		// $check['xmfx'] = $data['xmfx_tongji'];
		// $check['pc_xmfx'] = $data['pc_xmfx_tongji'];
		// $check['bzhh'] = $data['bzhh_tongji'];
		// $check['pc_bzhh'] = $data['pc_bzhh_tongji'];
		// $check['xmfx'] = $data['xmfx_tongji'];
		// $check['pc_xmfx'] = $data['pc_xmfx_tongji'];
		 
	 	 
		 
	



		   	
	}

 	 //  function lod($value){
 	   
	  // 		$pattern1='cnzz.com';
			// $pattern2='baidu.com';
			// if(!empty($value)){
			// 	if(!strpos($value, $pattern1)&&!strpos($value, $pattern2)){
			// 		return 0;
			// 	}
			// }
	  // }
}
