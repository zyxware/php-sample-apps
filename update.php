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
* Update the rate of the item indicated by the code
*
* @params string $code
*   The code of the item of which the amount is to be updated.
* @params int $rate
*   The rate of items to be added to the repository.
*/
function update_rate($code,$rate){
  global $dbh;
  $sql = "UPDATE `stock`"
  . " SET `price` = '$rate'"
  . " WHERE code = '$code'";

  $dbh->exec($sql);
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
  global $dbh;
  $sql = "UPDATE `stock`"
  . " SET `quantity` = `quantity` + $amount"
  . " WHERE code = '$code'";

  $dbh->exec($sql);
}



