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

<title>提问</title>
</head>

<body>

<div class="ui_page">
   
<div class="tw_head">
    	<li onmousedown="aa(0)" id="m0" class="cur">感情<p></p></li>
        <li onmousedown="aa(1)" id="m1">事业<p></p></li>
        <li onmousedown="aa(2)" id="m2">风水<p></p></li>
        <li onmousedown="aa(3)" id="m3">财运<p></p></li>
    </div>
    
    <div class="tw_cont" id="a0">
		<?php if(is_array($dazhu)): $i = 0; $__LIST__ = $dazhu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('ask', array('id'=>$vo['id']));?>">
			<li>
				<div class="ls_tx"><img src="<?php echo ($vo["headimgurl"]); ?>"/><span>5.0</span></div>
				<ol class="ls_xx">
					<li class="nam"><?php echo ($vo["nickname"]); ?></li>
					<li class="xx">八字六柱专家</li>
					<li class="xx xx2">234回答 · 85好评 · 9赞赏</li>
				</ol>
				<div class="ls_jq"><font>￥19.9</font><span>￥5.9</span></div>
			</li>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    
    <div class="tw_cont" id="a1">
    	<a href="#">
    	<li>
        	<div class="ls_tx"><img src="/Public/Home/images/ls_tx.png"/><span>5.0</span></div>
            <ol class="ls_xx">
            	<li class="nam">玄武人2</li>
                <li class="xx">八字六柱专家</li>
                <li class="xx xx2">234回答 · 85好评 · 9赞赏</li>
            </ol>
            <div class="ls_jq"><font>￥19.9</font><span>￥5.9</span></div>
        </li>
        </a>  
    </div>
    
    <div class="tw_cont" id="a2">
    	<a href="#">
    	<li>
        	<div class="ls_tx"><img src="/Public/Home/images/ls_tx.png"/><span>5.0</span></div>
            <ol class="ls_xx">
            	<li class="nam">玄武人3</li>
                <li class="xx">八字六柱专家</li>
                <li class="xx xx2">234回答 · 85好评 · 9赞赏</li>
            </ol>
            <div class="ls_jq"><font>￥19.9</font><span>￥5.9</span></div>
        </li>
        </a>  
    </div>
    
    <div class="tw_cont" id="a3">
    	<a href="#">
    	<li>
        	<div class="ls_tx"><img src="/Public/Home/images/ls_tx.png"/><span>5.0</span></div>
            <ol class="ls_xx">
            	<li class="nam">玄武人4</li>
                <li class="xx">八字六柱专家</li>
                <li class="xx xx2">234回答 · 85好评 · 9赞赏</li>
            </ol>
            <div class="ls_jq"><font>￥19.9</font><span>￥5.9</span></div>
        </li>
        </a>  
    </div>
 
   <?php echo W('Include/foot');?> 

</div>
</body>
</html>