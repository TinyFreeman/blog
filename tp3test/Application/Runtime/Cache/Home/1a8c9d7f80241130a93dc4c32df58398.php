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
   
   <div class="tw_head_sctop">
        <div class="tw_head_sc">

            <li onmousedown="aa(0)" id="m0" class="cur">推荐<p></p></li>
         <?php if(is_array($type_class)): foreach($type_class as $k=>$vo): ?><li onmousedown="aa(<?php echo ($vo["id"]); ?>)" id="m<?php echo ($vo["id"]); ?>" ><?php echo ($vo["name"]); ?><p></p></li><?php endforeach; endif; ?>
            
        </div>
    </div>
     
   <div class="xuetang" id="a0">
         <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voli): $mod = ($i % 2 );++$i; if($voli["is_show"] == 1): if($voli["b_price"] == 0): ?><a href="/index.php/Home/XueTang/detail/did/<?php echo ($voli["id"]); ?>"> 
                            <?php else: ?>
                            <a href="/index.php/Home/XueTang/payDetail?id=<?php echo ($voli["id"]); ?>"><?php endif; ?>
                            <li>
                                <div class="dd_tx dd_tx3"><img src="/Upload/audio/<?php echo ($voli["pictrue"]); ?>"/></div>
                                <div class="dd_bt dd_bt2">
                                    <font class="bt"> <?php echo ($voli["title"]); ?>...</font>
                                    <font class="bt2">时长<?php echo ($voli["duration"]); ?></font>
                                    <font class="bt3">6k学习 · 99.7% · 好评<b style="color:#f86049;">￥<?php if(($voli["b_price"]) == "0"): ?>免费<?php else: echo ($voli["b_price"]); endif; ?></b><span>￥<?php echo ($voli["a_price"]); ?></span></font>
                                </div>
                            </li>
                        </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
 
    <?php if(is_array($type_class)): foreach($type_class as $k=>$vo): ?><div class="xuetang" id="a<?php echo ($vo["id"]); ?>">
            
          
             <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voli): $mod = ($i % 2 );++$i; if($voli["cate_id"] == $vo["id"] ): if($voli["b_price"] == 0): ?><a href="/index.php/Home/XueTang/detail/did/<?php echo ($voli["id"]); ?>"> 
                            <?php else: ?>
                            <a href="/index.php/Home/XueTang/payDetail?id=<?php echo ($voli["id"]); ?>"><?php endif; ?>
                        
                        <li>
                            <div class="dd_tx dd_tx3"><img src="/Upload/audio/<?php echo ($voli["pictrue"]); ?>"/></div>
                            <div class="dd_bt">
                                <font class="bt"> <?php echo ($voli["title"]); ?>...</font>
                                <font class="bt2">升运堂 | 时长<?php echo ($voli["duration"]); ?><span>专栏</span></font>
                                <font class="bt3">6k学习 · 99.7% · 好评</font>
                            </div>
                            <div class="ztai" style="margin-top:15px;">
                                <font class="zt_jx" style="font-weight:bold;">￥<?php if(($voli["b_pirce"]) == "0"): ?>免费<?php else: echo ($voli["b_price"]); endif; ?></font> 
                                <font class="zt_q2">￥<?php echo ($voli["a_price"]); ?></font>
                            </div>

                            <!-- <div class="ztai" style="margin-top:15px;">
                                <font  class="zt_jx" style="font-weight:bold;">￥<?php if(($voli["b_pirce"]) == "0"): ?>免费<?php else: echo ($voli["b_price"]); endif; ?></font>
                                <font class="zt_q2"><span>￥<?php echo ($voli["a_price"]); ?></span></font>
                            </div> -->
                        </li>
                    </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            
        </div><?php endforeach; endif; ?>
   
     
    
   
      
    
</div>
 
   <?php echo W('Include/foot');?> 

</div>
</body>
</html>