<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'mediumint(8) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
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
  'value' => 
  array (
    'field' => 'value',
    'type' => 'varchar(100)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'show_type' => 
  array (
    'field' => 'show_type',
    'type' => 'tinyint(1)',
    'null' => 'NO',
    'key' => false,
    'default' => '1',
    'extra' => '',
  ),
  'description' => 
  array (
    'field' => 'description',
    'type' => 'varchar(255)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'option' => 
  array (
    'field' => 'option',
    'type' => 'varchar(255)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'name' => 
  array (
    'field' => 'name',
    'type' => 'char(30)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
);
?>