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

<title>我的关注</title>
</head>

<body>

<div class="ui_page">
   

<div class="ui_page">
	
    <div class="tw_cont tw_cont2">
        <?php if(is_array($dashi)): $i = 0; $__LIST__ = $dashi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="border-bottom:#ebebeb solid 1px;">
            	<div class="ls_tx"><img src="<?php echo ($vo["headimgurl"]); ?>"/><span><?php echo ($vo["score"]); ?></span></div>
                <ol class="ls_xx">
                	<li class="nam"><span class ="dsname"><?php echo ($vo["name"]); ?></span>

       
                <?php if(in_array($vo['user_id'],$guanzhu)): ?><!-- <a href=""> -->

                <span url = "<?php echo U('Fs/is_guanzhu',array('guanzhu'=>$vo['user_id'],'is_g'=>0));?>" class="ygz"  ><img src="/Public/Home/images/ygz.png"/> 已关注</span>

                <!-- </a> -->
                <?php else: ?> <!-- <a href=""> -->

                <span url = "<?php echo U('Fs/is_guanzhu',array('guanzhu'=>$vo['user_id'],'is_g'=>1));?>" class="gz">+ 加关注</span><!-- </a> --><?php endif; ?>
 

                    </li>
                    <li class="xx"><?php echo ($vo["specialty"]); ?></li>
                    <li class="xx xx2">234回答 · 85好评 · 9赞赏</li>
                </ol>
                <div class="ls_jq2"><a href=""><img src="/Public/Home/images/ds_ls.png"/><p>打赏老师</p></a></div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>


<!-- 点击关注与取消关注js -->
<script>
$(function(){
    $('.gz').click(function(){
      var dsname = $(this).prev().text(); 
      var url =    $(this).attr('url');
      
      var on_click = confirm('确定关注'+dsname+'么?')
        if (on_click) {
            
             window.location.href=url
        }else{
           return false;
        }
    })
    $('.ygz').click(function(){
         var dsname = $(this).prev().text();
         var url =    $(this).attr('url');
        
         var on_click = confirm('确定取消关注'+dsname+'么?')
        if (on_click) {
            
                window.location.href=url
        }else{
            return false;
        }
    })     
})

</script>
 
   <?php echo W('Include/foot');?> 

</div>
</body>
</html>