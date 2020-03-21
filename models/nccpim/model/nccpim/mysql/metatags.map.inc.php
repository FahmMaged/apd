<?php
$xpdo_meta_map['MetaTags']= array (
  'package' => 'nccpim',
  'version' => '1.1',
  'table' => 'MetaTags',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'ID' => NULL,
    'AboutTitle_en' => NULL,
    'AboutDescription_en' => NULL,
    'AboutTitle_ar' => NULL,
    'AboutDescription_ar' => NULL,
    'HomeTitle_en' => NULL,
    'HomeDescription_en' => NULL,
    'HomeTitle_ar' => NULL,
    'HomeDescription_ar' => NULL,
    'FacilitiesTitle_en' => NULL,
    'FacilitiesDescription_en' => NULL,
    'FacilitiesTitle_ar' => NULL,
    'FacilitiesDescription_ar' => NULL,
    'NewsTitle_en' => NULL,
    'NewsDescription_en' => NULL,
    'NewsTitle_ar' => NULL,
    'NewsDescription_ar' => NULL,
    'GalleryTitle_en' => NULL,
    'GalleryDescription_en' => NULL,
    'GalleryTitle_ar' => NULL,
    'GalleryDescription_ar' => NULL,
    'ContactTitle_en' => NULL,
    'ContactDescription_en' => NULL,
    'ContactTitle_ar' => NULL,
    'ContactDescription_ar' => NULL,
    'PageID' => NULL,
    'UpdatedOn' => NULL,
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
    'AboutTitle_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'AboutDescription_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'AboutTitle_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'AboutDescription_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'HomeTitle_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'HomeDescription_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'HomeTitle_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'HomeDescription_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'FacilitiesTitle_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'FacilitiesDescription_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'FacilitiesTitle_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'FacilitiesDescription_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'NewsTitle_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'NewsDescription_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'NewsTitle_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'NewsDescription_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'GalleryTitle_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'GalleryDescription_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'GalleryTitle_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'GalleryDescription_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'ContactTitle_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'ContactDescription_en' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'ContactTitle_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'ContactDescription_ar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'PageID' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'UpdatedOn' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
    ),
    'UpdatedBy' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '150',
      'phptype' => 'string',
      'null' => false,
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
