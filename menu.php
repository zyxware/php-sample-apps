<?php
/**
* @file
* Script to handle the display of menu.
*
* Display menu's on each page. The menus are generated based on the active page,
* the user role.
*
* @params string $page
*   (Optional) The current page. Defaults to null.
*
* @returns array
*   an associate array containing variables.
*   - An array of menu items.
*     -#href: The link of the menu item.
*     -description: The discription of the menu item.
*     -perms: The permissions required to access that page.
*
*/
function generate_menu($page = NULL){
//This is set by the user.
  $menuoptions = array(
    array(
      'name'        => 'addItem',
      '#href'       => '?p=addItem',
      'description' => 'Add item',
      'perms'       => 'items'
    ),
    array(
      'name'        => 'billing',
      '#href'       => '?p=billing',
      'description' => 'Billing',
      'perms'       => 'bill'
    ),
    array(
      'name'        => 'update',
      '#href'       => '?p=update',
      'description' => 'Inventory Management',
      'perms'       => 'items'
    ),
    array(
      'name'        => 'view_bill',
      '#href'       => '?p=billing&view',
      'description' => 'View Bill',
      'perms'       => 'view_bill'
    )
  );
  $menu = array();
  if(isset($_SESSION['role'])){
    foreach ($menuoptions as $key => $val){
      if(check_perms($val['perms']) && $page != $val['name']){
        $menu[] = $val;
      }
    }
    $menu[] = array(
      '#href'       => '?p=logout',
      'description' => 'Logout',
      'perms'       => 'authenticated'
    );
  }
  return $menu;
}



