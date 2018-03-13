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

<title>学堂</title>
</head>

<body>

<div class="ui_page">
   

<div class="ui_page">
	
    <div class="xt_son_bnr">
    	<div class="xt_bt"><?php echo ($list["title"]); ?></div>
        <div class="xt_xx"><!-- 升运堂 |  -->时长0<?php echo ($list["duration"]); ?><!--<span> 专栏 </span>--></div>
        <div class="xt_img"><img src="/Upload/audio//<?php echo ($list["pictrue"]); ?>"/></div>
        <div class="audio">
            <audio controls>
              <source src="/Upload/audio//<?php echo ($list["audio"]); ?>" type="audio/ogg">
              <source src="/Upload/audio//<?php echo ($list["audio"]); ?>" type="audio/mpeg">
            </audio>
        </div>
    </div>
    
    <div class="xt_son_txt"><?php echo ($list["article"]); ?></div>
    
   <!--  <div class="foot">
    	<li><a href=""><img src="images/f_btn1.png"/><p>风云榜</p></a></li>
        <li><a href=""><img src="images/f_btn2.png"/><p>提问</p></a></li>
        <li><a href=""><img src="images/f_btn3.png"/><p>速测</p></a></li>
        <li class="cur"><a href=""><img src="images/f_btn4_4.png"/><p>学堂</p></a></li>
        <li><a href=""><img src="images/f_btn5.png"/><p>我的</p></a></li>
    </div> -->

</div>
 
   <?php echo W('Include/foot');?> 

</div>
</body>
</html>