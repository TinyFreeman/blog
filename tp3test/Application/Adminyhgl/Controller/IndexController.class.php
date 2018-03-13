<?php

namespace Adminyhgl\Controller;
use Think\Controller;

class IndexController extends AdminController {  

    public function index(){
		
		
		
		header("Content-type:text/html;charset=utf-8");
		$list = M('name')->select();

		// $count      = M("name")->count();
		// $Page       = new \Think\PageAdmin($count,15);
		// $show       = $Page->show();

		// $list = M("name")->order("id asc")->limit($Page->firstRow.','.$Page->listRows)->select();
		// $this->assign('page',$show);

        $this->assign("list",$list);
    	$this->display('index');
    }


    public function addUser()
    {
    	$name = I("post.wxname");
    	$data['name'] = $name;
    	$addUser = M("name")->add($data);
    	if($addUser){
    		$this->success("添加成功",'index');
    	}else{
    		$this->error("添加失败",'index');
    	}
    }

    //删除 
    public function delName()
    {
    	$id = I('get.id');
    	$delName = M('name')->where('id='.$id)->delete();
    	if($delName){
    		$this->success("删除成功",U('index'));
    	}else{
    		$this->error("删除失败");
    	}
    
    }
    

    //上传文件
    public function uploadFile()
    {
    	//上传 
		$config = array(
			'exts'      =>    array('xls','xlsx','csv'),// 设置附件上传类
			'subName'       =>  '',
			'rootPath'      =>  './Upload/images/',
			'saveName'      =>  array('uniqid', ''),

		);
		$upload = new \Think\Upload($config);
		$info   = $upload->upload();
		$filename = 'Uploads/images'.$info['savename'];
        $exts = $info['ext'];
        if(!$info) {// 上传错误提示错误信息
              $this->error($upload->geterror());
          }else{// 上传成功
              $this->data_import($filename, $exts);
        }
    }


    
    //对上传后的文件内容进行读取导入，下面是一个读取的方法。
    protected function data_import($filename, $exts='xls')
    {
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        //创建PHPExcel对象，注意，不能少了\
        $PHPExcel=new \PHPExcel();
        //如果excel文件后缀名为.xls，导入这个类
        if($exts == 'xls'){
            import("Org.Util.PHPExcel.Reader.Excel5");
            $PHPReader=new \PHPExcel_Reader_Excel5();
        }else if($exts == 'xlsx'){
            import("Org.Util.PHPExcel.Reader.Excel2007");
            $PHPReader=new \PHPExcel_Reader_Excel2007();
        }else if($exts == 'csv'){
            import("Org.Util.PHPExcel.Reader.CSV");
            $PHPReader=new \PHPExcel_Reader_CSV();
        }
 
        //var_dump($PHPReader);die;
        //载入文件
        $PHPExcel=$PHPReader->load($filename);
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet=$PHPExcel->getSheet(0);
        //获取总列数
        $allColumn=$currentSheet->getHighestColumn();
        //获取总行数
        $allRow=$currentSheet->getHighestRow();
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        for($currentRow=1;$currentRow<=$allRow;$currentRow++){
            //从哪列开始，A表示第一列
            for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){
                //数据坐标
                $address=$currentColumn.$currentRow;
                //读取到的数据，保存到数组$arr中
                $data[$currentRow][$currentColumn]=$currentSheet->getCell($address)->getValue();
            }
 
        }
        print_r($data);exit;
        $this->save_import($data);
    }


    //保存导入数据
    public function save_import($data)
    {
        //print_r($data);exit;
 
        $bath = M('name');
         
        //插入新数据时先清空原表数据，没有这个需要可以注释下面步骤
        //M('mobile')->where('1=1')->delete();
         
        foreach ($data as $k=>$v){
                //$mobile=$v['A'];   //注：****** （1）处
                $info['a'] = $v['name'];
            
 
                $arr[] = $info;
 
        }
        $result=$bath->addall($arr);
        if($result){
            $this->success('数据导入成功');
        }else{
            $this->error('数据导入失败');
        }
    }

}