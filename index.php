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
  $tpl->display('./template/index.php.tpl');
}

session_start();

require_once 'Savant3.php';
require_once './config/config.php';
require_once './include/auth.inc';
require_once './include/authenticate.inc';
require_once './include/menu.inc';
require_once("./include/billing.inc");


$dbh = new PDO("mysql:host=localhost;dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
$tpl = new Savant3();
// Set $page. If not, set it.
$page = "billing";
if(isset($_GET['p'])){
  $page = $_GET['p'];
}

if(!isset($_SESSION['user'])){
  require_once("./include/authenticate.inc");
  display_login_form();
}
else if($page == 'logout'){
  require_once("./include/authenticate.inc");
  logout();
}
else if($page == "addItem" && check_perms("items")){
  require_once("./include/additem.inc");
  if(isset($_POST['submit'])){
  process_form();
  }
  else {
    display_form();
  }
}
else if($page == "update" && check_perms("items")){

  require_once("./include/update.inc");
  if(isset($_POST['submit'])){
  update_item($_POST['code'],$_POST['amount']);
  }
  else if(isset($_POST['rateUpdate'])){
    update_rate($_POST['code'],$_POST['rate']);
  }
  else if(isset($_GET['search'])){
   display_item($_GET['search']);
  }
  else if(isset($_POST['block'])){
    block_items();
  }
  else {
  display_item();
  }
}
  else if($page == 'home'){
  home_page();
}
else {




  if(isset($_POST['Bill'])){
    bill();
  }
  else if(isset($_GET['view'])){
    if($_GET['view'] != NULL){
      display_bill($_GET['view']);
    }
    else {
      global $tpl;
      $tpl->title = "Bill Details";
      $tpl->display("./template/billno.php.tpl");
    }
  }
  else
  {
    generate_bill();
  }
}

