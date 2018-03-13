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
   
    <div class="ds_zhifu">
    	<ol>
        	<li>项目服务<span><?php echo ($order_info["body"]); ?></span></li>
            <li style="border:none;">订单金额<font>￥<?php echo ($order_info["fee"]); ?></font></li>
        </ol>
    </div>
    <form method="post" action="<?php echo U('Pay/pay');?>">
		<div class="zhifu_fs">
			<p>请选择支付方式</p>
			<ol>
				<li id="zf_1" class="cur"><img src="/Public/Home/images/jf_zhifu.png"/>账户积分<span></span></li>
				<li id="zf_2"><img src="/Public/Home/images/ye_zhifu.png"/>账户余额<span></span></li>
				<li id="zf_3" style="border:none;"><img src="/Public/Home/images/wx_zhifu.png"/>微信支付<span></span></li>
				<input id="zf_f" type="hidden" name="pay_type" value="1" />
			</ol>
		</div>
		
		<div class="hj_money">
			<li class="hj_m">合计金额： <span>￥<?php echo ($order_info["fee"]); ?></span></li>
			<input type="hidden" name="pay_order_num" value="<?php echo ($order_info["pay_order_num"]); ?>" />
			<li class="qr"><button type="submit">确 认</button></li>
		</div>
	</form>
 
   <?php echo W('Include/foot');?> 

</div>
</body>
</html>