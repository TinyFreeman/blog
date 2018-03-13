<?php if (!defined('THINK_PATH')) exit();?>	<div class="foot">
    	<li <?php if($i == 1 ): ?>class="cur"<?php endif; ?>>
			<a href=""><img src="/Public/Home/images/f_btn1<?php if($i == 1 ): ?>_1<?php endif; ?>.png"/><p>风云榜</p></a>
		</li>
        <li <?php if($i == 2 ): ?>class="cur"<?php endif; ?>>
			<a href="<?php echo U('Question/index');?>"><img src="/Public/Home/images/f_btn2<?php if($i == 2 ): ?>_2<?php endif; ?>.png"/><p>提问</p></a>
		</li>
        <li <?php if($i == 3 ): ?>class="cur"<?php endif; ?>>
			<a href=""><img src="/Public/Home/images/f_btn3<?php if($i == 3 ): ?>_3<?php endif; ?>.png"/><p>速测</p></a>
		</li>
        <li <?php if($i == 4 ): ?>class="cur"<?php endif; ?>>
			<a href="<?php echo U('XueTang/index');?>"><img src="/Public/Home/images/f_btn4<?php if($i == 4 ): ?>_4<?php endif; ?>.png"/><p>学堂</p></a>
		</li>
        <li <?php if($i == 5 ): ?>class="cur"<?php endif; ?>>
			<a href="<?php echo U('Personal/index');?>"><img src="/Public/Home/images/f_btn5<?php if($i == 5 ): ?>_5<?php endif; ?>.png"/><p>我的</p></a>
		</li>
    </div>