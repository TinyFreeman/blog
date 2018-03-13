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
				
			</ul>
			<a class="brand" href="index.html"><span class="second">速测后台</span></a>
	</div>
</div>

	
	
	
	
<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Sign In</p>
            <div class="block-body">
                <form method="post">
                    <label>用户名</label>
                    <input type="text" class="span12" name="username">
                    <label>密码</label>
                    <input type="password" class="span12" name="password">
					<!--<label>验证码</label>
                    <input type="password" class="span12" name="password"><img src="<?php echo U('User/verify');?>" />-->
                    <button type="submit" class="btn btn-primary pull-right">登录</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>



</body>
</html>