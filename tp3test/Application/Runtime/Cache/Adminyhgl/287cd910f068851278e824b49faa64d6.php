<?php if (!defined('THINK_PATH')) exit();?>﻿
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>后台</title>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<link rel="stylesheet" type="text/css" href="/Public/Adminyhgl/lib/bootstrap/css/bootstrap.css">

<link rel="stylesheet" type="text/css" href="/Public/Adminyhgl/stylesheets/theme.css">
<link rel="stylesheet" href="/Public/Adminyhgl/lib/font-awesome/css/font-awesome.css">

<script src="/Public/Adminyhgl/lib/jquery-1.7.2.min.js" type="text/javascript"></script>

<!-- Demo page code -->

<style type="text/css">
	#line-chart {
		height:300px;
		width:800px;
		margin: 0px auto;
		margin-top: 1em;
	}
	.brand { font-family: georgia, serif; }
	.brand .first {
		color: #ccc;
		font-style: italic;
	}
	.brand .second {
		color: #fff;
		font-weight: bold;
	}
</style>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->



</head>
<body>
	
<div class="navbar">
	<div class="navbar-inner">
			<ul class="nav pull-right">
				

				
				<?php echo W('Login/user');?>
				
			</ul>
			<a class="brand" href="index.html"><span class="second">速测后台</span></a>
	</div>
</div>

	
	
<div class="sidebar-nav">
	<?php echo W('LeftNav/leftlist');?>
</div>

	
	
 <div class="content">
        
        <div class="header">
            
            <h1 class="page-title">八字测算订单列表</h1>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
	<form action="<?php echo U('index_bzcs');?>" method="get">
		订单号:<input type="text" style="width: 130px;" name='order_num' placeholder="" value="<?php echo urldecode($map['order_num']);?>" />	
		姓:<input type="text" style="width: 130px;" name='xing' value="<?php echo urldecode($map['xing']);?>" />
		名:<input type="text" style="width: 130px;" name='ming' value="<?php echo urldecode($map['ming']);?>" />
		<?php if($is_super_admin): ?>推广商:<input type="text" style="width: 130px;" name='tgs' value="<?php echo urldecode($map['tgs']);?>" /><?php endif; ?>
		t值:<input type="text" style="width: 130px;" name='t' placeholder="101,105" value="<?php echo urldecode($map['t']);?>" />	
		支付状态:
		<select name="pay_status">
			<option value="-1" >未选</option>
		<?php if(is_array($pay_status)): $i = 0; $__LIST__ = $pay_status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($map['pay_status'] == $key): ?>selected<?php endif; ?> ><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		支付方式:
		<select name="pay_type">
			<option value="-1" >未选</option>
		<?php if(is_array($pay_type)): $i = 0; $__LIST__ = $pay_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($map['pay_type'] == $key): ?>selected<?php endif; ?> ><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		测算时间：
		<input style='width:150px' name="addstarttime" type="text" value="<?php echo urldecode($map['add_time_start']);?>" onfocus="new WdatePicker(this,'%Y-%M-%D %h:%m:%s',true)" />
		到
		<input style='width:150px' name="addendtime" type="text" value="<?php echo urldecode($map['add_time_end']);?>" onfocus="new WdatePicker(this,'%Y-%M-%D %h:%m:%s',true)" />
		<button class="btn btn-primary" type="submit">搜索</button>
		<div class="btn-group">
		</div>
	</form>
	
	<form action="<?php echo U('index_bzcs');?>" method="get">
		<input type="hidden" name='order_num' value="<?php echo urldecode($map['order_num']);?>" />
		<input type="hidden" name='xing' value="<?php echo urldecode($map['xing']);?>" />
		<input type="hidden" name='ming' value="<?php echo urldecode($map['ming']);?>" />
		<input type="hidden" name='tgs' value="<?php echo urldecode($map['tgs']);?>" />
		<input type="hidden" name='t' value="<?php echo urldecode($map['t']);?>" />
		<input type="hidden" name='pay_status' value="<?php echo urldecode($map['pay_status']);?>" />
		<input type="hidden" name='pay_type' value="<?php echo urldecode($map['pay_type']);?>" />
		<input type="hidden" name='addstarttime' value="<?php echo urldecode($map['add_time_start']);?>" />
		<input type="hidden" name='addendtime' value="<?php echo urldecode($map['add_time_end']);?>" />
		<button class="btn btn-primary" type="submit" name="export" value="export">导出</button>
	</form>
</div>
<div class="well">
	支付总金额:<span style="color:red"><?php echo round($pay_fee_all / 100, 2);?></span>
    <table class="table">
      <thead>
        <tr>
          <th>订单号</th>
          <th>姓名</th>
		  <th>出生日期</th>
		  <th>出生时辰</th>
          <th>性别</th>
		  <th>支付状态</th>
		  <th>支付金额</th>
		  <th>支付方式</th>
		  <th>支付时间</th>
		  <th>测算时间</th>
		  <th>推广商</th>
		  <th>广告位</th>
		  <th>t值</th>
        </tr>
      </thead>
      <tbody>
	  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>		 
          <td> <a href="<?php echo U('Allorder/index_bzcs',array('order_num'=>$vo['order_num']));?>"><?php echo ($vo["order_num"]); ?></a> </td>
          <td><?php echo ($vo["xing"]); echo ($vo["ming"]); ?></td>
		  <td><?php echo ($vo["year"]); ?>年<?php echo ($vo["month"]); ?>月<?php echo ($vo["day"]); ?>日</td>
		  <td><?php echo ($vo["hour"]); ?></td>
		  <td><?php echo ($SEX[$vo['sex']]); ?></td>
		  <td><?php echo ($pay_status[$vo['is_pay']]); ?></td>
		  <td><?php echo round($vo['pay_fee'] / 100, 2);?></td>
		  <td><?php echo ($pay_type[$vo['pay_type']]); ?></td>
		  <td><?php if(!empty($vo['pay_time'])): echo date('Y-m-d H:i:s', $vo['pay_time']); endif; ?></td>
		  <td><?php echo date('Y-m-d H:i:s', $vo['add_time']);?></td>
		  <td><?php echo ($vo["tgs"]); ?></td>
		  <td><?php echo ($vo["t_name"]); ?></td>
		  <td><?php echo ($vo["t"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
</div>


<?php echo ($page); ?>

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
    </div>
</div>


        
<footer>
	<hr>

	

</footer>

	<script src="/Public/Adminyhgl/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
          
<script src="/Public/Adminyhgl/lib/My97DatePicker/WdatePicker.js" type="text/javascript"></script>
                    
            </div>
        </div>
    </div>
    <script src="https://s19.cnzz.com/z_stat.php?id=1264379929&web_id=1264379929" language="JavaScript"></script>


</body>
</html>