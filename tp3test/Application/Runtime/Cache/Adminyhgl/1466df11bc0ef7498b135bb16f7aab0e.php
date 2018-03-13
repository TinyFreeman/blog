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
            
            <h1 class="page-title">编辑用户</h1>
        </div>
        

        <div class="container-fluid">
            <div class="row-fluid">
				<div class="well">
					<div id="myTabContent" class="tab-content">
					<div class="tab-pane active in" id="home">
					<form id="tab" action="" method="post" >
						<label>角色</label>
						<select name="roleid">
						<?php if(is_array($rolelist)): $i = 0; $__LIST__ = $rolelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $user['roleid']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<label>用户名</label>
						<input type="text" class="input-xlarge" name="username" value="<?php echo ($user["username"]); ?>">
						<label>密码</label>
						<input type="text" class="input-xlarge" name="password" >
						<label>推广域名</label>
						<input type="text" class="input-xlarge" name="tuiguang_host" value="<?php echo ($user["tuiguang_host"]); ?>">
						<div>
							<input type="hidden" name="id" value="<?php echo ($user["id"]); ?>" />
							<button class="btn btn-primary" type="submit">修改</button>
						</div>
					</form>
					</div>
				  </div>
				</div>  

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