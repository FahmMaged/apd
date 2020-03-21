<?php
$xpdo_meta_map['Home']= array (
  'package' => 'nccpim',
  'version' => '1.1',
  'table' => 'Home',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'ID' => NULL,
    'Title_en' => NULL,
    'Description_en' => NULL,
    'Title_ar' => NULL,
    'Description_ar' => NULL,
    'Link' => NULL,
    'NumberOfViews' => NULL,
    'UpdatedOn' => 'CURRENT_TIMESTAMP',
    'UpdatedBy' => NULL,
  ),
  'fieldMeta' => 
  array (
    'ID' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'Title_en' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => true,
    ),
    'Description_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'Title_ar' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'Description_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'Link' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => true,
    ),
    'NumberOfViews' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '11',
      'phptype' => 'string',
      'null' => true,
    ),
    'UpdatedOn' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
      'default' => 'CURRENT_TIMESTAMP',
      'extra' => 'on update current_timestamp',
    ),
    'UpdatedBy' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
  'indexes' => 
  array (
    'PRIMARY' => 
    array (
      'alias' => 'PRIMARY',
      'primary' => true,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'ID' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
