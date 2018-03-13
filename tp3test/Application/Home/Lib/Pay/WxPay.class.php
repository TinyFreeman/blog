<?php

namespace Home\Lib\Pay;

//微信支付类
class WxPay {	
	
	private $pay_type = 3; //支付类型编号
	
	//根据支付订单号获取订单信息，并生成微信支付参数
	private function get_order_info_wx($pay_order_num){
		$m = D('OrderNum');
		$order_info = $m->get_order_info($pay_order_num);
		
		$ORDER_JUMP = C('ORDER_JUMP');
		$ORDER_NOTIFY = C('ORDER_NOTIFY');
		
		$notify_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php/Home/Pay/wx_pay_notify_check';

		//同步跳转地址生成
		$jump_url = str_replace("{%pay_type%}", $this->pay_type, str_replace("{%order_no%}", $order_info['order_num'], $ORDER_JUMP[$order_info['order_type']]));
		
		if($order_info){
			$ORDER_TYPE = C('ORDER_TYPE');
			return array(
				'pay_order_num' => $order_info['pay_order_num'],
				'fee' => $order_info['fee']/100,
				'notify_url' => $notify_url,
				'jump_url' => $jump_url,
				'body' => $ORDER_TYPE[$order_info['order_type']],
				'attach' => '',
			);	
		} else {
			
		}
		
	}
	
	//微信支付
    public function wx_pay($pay_order_num){
		
		$openid = session('openid');
		
		$order_info = $this->get_order_info_wx($pay_order_num); //生成微信支付参数
	
		$order_no = $order_info['pay_order_num'];    //必填 订单号
		$fee = $order_info['fee'];         //必填 付款金额，单位元
		$notify_url = $order_info['notify_url'];  //必填 支付回调链接（后端）
		$jump_url = $order_info['jump_url'];    //必填 支付跳转链接（前端）
		$body = $order_info['body'];        //必填 商品简单描述，如：腾讯充值中心-QQ会员充值
		$attach = $order_info['attach'];      //选填 附加数据，在查询API和支付通知中原样返回，可作为自定义参数使用。
		
		require APP_PATH . 'Home/Util/WxPay/example/jsapi.php';
		
    }
	
	/**
     * 微信支付查询订单
     * @param $order_no 订单号
     * @return array 
     */
	public function wx_query($order_no){
		require APP_PATH . 'Home/Util/WxPay/lib/WxPay.Api.php';
		$input = new \WxPayOrderQuery();
		$input->SetOut_trade_no($order_no);
		return \WxPayApi::orderQuery($input);
	}
	
	//测试支付回调
	public function test_notify(){
		$wx_pay_notify_arr = array (
		  'appid' => 'wxce32103f40af4ec0',
		  'bank_type' => 'SPDB_CREDIT',
		  'cash_fee' => '1',
		  'fee_type' => 'CNY',
		  'is_subscribe' => 'Y',
		  'mch_id' => '1488151482',
		  'nonce_str' => '7evf0e9tclk0tmt5qnovbyyw1uu8vf3d',
		  'openid' => 'oonEi0wGShPZDygUyP853VUNWXNc',
		  'out_trade_no' => '888832137701',
		  'result_code' => 'SUCCESS',
		  'return_code' => 'SUCCESS',
		  'sign' => 'DD280A99822E2AA3603CBCFBF84F00C7',
		  'time_end' => '20180106110552',
		  'total_fee' => '499',
		  'trade_type' => 'JSAPI',
		  'transaction_id' => '4200000092201801069072537641',
		);
		$this->set_has_pay($wx_pay_notify_arr);
	}
	//测试支付回调
	public function test_notify_2(){
$xml = '
<xml><appid><![CDATA[wxce32103f40af4ec0]]></appid>
<bank_type><![CDATA[SPDB_CREDIT]]></bank_type>
<cash_fee><![CDATA[1]]></cash_fee>
<fee_type><![CDATA[CNY]]></fee_type>
<is_subscribe><![CDATA[Y]]></is_subscribe>
<mch_id><![CDATA[1488151482]]></mch_id>
<nonce_str><![CDATA[68mgkxy98at6sx0b2yk89xahse1bdk3e]]></nonce_str>
<openid><![CDATA[oonEi0wGShPZDygUyP853VUNWXNc]]></openid>
<out_trade_no><![CDATA[CS201801081114517370152882963]]></out_trade_no>
<result_code><![CDATA[SUCCESS]]></result_code>
<return_code><![CDATA[SUCCESS]]></return_code>
<sign><![CDATA[B1FDC673B4D9CBB992D9DA76DC86A11A]]></sign>
<time_end><![CDATA[20180108111505]]></time_end>
<total_fee>1</total_fee>
<trade_type><![CDATA[JSAPI]]></trade_type>
<transaction_id><![CDATA[4200000097201801080296251633]]></transaction_id>
</xml>
';echo file_get_contents('php://input');exit;
		$this->wx_pay_notify_check();
	}
	
	
	//微信回调验证签名
	public function wx_pay_notify_check(){
		require APP_PATH . 'Home/Util/WxPay/lib/WxPay.Api.php';		
		\WxPayApi::notify(array($this, 'set_has_pay'));
	}
	
	//微信回调验证签名正确后，调用这个方法，数据库逻辑在这里
	public function set_has_pay($wx_pay_notify_arr){	
		$pay_order_num = $wx_pay_notify_arr['out_trade_no']; //支付订单号
		$fee = $wx_pay_notify_arr['total_fee'];    //支付金额，单位分
		
		$mo = D('OrderNum');
		$mp = D('PayOrder');
		
		$order_num = $mp->get_order_num($pay_order_num); //获取订单号
		
		if($mo->check_fee($order_num, $fee)){  //核对支付金额正确，修改成已支付

			$mo->set_has_pay($order_num);
			$mp->set_has_pay($pay_order_num);
			
			//执行钩子
			PayPublicOperate::run_hook($order_num);
			
			echo '<xml>
				    <return_code><![CDATA[SUCCESS]]></return_code>
				    <return_msg><![CDATA[OK]]></return_msg>
				</xml>';
		} else {
			echo '<xml>
				    <return_code><![CDATA[SUCCESS]]></return_code>
				    <return_msg><![CDATA[金额不对]]></return_msg>
				</xml>';
		}
		

	}
	
	public function put_log($msg){
		if(is_array($msg)){
			$msg = var_export($msg, true);
		}
		file_put_contents(__DIR__.'/log', $msg,FILE_APPEND);
	}
	
}