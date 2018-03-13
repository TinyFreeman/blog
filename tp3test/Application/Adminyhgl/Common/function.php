<?php

function numeric($v){
	if(!is_numeric($v) || empty($v)){
		echo '非法操作';exit;
	}
}


function fen2yuan($fen){
	return round($fen / 100, 2);
}

function upload_pic($inputname, $filename){
	if(!empty($_FILES[$inputname]['name'])){
		$upload_dir = './Upload/';	
		$name = $upload_dir.$filename;	
		move_uploaded_file($_FILES[$inputname]['tmp_name'], $name);
		return $name;
	}
	return '';
}