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
  . " FROM `stock` WHERE status = 'AVAIL'";
  //If $code is passed append it to the sql query
  if($code != NULL){
    $sql .= " AND `code` = '$code'";
  }

  global $dbh;
  $result = $dbh->query($sql);
  $tpl->row = $result;
  $tpl->title = "List";
  $tpl->display("./template/update.php.tpl");
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
  . " SET `price` = :rate"
  . " WHERE code = :code";
  $ref = $dbh->prepare($sql);
  $ref->bindParam(':code',$code);
  $ref->bindParam(':rate',$rate);
  $ref->execute();
  display_item();
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
  . " SET `quantity` = `quantity` + :amount"
  . " WHERE code = '$code'";
  $ref = $dbh->prepare($sql);
  $ref->bindParam(':amount',$amount);
  $ref->execute();
  display_item();
}

/**
* Block items from sale.
*
*/
function block_items(){
  global $dbh;
  foreach ($_POST["checkbox_values"] as $val){
    $sql = "UPDATE `stock`"
    . " SET `status` = 'BLOCK'"
    . " WHERE `code` = :code";
    $ref = $dbh->prepare($sql);
    $ref->bindParam(':code',$val);
    $ref->execute();

  }
  display_item();
}

