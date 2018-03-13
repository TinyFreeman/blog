<?php if (!defined('THINK_PATH')) exit();?>﻿
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>后台</title>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<link rel="stylesheet" type="text/css" href="/Public/Adminyhgl/lib/bootstrap/css/bootstrap.css">

<link rel="stylesheet" type="text/css" href="/Public/Adminyhgl/stylesheets/theme.css">
<link rel="stylesheet" href="/Public/Adminyhgl/lib/font-awesome/css/font-awesome.css">

<script src="/Public/Adminyhgl/lib/jquery-1.7.2.min.js" type="text/javascript"></script>

<!-- Demo page code -->

<style type="text/css">
	#line-chart {
		height:300px;
		width:800px;
		margin: 0px auto;
		margin-top: 1em;
	}
	.brand { font-family: georgia, serif; }
	.brand .first {
		color: #ccc;
		font-style: italic;
	}
	.brand .second {
		color: #fff;
		font-weight: bold;
	}
</style>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->



</head>
<body>
	
<div class="navbar">
	<div class="navbar-inner">
			<ul class="nav pull-right">
				

				
				<?php echo W('Login/user');?>
				
			</ul>
			<a class="brand" href="index.html"><span class="second">速测后台</span></a>
	</div>
</div>

	
	
<div class="sidebar-nav">
	<?php echo W('LeftNav/leftlist');?>
</div>

	
	
 <div class="content">
        
        <div class="header">
            
            <h1 class="page-title">学堂列表</h1>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
	<form action="<?php echo U('index');?>" method="get" style="float:right;">
		用户名:<input type="text" style="width: 130px;" name='username' value="<?php echo urldecode($map['username']);?>" />	
		推广域名:<input type="text" style="width: 180px;" name='tuiguang_host' value="<?php echo urldecode($map['tuiguang_host']);?>" />
		<button class="btn btn-primary" type="submit" style="margin-bottom:10px;">搜索</button>
		<div class="btn-group">
		</div>
	</form>
    <a class="btn btn-primary" href="<?php echo U('addClass');?>"><i class="icon-plus"></i>添加学堂</a>
	<div class="btn-group">
	</div>
</div>
<div class="well">
    <table class="table">
      <thead>
        <tr>
            <td>id</td>
			<td>分类</td>
			<td>标题</td>
			<td>原价格</td>
			<td>现价格</td>
			<!-- <td>音频</td>
			<td>图片</td> -->
			<td>文章</td>
			<td>操作</td>
        </tr>
      </thead>
      <tbody>
	  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <tr>
			<td><?php echo ($vo["id"]); ?></td>
			<td><?php echo ($vo["cate_id"]); ?></td>
			<td><?php echo ($vo["title"]); ?></td>
			<td><?php echo ($vo["a_price"]); ?></td>
			<td><?php echo ($vo["b_price"]); ?></td>
			<!-- <td><?php echo ($vo["audio"]); ?></td>
			<td><?php echo ($vo["pictrue"]); ?></td> -->
			<td><?php echo ($vo["article"]); ?></td>
          <td>
              <a href="<?php echo U('editClass', array('id' => $vo['id']));?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo U('delClass', array('id' => $vo['id']));?>"  ><i class="icon-remove"></i></a>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
</div>


<?php echo ($page); ?>

        
<footer>
	<hr>

	

</footer>

	<script src="/Public/Adminyhgl/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
          

                    
            </div>
        </div>
    </div>


</body>
</html>