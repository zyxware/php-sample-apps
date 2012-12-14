<?php
/**
* @file
* Process request to and new item to stock inventory
*
* This file process requests to add new items to the repository.
*/
/**
* Function to display the form
*/
function display_form(){
  $tpl = new Savant3();

  //Generate form fields
  $form_fields = array(
    array(
      "type"        => "text",
      "description" => "Item Code",
      "name"        => "item_code"
    ),
    array(
      "type"        => "text",
      "description" => "Item Name",
      "name"        => "item_name"
    ),
    array(
      "type"        => "text",
      "description" => "Item Price",
      "name"        => "item_price"
    ),
    array(
      "type"        => "text",
      "description" => "Item Quantity",
      "name"        => "item_quantity"
    )
  );

  $title = "Add Item";
  $tpl->title = $title;
  $tpl->form_fields = $form_fields;
  $tpl->display("./template/additem.php.tpl");
}

/**
* Insert Item to database
*
* Function inserts values to the database.
*
* @params string $code
*   code of the item being inserted.
* @params string $name
*   Name of the item being inserted.
* @params decimal $price
*   Price of the item being inserted.
* @params int $quantity
*   Quantity of the item currently in stock.
*/
function insert_database($code,$name,$price,$quantity){
  $sql = "INSERT INTO stock (code,item_name,price,quantity)"
  . " VALUES (:code,:name,:price,:quantity)";
  global $dbh;
  $ref = $dbh->prepare($sql);
  $ref->bindParam(':code',$code);
  $ref->bindParam(':name',$name);
  $ref->bindParam(':price',$price);
  $ref->bindParam(':quantity',$quantity);


  $ref->execute();
}

/**
* Check if Item code already exists.
*
* @params string $code
*   The code to be checked in the database.
*
* @return boolean
*   Returns true if the value is found, else returns false.
*/
function check_code($code){
  $sql = "SELECT COUNT(*)"
  . " FROM `stock`"
  . " WHERE `code` = :code";
  global $dbh;

  $ref = $dbh->prepare($sql);
  $ref->bindParam(':code',$code);
  $ref->execute();
  if($ref->fetchColumn() == 0){
    return false;
  }
  else {
    return true;
  }
}

/**
* Process the form given as input.
*/
function process_form(){
  $error_msg = array();
  $error = false;
  $title  = "";
  $tpl = new Savant3();

  $check_item_code = isset($_POST['item_code']) && $_POST['item_code'] != "" && !check_code($_POST['item_code']);
  $check_item_price = isset($_POST['item_price']) && $_POST['item_price'] != "";
  $check_item_quantity = isset($_POST['item_quantity']) && $_POST['item_quantity'] != "";
  $check_item_name = isset($_POST['item_name']) && $_POST['item_name'] != "";

  $error = $check_item_code && $check_item_price && $check_item_quantity && $check_item_name;
  if(!$error){
    if(!$check_item_code){
      $error_msg[] = "Please enter a unique item code";

    }
    if(!$check_item_price){
      $error_msg[] = "Please enter a valid item price";

    }
    if(!$check_item_quantity){
      $error_msg[] = "Please enter a valid item quantity";

    }
    if(!$check_item_name){
      $error_msg[] = "Please enter a valid item name";
    }
    $tpl->error_msg = $error_msg;
    $title = "Error";
  }
  else{
    $display_item = array(
      array(
        "description" => "Item Code",
        "value"       => $_POST['item_code']
      ),
      array(
        "description" => "Item Name",
        "value"       => $_POST['item_name']
      ),
      array(
        "description" => "Item Price",
        "value"       => $_POST['item_price']
      ),
      array(
        "description" => "Item Quantity",
        "value"       => $_POST['item_quantity']
      )
    );
    insert_database($_POST['item_code'],$_POST['item_name'],$_POST['item_price'],$_POST['item_quantity']);
    $tpl->display_item = $display_item;
    $title = "Item details";
  }
  $tpl->title = $title;
  $tpl->display('./template/additem.php.tpl');

}

//require_once ("Savant3.php");


