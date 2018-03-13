<?php if (!defined('THINK_PATH')) exit();?><li id="fat-menu" class="dropdown">
	<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
		<i class="icon-user"></i> <?php echo ($username); ?>
		<i class="icon-caret-down"></i>
	</a>

	<ul class="dropdown-menu">
		<li><a tabindex="-1" href="<?php echo U('Login/logout');?>">退出</a></li>
	</ul>
</li>