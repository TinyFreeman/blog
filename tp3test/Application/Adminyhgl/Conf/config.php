<?php

return array(
	'DEFAULT_THEME'    =>    MODULE_NAME ,
	/* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/stylesheets',
        '__LIB__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/lib',
    ),
    'LOAD_EXT_CONFIG' => 'autority,status'
);