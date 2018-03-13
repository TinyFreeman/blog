<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<link rel="stylesheet" href="/tp3test/Public/Home/css/style.css">
<title>微信验证</title>
<script src="/tp3test/Public/Home/js/jquery-1.12.3.min.js"></script>
</head>

<body>
		
	<div style="width:100%; height:100%; float:left; background:#faf8ef; position:fixed; z-index:1; max-width:640px; overflow-y:auto;">
    	<div style="width:100%; height:auto; float:left; padding-bottom:50px;">	
            <div class="wx_yzbanner"><img src="/tp3test/Public/Home/images/wx_yanzh.jpg"/></div>
            
            <p style="font-size:18px; font-weight:bold; color:#6e5846; padding:0 3%; margin-top:30px;"><img style="width:16px; height:20px; vertical-align:middle; margin-bottom:5px; margin-right:10px;" src="/tp3test/Public/Home/images/yz2.png"/>验证微信号：</p>
            <div class="wxyz_box">
            	<input type="text" id="wxname" placeholder="请输入与您交流的咨询师微信号查询真伪"/>
                <button id="but" class="wxyz_fdj"><img src="/tp3test/Public/Home/images/fybss.png"/></button>
            </div>

<p style="font-size:18px; font-weight:bold; color:#6e5846; padding:0 3%; margin-top:30px;"><img style="width:18px; height:22px; vertical-align:middle; margin-bottom:5px; margin-right:10px;" src="/tp3test/Public/Home/images/yz1.png"/>风生水提示：</p>
            <p style="font-size:16px; color:#000; line-height:28px; padding:0 3%; margin-top:15px; text-justify:auto; text-align:justify;">近日来，发现不法分子抄袭盗用风生水宣传材料，高仿风生水微信账号，冒充风生水咨询师行骗以及恶意诋毁风生水，严重威胁用户利益，影响风生水声誉。</p>
            <p style="font-size:16px; color:#000; line-height:28px; padding:0 3%; margin-top:15px; text-justify:auto; text-align:justify;">为了维护<span style="font-weight:bold;">您的利益</span>和风水生的声誉，请查询与您交流的是否为风生水签约咨询师。</p>
            
            <p style="text-align:center; margin-top:20px; font-size:16px;">更多疑问请点击 <a style="color:#b8a589; text-decoration:underline;" href="tel:4008884737">联系专属客服</a></p>
            
        </div>    
        </div> 
        <script type="text/javascript">
            $(".wxyz_fdj").click(function(){
                
                var url  = '/tp3test/index.php/Home/Index/check',
                    name = $('#wxname').val();
                if(name == ''){
                    alert("请输入微信号");
                    return false;
                }
                $.post(url,{name:name},function(data) {
                    if(data.msg == 1){
                        $("#yes").show();
                    }else{
                        $("#no").show();
                    }
                },'json');
            });

        </script>
        
        <div class="wxyz_no" id="no">
        	<div class="yanzheng">
            	<img src="/tp3test/Public/Home/images/wxyz_no.png"/>
                <div class="yanzheng_z">
                	<p>该微信号不属于风生水</p>
                    <p>请谨慎咨询！</p>
                    <p style="margin-top:20px;"><span id="off1">关闭</span></p>
                </div>
            </div>
        </div>
        
        <div class="wxyz_no" id="yes">
        	<div class="yanzheng">
            	<img src="/tp3test/Public/Home/images/wxyz_yes.png"/>
                <div class="yanzheng_z">
                	<p>该微信号是风生水官方微信</p>
                    <p>请放心咨询！</p>
                    <p style="margin-top:20px;"><span id="off2">关闭</span></p>
                </div>
            </div>
        </div> 
        
        <script>
		$(document).ready(function(){
		  $("#but").click(function(){
			  
			  
			  });	
		  $("#off2").click(function(){
			  $("#yes").hide();
			  });
		  $("#off1").click(function(){
			  $("#no").hide();
			  });
		});
        </script>  
    
    
</body>
</html>