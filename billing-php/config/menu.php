<?php
/*
* @file
* File to provide with the menu option to be made available on the site
*/
  global $menuoptions;
  $menuoptions = array(
    'addItem' => array(
      'name'        => 'addItem',
      '#href'       => '?p=addItem',
      'description' => 'Add item',
      'perms'       => 'items'
    ),
    'billing' => array(
      'name'        => 'billing',
      '#href'       => '?p=billing',
      'description' => 'Billing',
      'perms'       => 'bill'
    ),
    'update' => array(
      'name'        => 'update',
      '#href'       => '?p=update',
      'description' => 'Inventory Management',
      'perms'       => 'items'
    ),
    'view_bill' => array(
      'name'        => 'view_bill',
      '#href'       => '?p=billing&view',
      'description' => 'View Bill',
      'perms'       => 'view_bill'
    )
  );

