<?php

return array(
    'ORDER_STATUS' => array(      
		1 => '进行中',
		2 => '去支付',
		3 => '去评价',
		4 => '已结束',
    ),
    'ORDER_STATUS_CLASS' => array(
        1 => 'zt_jx',
		2 => 'zt_zf',
		3 => 'zt_pj',
		4 => 'zt_js',
    ) 
    ,
    'ORDER_TYPE' => array(  
		1 => '学堂',
		2 => '普通提问',
		3 => '专业提问',
		4 => '偷偷听',
		5 => '速测',
    ),
	
	//*********************支付配置开始*************************************
	//注意，标号都是'ORDER_TYPE'配置项
	//支付完同步跳转链接
	'ORDER_JUMP' => array(  
		1 => 'https://www.baidu.com/pay_type/{%pay_type%}/order_no/{%order_no%}',
		2 => 'http://'.$_SERVER['HTTP_HOST'].'/index.php/Home/Question/order_detail/pay_type/{%pay_type%}/order_no/{%order_no%}',
		3 => 'https://www.baidu.com/pay_type/{%pay_type%}/order_no/{%order_no%}',
		4 => 'https://www.baidu.com/pay_type/{%pay_type%}/order_no/{%order_no%}',
		5 => 'https://www.baidu.com/pay_type/{%pay_type%}/order_no/{%order_no%}',
    ),
	//支付完异步跳转链接。如果有自己的数据库要改就要写。否则不用写，用原来默认的即可
	'ORDER_NOTIFY' => array(  
		1 => 'https://www.baidu.com/order_no/{%order_no%}',
    ),
	//支付完成后的钩子，用于运行额外的数据库处理。格式为：'controller:function'。
	//钩子调用时会把订单号当参数传进function
	'PAY_END_HOOK' => array(  
		1 => 'XueTang:pay_hook',
    ),
	//*********************支付配置结束*************************************
	
    'ORDER_TYPE_CLASS' => array(   //细分到模块
		'XT' => array(0=>'易学1',1=>'养生',2=>'易学'),
		'TW' => array(0=>'专业提问',1=>'普通提问'),
		'TT' => array(0=>'偷偷听'), 
		'SC' => array(0=>'偷偷听'), 
    ),
	'SEX' => array(  
		1 => '男',
		2 => '女',
    ),
    'PAY_TYPR' => array(  
		1 => '账户积分支付',  
		2 => '帐号余额支付',
		3 => '微信支付',
    ),
	 
);