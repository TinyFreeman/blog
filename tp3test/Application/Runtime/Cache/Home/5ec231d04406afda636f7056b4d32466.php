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

<title>我的_速测订单</title>
</head>

<body>

<div class="ui_page">
   
<style>
.zt_js{color:#888;}
</style>
<div class="ui_page">
	<div class="tw_head">
        <li onmousedown="aa(0)" id="m0" class="cur">全 部<p></p><?php if($num_all != 0 ): ?><font><?php echo ($num_all); ?></font><?php endif; ?></li>
        <li onmousedown="aa(1)" id="m1">待付款<p></p><?php if($num_no != 0 ): ?><font><?php echo ($num_no); ?></font><?php endif; ?></li>
        <li onmousedown="aa(2)" id="m2">进行中<p></p><?php if($num_ing != 0 ): ?><font><?php echo ($num_ing); ?></font><?php endif; ?></li>
        <li onmousedown="aa(3)" id="m3">待评价<p></p><?php if($num_pj != 0 ): ?><font><?php echo ($num_pj); ?></font><?php endif; ?></li>
    </div>
    
	<div class="wd_dd" id="a0">
    	<ol>
            <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Orderyh/click_jump',array(order_num=>$vo['order_num']));?>">
                    <li>
                        <div class="dd_tx"><img src="<?php echo ($vo["headimgurl"]); ?>"/></div>
                        <div class="dd_bt">
                            <font class="bt"><?php echo ($vo["title"]); ?></font>
                            <font class="bt2"><?php echo ($order_type[$vo['order_type']]); ?></font>
                            <font class="bt3"><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></font>
                        </div>
                        <div class="ztai">
                            <font class="<?php echo ($order_status_class[$vo['status']]); ?>"><?php echo ($order_status[$vo['status']]); ?></font>
                            <font class="zt_q">￥<?php echo $vo['fee']/100;?> </font>
                            <font class="zt_q2">￥<?php echo ($vo["price"]); ?></font>
                        </div>
                    </li>
                </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </ol>
    </div>
    
    <div class="wd_dd" id="a1">
    	<ol>
          <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["status"] == 2 ): ?><a href="<?php echo U('Orderyh/click_jump',array(order_num=>$vo['order_num']));?>">
                    <li>
                        <div class="dd_tx"><img src="<?php echo ($vo["headimgurl"]); ?>"/></div>
                        <div class="dd_bt">
                            <font class="bt"><?php echo ($vo["title"]); ?></font>
                            <font class="bt2"><?php echo ($order_type[$vo['order_type']]); ?></font>
                            <font class="bt3"><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></font>
                        </div>
                        <div class="ztai">
                             <font class="<?php echo ($order_status_class[$vo['status']]); ?>"><?php echo ($order_status[$vo['status']]); ?></font>
                          <font class="zt_q">￥<?php echo $vo['fee']/100;?> </font>
                            <font class="zt_q2">￥<?php echo ($vo["price"]); ?></font>
                        </div>
                    </li>
                </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ol>
    </div>
    
    <div class="wd_dd" id="a2">
    	<ol>
         <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["status"] == 1 ): ?><a href="<?php echo U('Orderyh/click_jump',array(order_num=>$vo['order_num']));?>">
                    <li>
                        <div class="dd_tx"><img src="<?php echo ($vo["headimgurl"]); ?>"/></div>
                        <div class="dd_bt">
                            <font class="bt"><?php echo ($vo["title"]); ?></font>
                            <font class="bt2"><?php echo ($order_type[$vo['order_type']]); ?></font>
                            <font class="bt3"><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></font>
                        </div>
                        <div class="ztai">
                             <font class="<?php echo ($order_status_class[$vo['status']]); ?>"><?php echo ($order_status[$vo['status']]); ?></font>
                          <font class="zt_q">￥<?php echo $vo['fee']/100;?> </font>
                            <font class="zt_q2">￥<?php echo ($vo["price"]); ?></font>
                        </div>
                    </li>
                </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ol>
    </div>
    
    <div class="wd_dd" id="a3">
    	<ol>
        <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["status"] == 3 ): ?><a href="<?php echo U('Orderyh/click_jump',array(order_num=>$vo['order_num']));?>">
                    <li>
                        <div class="dd_tx"><img src="<?php echo ($vo["headimgurl"]); ?>"/></div>
                        <div class="dd_bt">
                            <font class="bt"><?php echo ($vo["title"]); ?></font>
                            <font class="bt2"><?php echo ($order_type[$vo['order_type']]); ?></font>
                            <font class="bt3"><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></font>
                        </div>
                        <div class="ztai">
                             <font class="<?php echo ($order_status_class[$vo['status']]); ?>"><?php echo ($order_status[$vo['status']]); ?></font>
                          <font class="zt_q">￥<?php echo $vo['fee']/100;?> </font>
                            <font class="zt_q2">￥<?php echo ($vo["price"]); ?></font>
                        </div>
                    </li>
                </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ol>
    </div>
 

</div>
 
   <?php echo W('Include/foot');?> 

</div>
</body>
</html>