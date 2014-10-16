<?php if(!defined('HDPHP_PATH'))exit();
return array (
	'DB_DRIVER'          => 'mysqli',
	'DB_CHARSET'         => 'utf8',
	'DB_HOST'            => '127.0.0.1',
	'DB_PORT'            => '3306',
	'DB_USER'            => 'root',
	'DB_PASSWORD'        => '',
	'DB_DATABASE'        => 'hd',
	'DB_PREFIX'          => 'hd_',
	'DB_BACKUP'          => 'backup/',
	'EDITOR_TYPE'        => 1,
	'EDITOR_STYLE'       => 1,
	'EDITOR_WIDTH'       => '100%',
	'EDITOR_HEIGHT'      => 300,
	'EDITOR_SAVE_PATH'   => 'upload/editor/',
	'EDITOR_IMAGE_WATER' => false,
	'URL_REWRITE'        => true,
	'URL_TYPE'           => 1,
	'ROUTE'              => array(
		'/^cate-(\d+)$/' => 'Index/Index/artlist/cid/#1',
		'/^art-(\d+)$/'  => 'Index/Index/artview/aid/#1'
	)
);