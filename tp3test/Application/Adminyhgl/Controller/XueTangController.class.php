<?php
namespace Adminyhgl\Controller;
use Think\Controller;
use Think\Upload;
use Think\MP3File;

/**
* 
*/
class XueTangController extends Controller
{
	
	public function index()
	{
		
		$class = M('admin_class');
		$list = $class->order('id asc')->select();
		$this->assign('list',$list);
		$this->display('index');
	}

	//添加学堂
	public function addClass()
	{
		if(IS_POST){
			$data = I('post.');
			$info = $this->classAll(1);
			$order_num = $this->create_order_num(); //订单号
	        
			if($info){
	            $audio = M('admin_class');
	            $data['duration'] = $info['audio']['minutes'].':'.$info['audio']['seconds'];
	            $data['audio'] = $info['audio']['savename'];
	            $data['pictrue'] = $info['photo']['savename'];
	            $data['order_num'] = $order_num;
	            $data['dates'] = time();
	            $list = $audio->add($data);
	            $this->success("提交成功",'index');
	        }else{
	            $this->error("提交失败");exit;
	        }

		}else{
			$cate = $this->getCate();
			$this->assign('cate',$cate);
			$this->display('addClass');
		}
		
	}
    

    //修改学堂
	public function editClass()
	{
		$class = M('admin_class');
		$where['id'] = I('get.id');

		if(IS_POST){
			
			$data = I('post.');
			$where['id'] = $data['class_id'];

			$info = $this->classAll(0);

			$audioName = $info['audio']['savename'];
			$picName = $info['photo']['savename'];


			if(!empty($audioName)){
				$data['audio'] = $audioName;
			}elseif (!empty($picName)) {
				$data['pictrue'] = $picName;
			}
			
			
			$list = $class->where($where)->save($data);
			if($list){
				$this->success("修改成功",'index');
			}else{
				$this->error('修改失败');
			}
		}else{
			$list = $class->where($where)->find();
			$cate = $this->getCate();
			$this->assign('cate',$cate);
			$this->assign('user',$list);
			$this->display('editClass');

		}
	}

    //删除
	public function delClass()
	{
		$class = M('admin_class');
		$where['id'] = I('get.id');
		$del = $class->where($where)->delete();
		
		if($del){
			$this->success("删除成功",U('index'));
		}else{
			$this->error('删除失败');exit;
		}
	}



	public function classAll($type=0)
	{
		$file = $_FILES;



		$audioExts = array('mp3','mp4');
		$picExts = array('jpg','png','gif');
		$audioName = substr($file['audio']['name'],-3);
		$picName = substr($file['photo']['name'],-3);
        if($type == 1){
        	if(empty($file['audio']['name'])||empty($file['photo']['name'])){
				$this->error("请上传音频或者图片");exit();
			}elseif (!in_array($audioName,$audioExts)||!in_array($picName,$picExts)) {
				$this->error("文件后缀不被允许");exit;
			}
        }
		
		header("Content-type:text/html;charset=utf-8");
		$config = array(
            //'exts'   =>  array('mp3','mp4','jpg','jpeg','png','gif'), //允许上传的文件后缀
            'subName'       =>  '', //子目录创建方式，
            'rootPath'      =>  './Upload/audio/', //保存根路径
            //'savePath'      =>  'audio', //保存路径
            'saveName'      =>  array('time', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        );

        $uploads = new Upload($config);
        $info = $uploads->upload();


         //mp3时长
    	$filename = $config['rootPath'].$config['subName'].'/'.$info['audio']['savename'];
        $duration = $this->MP3Duration($filename);

        $info['audio']['minutes'] = $duration['minutes'];
        $info['audio']['seconds'] = $duration['seconds'];
        return $info;
	}

    

    //获取mp3时长
	public function MP3Duration($filename)
    {
        $mp3 = new \Think\MP3File($filename);
        $a = $mp3->getDurationEstimate();
        $b = $mp3->getDuration();
        $duration = $mp3::formatTime($b);
        return $duration;
    }

    public function getCate()
    {
    	$cate = M('admin_classcate')->order('id asc')->select();
    	return $cate;
		
    }

    public function create_order_num(){
		$order_num = 'CS'.date('YmdHis',time()).rand(0,99).rand(0,999).rand(0,9999);
		return $order_num;
	}

}
?>