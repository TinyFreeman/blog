<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<link rel="stylesheet" href="/Public/Home/css/style.css">
<script type="text/javascript" src="/Public/Home/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/tw.js"></script>

<title>我的</title>
</head>

<body>

<div class="ui_page">
   
   <div class="tw_cont tw_cont2">
    	
    	<li>
        	<div class="ls_tx"><img src="<?php echo ($_SESSION['userinfo']['headimgurl']); ?>"/><span>5.0</span></div>
            <ol class="ls_xx ls_xx2">
            	<li class="nam nam2 nam3"><?php echo ($_SESSION['userinfo']['nickname']); ?><a href=""><span class="gz3">答主</span></a></li>
                <li class="xx xx2 xx3">234回答 · 85速测</li>
            </ol>
            <div class="ls_jq3"><a href=""><img src="/Public/Home/images/dz1.png"/><span>2</span></a><a href=""><img src="/Public/Home/images/dz2.png"/><span>2</span></a></div>
        </li>
 
    </div>
    
    <div class="zhifu_fs">
        <ol>
        	<a href="<?php echo U('Order/index');?>"><li><img src="/Public/Home/images/wd_1.png"/>我的订单<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
            <a href=""><li><img src="/Public/Home/images/wd_2.png"/>我的回答<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
            <a href=""><li><img src="/Public/Home/images/wd_3.png"/>我的粉丝<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
            <a href=""><li><img src="/Public/Home/images/wd_4.png"/>我的积分<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
            <a href=""><li style="border:none;"><img src="/Public/Home/images/wd_5.png"/>收入支出<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
        </ol>
    </div>
    
    <div class="zhifu_fs">
        <ol>
        	<a href=""><li><img src="/Public/Home/images/wd_6.png"/>推荐好友<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
            <a href=""><li style="border:none;"><img src="/Public/Home/images/wd_7.png"/>打赏排行榜<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
            <!--<a href=""><li><img src="/Public/Home/images/wd_8.png"/>申请答主<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
            <a href=""><li style="border:none;"><img src="/Public/Home/images/wd_9.png"/>申请vip会员<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>-->
        </ol>
    </div>
    
    <div class="zhifu_fs">
        <ol>
        	<a href=""><li><img src="/Public/Home/images/wd_10.png"/>使用指南<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
            <a href=""><li><img src="/Public/Home/images/wd_11.png"/>建议反馈<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
            <a href=""><li style="border:none;"><img src="/Public/Home/images/wd_12.png"/>联系客服<font><img src="/Public/Home/images/wd_jt.png"/></font></li></a>
        </ol>
    </div>
 
   <?php echo W('Include/foot');?> 

</div>
</body>
</html>