<?php
namespace Adminyhgl\Controller;
use Think\Controller;
/**
* 
*/
class CateController extends Controller
{
	
	function index()
	{
		$list = M('admin_classcate')->select();
		$this->assign('list',$list);
		$this->display();
	}
	public function addCate()
	{
		header("Content-type:text/html;charset=utf-8");
		if(IS_POST){
			$cate = M('admin_classcate');
			$name['name'] = I('cate');
			$add = $cate->add($name);
			if($add){
				$this->success("添加成功",'index');
			}else{
				$this->error("添加失败",'addCate');

			}
		}else{
			$this->display('addCate');
		}
	}
	public function editCate()
	{
		$cate = M('admin_classcate');
		$id = I('get.id');
		$where['id'] = $id;

		if (IS_POST) {
			$name['name'] = I('cate');
			$cate_id = I('cate_id');
			$where['id'] = $cate_id;
 			$edit = $cate->where($where)->save($name);
			if($edit){
				$this->success("修改成功",'index');
			}else{
				$this->error("修改失败");
			}
		}else{
            $list = $cate->where($where)->find();
	        $this->assign('user',$list);
			$this->display('editCate');
		}
	}

	public function delCate()
	{
		$cate = M('admin_classcate');
		$where['id'] = I('get.id');
		$del = $cate->where($where)->delete();
		
		if($del){
			$this->success("删除成功",U('index'));
		}else{
			$this->error('删除失败');exit;
		}
	}
}
?>