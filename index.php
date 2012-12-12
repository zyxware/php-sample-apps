<?php
/**
* @file
* Script to load the home page
*
* This load the option on the home page and shows the list of options available
* on the system. This also loads the corresponding file according to the
* request
*/
/**
* Generate home page
*/
function home_page(){
  $tpl = new Savant3();
  $menuoptions = array(
    array(
      '#href'       => '?p=addItem',
      'description' => 'Add new item',
      'hover'       => 'Click to add a new item'
    ),
    array(
      '#href'       => '?p=billing',
      'description' => 'Billing',
      'hover'       => 'Click to bill a new customer'
    ),
    array(
      '#href'       => '?p=update',
      'description' => 'List inventory',
      'hover'       => 'Click to list the inventory and update stock'
    ),
    array(
      '#href'       => '?p=billing&view',
      'description' => 'View Bill',
      'hover'       => 'Click to view the bill details'
    )
    );
  $name = 'Welcome';

  $tpl->title = $name;
  $tpl->menuoptions = $menuoptions;
  $tpl->display('index.php.tpl');
}
require_once 'Savant3.php';
require_once './config.php';

$dbh = new PDO("mysql:host=localhost;dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
$tpl = new Savant3();
// Check if $_GET['p'] is set. If not, set it.

if(!isset($_GET['p'])){
  $_GET['p'] = "billing";
}
if($_GET['p'] == "addItem"){
  require_once("./additem.php");
}
else if($_GET['p'] == "update"){
  require_once("./update.php");
}
else if($_GET['p'] == 'billing'){
  require_once("./billing.php");
}
else if($_GET['p'] == 'home'){
  home_page();
}
else {
  require_once("./billing.php");
}

