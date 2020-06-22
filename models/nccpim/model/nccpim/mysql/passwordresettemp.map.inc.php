<?php
$xpdo_meta_map['PasswordResetTemp']= array (
  'package' => 'nccpim',
  'version' => '1.1',
  'table' => 'PasswordResetTemp',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'email' => NULL,
    'key' => NULL,
    'expDate' => NULL,
  ),
  'fieldMeta' => 
  array (
    'email' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
    ),
    'key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
    ),
    'expDate' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
    ),
  ),
);
