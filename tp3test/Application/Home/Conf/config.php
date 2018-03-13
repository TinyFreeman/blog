<?php

return array(
	'DEFAULT_THEME'    =>    '' ,
	/* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
    	'__UPLOAD__'    => __ROOT__ . '/Upload/audio/',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
    ),
    'LOAD_EXT_CONFIG' => 'status'
    
);