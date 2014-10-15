<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'aid' => 
  array (
    'field' => 'aid',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
  ),
  'catid' => 
  array (
    'field' => 'catid',
    'type' => 'smallint(5) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'title' => 
  array (
    'field' => 'title',
    'type' => 'char(100)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'content' => 
  array (
    'field' => 'content',
    'type' => 'text',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'click' => 
  array (
    'field' => 'click',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'thumb' => 
  array (
    'field' => 'thumb',
    'type' => 'varchar(255)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'uid' => 
  array (
    'field' => 'uid',
    'type' => 'mediumint(8) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'source' => 
  array (
    'field' => 'source',
    'type' => 'char(50)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'addtime' => 
  array (
    'field' => 'addtime',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'updatetime' => 
  array (
    'field' => 'updatetime',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'ban' => 
  array (
    'field' => 'ban',
    'type' => 'tinyint(1) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
);
?>