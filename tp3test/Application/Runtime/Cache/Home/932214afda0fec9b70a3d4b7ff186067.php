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

<link rel="stylesheet" href="/Public/Home/css/bootstrap-fileinput.css">
<link rel="stylesheet" href="/Public/Home/css/calendar.css">
<link rel="stylesheet" href="/Public/Home/css/LArea.css">
<script src="/Public/Home/js/calendar.min.js"></script>
<script src="/Public/Home/js/main.js"></script>
<script src="/Public/Home/js/ss.js"></script>

<title>提问_普通回答</title>
</head>

<body>

<div class="ui_page">
   
<div class="tw_cont tw_cont2">
    	
    	<li>
        	<div class="ls_tx"><img src="/Public/Home/images/ls_tx.png"/><span>5.0</span></div>
            <ol class="ls_xx">
            	<li class="nam">玄武人4 <a href=""><span class="gz">+ 加关注</span></a></li>
                <li class="xx">八字六柱专家</li>
                <li class="xx xx2">234回答 · 85好评 · 9赞赏</li>
            </ol>
            <div class="ls_jq2"><a href=""><img src="/Public/Home/images/ds_ls.png"/><p>打赏老师</p></a></div>
        </li>
        
        <div class="ls_jj"><p>资深风水大师。曾就读于西北大学文博学院。遍访名师，考究名人故居、名筑古建、帝王将相陵寝，刻苦钻研阳宅风水精华、阴宅秘籍。讲实践与理论相结合，诸派共融，深得中国传统风水文化之精要。 </p></div>   
    </div>
    
    <div class="pt_zy_wd">
    	<ol class="choic">
        	<li id="n0" class="cho1 cur">普通回答</li>
            <li id="n1" class="cho2">专业回答</li>
        </ol>
        
        <!--普通回答-->
		<form method="post" enctype="multipart/form-data" action="<?php echo U('pay');?>">
			<div class="pt_hd" id="b0">
				<div class="ls_jj ls_jj2"><p style="font-size:16px; color:#888;">含2次追问；一事一测，老师的分析会更准确。
		起名/择日/风水改运等需要详细分析，请选用专业回答服务。</p></div>
				<div class="yhm"><span>李某某</span><img class="tj" src="/Public/Home/images/add.png"/></div>
				<div class="yhxx">测试用户 男 2001年8月8日 21:00~21 广西壮族自治区 南宁市</div>
				
				
				<div class="wt_xq">
					<p>问题详情</p>
					<p style="border-bottom:#CCC solid 1px;">
						<img src="/Public/Home/images/wtxq.png"/>
						<textarea placeholder="写上您的问题，专业老师火速赶来亲自为您解答。"></textarea>
					<p>
					
					<div class="shch">
						<div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
							<div class="fileinput-new thumbnail">
								<img id='picImg' style="width: 100%;height: auto;" src="/Public/Home/images/z_add.png" alt="" />
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail"></div>
							<input type="file" class="fil" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png">
							<a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">×</a>
						</div>
						<div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
							<div class="fileinput-new thumbnail">
								<img id='picImg' style="width: 100%;height: auto;" src="/Public/Home/images/z_add.png" alt="" />
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail"></div>
							<input type="file" class="fil" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png">
							<a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">×</a>
						</div>
						<div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
							<div class="fileinput-new thumbnail">
								<img id='picImg' style="width: 100%;height: auto;" src="/Public/Home/images/z_add.png" alt="" />
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail"></div>
							<input type="file" class="fil" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png">
							<a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">×</a>
						</div>
						
						<div class="csnkao">参考示例</div>
						
						<div class="oth">如果看手面相或者风水，请上传小于5M的图片</div>
						
					</div>
		
				<script src="/Public/Home/js/bootstrap-fileinput.js"></script>
				</div>
	 
		  

				
				<script src="/Public/Home/js/LAreaData1.js"></script>
				<script src="/Public/Home/js/LAreaData2.js"></script>
				<script src="/Public/Home/js/LArea.js"></script>
				<script>
					var area1 = new LArea();
					area1.init({
						'trigger': '#demo1', 
						'valueTo': '#value1', 
						'keys': {
							id: 'id',
							name: 'name'
						}, 
						'type': 1, 
						'data': LAreaData 
					});
					area1.value=[1,13,3];
					var area2 = new LArea();
					area2.init({
						'trigger': '#demo2',
						'valueTo': '#value2',
						'keys': {
							id: 'value',
							name: 'text'
						},
						'type': 2,
						'data': [provs_data, citys_data, dists_data]
					});
				</script>
	 
				<label class="tishi"><input checked type="checkbox"/> 公开提问，答案每被人偷偷听一次，你将从中获得￥0.5元</label>
				
				<div class="zf_pay">共需支付<span>9.9元</span></div>
				<div class="zf_p">原价<span>99.9元</span></div>
				<div class="zf_p">积分减免<span>-90.00元</span></div>
				
				<button class="over" type="submit">写好了</button>
			</div>
		</form>
        <!--普通回答end-->
            <div class="tabel">
                <div class="tb_box">
                    <p>请输入用户信息</p>
                    <span class="off_tb">×</span>
                    <form>
                    <div class="tb_b">              
                        <li>
                            <label>您的姓名：</label>
                            <input type="text" placeholder="请输入姓名"/>
                        </li>
                        <li>
                            <label>您的性别：</label>
                            <div class="sex">
                                <span id="1" class="cur"><i></i><font>男</font></span>
                                <span id="0"><i></i><font>女</font></span>
                                <input id="xb" type="hidden" name="sex" value="1" />
                            </div>
                        </li>
                        <li>
                            <label>出生日期：</label>
                            <input type="text" id="birthday" data-input-id="b_input" class="Js_date" data-type="1" value="" placeholder="请选择日期"/><input type="hidden" name="birthday" id="b_input">
                        </li>
                        <li style="border:none;">
                            <label>出生地点：</label>
                            <input id="demo1" type="text" readonly placeholder="请选择地点"/>
                            <input id="value1" type="hidden" value="20,234,504">
                        </li>
                    </div>
                        <button type="submit">提 交</button>
                    
                    </form>
                </div>
            </div>
        <!--专业回答-->
        <div class="zy_hd" id="b1">
        	<label class="zy_chio">
            	<p class="chi_bt">MBTI职业性格分析<input name="zy_ch" type="radio" checked style="display:none" /><font></font></p>
            </label>
            <label>
            	<p class="chi_bt">心理咨询<input name="zy_ch" type="radio" style="display:none" /><font></font></p>
                <p class="zyc_txt">根据您心里的疑惑和烦恼，给您最诚心的关怀与指导，助您拥有更美好的明天</p>
            </label>
            <label>
            	<p class="chi_bt">2018流年运程<input name="zy_ch" type="radio" style="display:none" /><font></font></p>
                <p class="zyc_txt">根据您的生辰八字，对来年规划进行指导，助您趋吉避凶，好运一整年</p>
            </label>
            <label>
            	<p class="chi_bt">2018流年运程<input name="zy_ch" type="radio" style="display:none" /><font></font></p>
                <p class="zyc_txt">根据您的生辰八字，对来年规划进行指导，助您趋吉避凶，好运一整年</p>
            </label>
            	<p class="zyc_txt2">服务说明：<br>1. 通过文字、图片、语音进行1对1咨询<br>2. 服务期时长为48小时<br>3. 可详细咨询购项目的相关问题</p>
                
                <button class="over" type="submit">马上咨询</button>
        </div>
        <!--专业回答end-->
    </div>
    
    
    
    <script type="text/javascript">
	$(function() {
		var active=0,
		as=document.getElementById('pagenavi').getElementsByTagName('a');
		for(var i=0;i<as.length;i++){
			(function(){
				var j=i;
				as[i].onclick=function(){
					t1.slide(j);
					return false;
				}
			})();
		}
		var t1=new TouchSlider({id:'sliderlist', speed:600, timeout:5000, before:function
	
	(index){
				as[active].className='';
				active=index;
				as[active].className='active';
		}});
	});
	</script>
    
    <!--回答问题-->
    <div class="hd_wt">
    	<div class="hd_wtbox">
        	<ol class="hd_pl">
            	<li id="j0" class="cur">回答问题（6414）</li>
                <li id="j1" style="border-right:none">用户评价（942）</li>
            </ol>
            
            <div class="hd" id="c0">
            	<div class="huida">
                	<p>刚刚装修了新房，入住后总感觉怪怪的，期间工作不顺，钱存不住多少老想花。这房子在顶层正冲向下楼梯，而且入户门跟我的卧室阳台门三门一直线。我今天在网上请了桃木八卦凹镜和一串五帝钱。主入口门楣上挂八卦凹镜卧室门挂五帝钱。阳台门现有遮光窗帘。请问这样可以吗。真是谢谢了。</p>
                    <p><img src="/Public/Home/images/huida1.jpg"/><img src="/Public/Home/images/huida2.jpg"/></p>
                    
                    <p class="touting">
                        <div class="ls_tx"><img src="/Public/Home/images/ls_tx.png"/><span>5.0</span></div>
                        <ol class="ls_xx ls_xx2">
                            <li class="tout"><a href=""><img src="/Public/Home/images/tout.png"/></a></li>
                            <li class="xx xx2">122" · 听过1.5k · 打赏24 <span style="float:right;">12-22 18:00</span></li>
                        </ol>
                    </p>
                </div>
            </div>
            
            <div class="pl" id="c1">
            	<div class="pilun">
                	<p><img src="/Public/Home/images/pl_1.jpg"/>随***逝<span><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi2.png"/></span></p>
                    <p class="pltxt">老师你说的真的特别对，给我提的搞好人际关系的建议我会努力加油的！很感谢！</p>
                </div>
                <div class="pilun">
                	<p><img src="/Public/Home/images/pl_1.jpg"/>随***逝<span><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/></span></p>
                    <p class="pltxt">老师你说的真的特别对，给我提的搞好人际关系的建议我会努力加油的！很感谢！</p>
                </div>
                <div class="pilun">
                	<p><img src="/Public/Home/images/pl_1.jpg"/>随***逝<span><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/><img src="/Public/Home/images/xi1.png"/></span></p>
                    <p class="pltxt">老师你说的真的特别对，给我提的搞好人际关系的建议我会努力加油的！很感谢！</p>
                </div>
                <div class="pilun">
                	<p style="text-align:center; color:#f86049;">查看全部评论</p>
                </div>
            </div>
            
        </div>
    </div>
	
	<div class="cankao">
    	<div class="ck_box">
        
        	<div class="banner">
                <div class="slider" id="slider" style="overflow: hidden; visibility: visible; list-style: none; position: relative;">
                    <ul class="sliderlist" id="sliderlist">           
                        <li><span><font>手相正确示例</font><img src="/Public/Home/images/shou.jpg" alt="" width="100%"></span></li>
                        <li><span><font>风水正确示例</font><img src="/Public/Home/images/snfs.jpg" alt="" width="100%"></span></li>
                        <li><span><font>面相正确示例</font><img src="/Public/Home/images/zjz.jpg" alt="" width="100%"></span></li>
                    </ul>
                    <div id="pagenavi">
                         <a href="javascript:void(0);" class="active">1</a>
                         <a href="javascript:void(0);" class="">2</a>
                         <a href="javascript:void(0);" class="">3</a>
                    </div>
                </div>
                
                <div class="off_bnr">×</div>
            </div>
            
        </div>
    </div>
 
   <?php echo W('Include/foot');?> 

</div>
</body>
</html>