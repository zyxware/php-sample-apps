<?php
/**
* @file
* To update the inventory details and view stocks.
*/
/**
* List the items in the inventory.
*
* @params string $code
*   (optional) The code whose details are to be displayed. Defaults to false.
*/
function display_item($code = NULL){
  $tpl = new Savant3();
  $sql = "SELECT `id`,`code`,`item_name`,`quantity`,`price`"
  . " FROM `stock`";
  //If $code is passed append it to the sql query
  if($code != NULL){
    $sql .= " WHERE `code` = '$code'";
  }
  global $dbh;
  $result = $dbh->query($sql);
  $tpl->row = $result;
  $tpl->title = "List";
  $tpl->display("update.php.tpl");
}

/**
* Update the amount of the item indicated by the code
*
* @params string $code
*   The code of the item of which the amount is to be updated.
* @params int $amount
*   The amount of items to be added to the repository.
*/
function update_item($code,$amount){
  $sql = "SELECT `quantity`,`code`"
  . " FROM `stock`"
  . " WHERE `code` = '$code'";
  global $dbh;
  $result = $dbh->query($sql);
  foreach ($result as $key => $row) {
    $value = $amount + $row[0];
    $sql = "UPDATE `stock`"
    . " SET `quantity` = '$value'"
    . " WHERE code = '$code'";
  }
  $dbh->exec($sql);
}

if(isset($_POST['submit'])){
  update_item($_POST['code'],$_POST['amount']);
}
display_item();

