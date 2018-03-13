<?php if (!defined('THINK_PATH')) exit(); if($is_super_admin || in_array(1, $userAuthority)): ?><a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class=""></i>用户管理</a>
<ul id="dashboard-menu" class="nav nav-list collapse in">
	<li ><a href="<?php echo U('User/index');?>">用户列表</a></li>
	<li ><a href="<?php echo U('Role/index');?>">角色列表</a></li>		
	<li ><a href="<?php echo U('XueTang/index');?>">学堂列表</a></li>	
	<li ><a href="<?php echo U('Cate/index');?>">学堂分类</a></li>	
</ul><?php endif; ?>