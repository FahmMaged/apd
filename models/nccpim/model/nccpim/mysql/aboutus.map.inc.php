<?php
$xpdo_meta_map['AboutUs']= array (
  'package' => 'nccpim',
  'version' => '1.1',
  'table' => 'AboutUs',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'ID' => NULL,
    'FirstTitle_en' => NULL,
    'FirstDescription_en' => NULL,
    'FirstTitle_ar' => NULL,
    'FirstDescription_ar' => NULL,
    'SecondTitle_ar' => NULL,
    'SecondTitle_en' => NULL,
    'SecondDescription_ar' => NULL,
    'SecondDescription_en' => NULL,
    'ThirdTitle_ar' => NULL,
    'ThirdTitle_en' => NULL,
    'ThirdDescription_ar' => NULL,
    'ThirdDescription_en' => NULL,
    'FourthTitle_en' => NULL,
    'FourthTitle_ar' => NULL,
    'FourthDescription_en' => NULL,
    'FourthDescription_ar' => NULL,
    'FirstImage' => NULL,
    'SecondImage' => NULL,
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
    'FirstTitle_en' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => true,
    ),
    'FirstDescription_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'FirstTitle_ar' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'FirstDescription_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'SecondTitle_ar' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'SecondTitle_en' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'SecondDescription_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'SecondDescription_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'ThirdTitle_ar' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'ThirdTitle_en' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'ThirdDescription_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'ThirdDescription_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'FourthTitle_en' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'FourthTitle_ar' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'FourthDescription_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'FourthDescription_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'FirstImage' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'SecondImage' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
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
