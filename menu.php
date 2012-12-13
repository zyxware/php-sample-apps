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
  require_once "./menu.cfg";
  global $menuoptions;
  $menu = array();
  if(isset($_SESSION['role'])){
    foreach ($menuoptions as $key => $val){
      if(check_perms($val['perms']) && $page != $val['name']){
        $menu[] = $val;
      }
    }
    $menu["logout"] = array(
      '#href'       => '?p=logout',
      'description' => 'Logout',
      'perms'       => 'authenticated'
    );
  }
  return $menu;
}



