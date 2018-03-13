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

<title><?php echo ($order_info["body"]); ?></title>
</head>

<body>

<div class="ui_page">
   

<div class="ui_page" style="background:#FFF;">
	<form action="" method="post">
        <div class="pj_box">
        	<p>我要评价：</p>
            <p>
              <img src="/Public/Home/images/wtxq.png"/>
              <textarea name="pingjia" placeholder="老师的回答是否令你满意？说说你的心得，分享给想提问的他们吧！"></textarea>
            <p>
        </div>
        
        <div class="pingfen"><font>老师评分：</font><i id="pf1"></i><i id="pf2"></i><i id="pf3"></i><i id="pf4"></i><i id="pf5"></i></div>
        <input class="pff" type="hidden" name="pingfen" value="0">
        <input   type="hidden" name="order_num" value="<?php echo ($order_num); ?>">
        <button class="zhlxbtn zhlxbtn_f" type="submit">提 交</button>
    </form>
    <div class="foot">
    	<li><a href=""><img src="/Public/Home/images/f_btn1.png"/><p>风云榜</p></a></li>
        <li><a href=""><img src="/Public/Home/images/f_btn2.png"/><p>提问</p></a></li>
        <li><a href=""><img src="/Public/Home/images/f_btn3.png"/><p>速测</p></a></li>
        <li><a href=""><img src="/Public/Home/images/f_btn4.png"/><p>学堂</p></a></li>
        <li class="cur"><a href=""><img src="/Public/Home/images/f_btn5_5.png"/><p>我的</p></a></li>
    </div>

</div>
<script>
   $(function(){
        $('#pf1').click(function(){
             $('.pff').val('1')
             
        })
        $('#pf2').click(function(){
             $('.pff').val('2')
        })
        $('#pf3').click(function(){
             $('.pff').val('3')
        })
        $('#pf4').click(function(){
             $('.pff').val('4')
        })
        $('#pf5').click(function(){
             $('.pff').val('5')
        })
      

        
   }) 

</script>
 
   <?php echo W('Include/foot');?> 

</div>
</body>
</html>