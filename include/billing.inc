<?php
/**
* @file
* Used for the billing purpose.
*/

/**
* Create the previously added entries to the bill.
*/
function generate_bill(){
  $tpl   = new Savant3();
  $rows  = array();
  $price = 0;
  $item  = "";
  $sum   = 0;
  if(isset($_POST['item-1'])){
    for($i = 1; isset($_POST["item-$i"]);$i++){
      if($_POST["item-$i-total"] == ""){
        $sql = "SELECT `code`,`item_name`,`price`"
        . " FROM `stock`"
        . " WHERE `code` = :code";
        global $dbh;
        $ref = $dbh->prepare($sql);
        $ref->bindParam(':code',$_POST["item-$i-code"]);
        $ref->execute();

        $res = $ref->fetchAll();
        foreach ($res as $key => $val){
          $_POST["item-$i-item"] = $val['item_name'];
          $_POST["item-$i-price"] = $val['price'];
          $_POST["item-$i-total"] = $val['price'] * $_POST["item-$i-quantity"];
          $price = $val['price'];
          $item = $val['item_name'];

        }
      }
      else {
        $price = $_POST["item-$i-price"];
        $item  = $_POST["item-$i-item"];
      }

      $rows[] = array(
                  "code"     => $_POST["item-$i-code"],
                  "item"     => $item,
                  "quantity" => $_POST["item-$i-quantity"],
                  "price"    => $price,
                  "total"    => $_POST["item-$i-total"]
                );
      $sum = $sum + $_POST["item-$i-total"];
    }
    $tpl->rows = $rows;

  }
  $tpl->sum = $sum;
  $tpl->title = "Billing";
  $tpl->display("./template/billing.php.tpl");
}
/**
* Display the bill
*
* @params int $bill_no
*   The Bill No of the bill to be displayed.
*/
function display_bill($bill_no){
  $rows = array();
  $sql = "SELECT `bill_no`,`amount`"
  . " FROM `bill`"
  . " WHERE `bill_no` = :bill_no";
  global $tpl;
  global $dbh;
  $ref = $dbh->prepare($sql);
  $ref->bindParam(':bill_no',$bill_no);
  $ref->execute();
  $row = $ref->fetch();
  $tpl->bill_no = $bill_no;
  $tpl->total   = $row['amount'];
  $sql = "SELECT `items`.`item_code`,`items`.`quantity`,`items`.`price`"
  . ",`stock`.`item_name`"
  . " FROM `items`,`stock`"
  . " WHERE `items`.`item_code` = `stock`.`code`"
  . " AND `items`.`bill_no` = :bill_no";
  $ref = $dbh->prepare($sql);
  $ref->bindParam('bill_no',$bill_no);
  $ref->execute();
  $tpl->rows = $ref->fetchAll();
  $tpl->title = "Bill no";
  $tpl->display("./template/bill.php.tpl");
}
/**
* Generate the bill for each item.
*
*
*/
function bill(){
  $tpl  = new Savant3();
  $rows = array();
  $sum  = 0;
  $sql = "INSERT INTO `bill` (`amount`)"
  . " VALUES (0)";

  global $dbh;

  $dbh->exec($sql);
  $bill_no = $dbh->lastInsertId();
  for($i = 1; isset($_POST["item-$i"]) && $_POST["item-$i-price"] != ""; $i++){
    $sql = "UPDATE `stock`"
    . " SET quantity = quantity - " . $_POST["item-$i-quantity"]
    . " WHERE `code` = '" . $_POST["item-$i-code"] . "'";
    $dbh->exec($sql);
    $sql = "INSERT INTO `items` (`bill_no`,`item_code`,`quantity`,`price`)"
    . " VALUES (:bill_no,:item_code,:quantity,:price)";
    $ref = $dbh->prepare($sql);
    $ref->bindParam(':bill_no',$bill_no);
    $ref->bindParam(':item_code',$_POST["item-$i-code"]);
    $ref->bindParam(':quantity',$_POST["item-$i-quantity"]);
    $ref->bindParam(':price',$_POST["item-$i-price"]);
    $ref->execute();

   $sum = $sum + $_POST["item-$i-total"];
  }
  $sql = "UPDATE `bill`"
  . " SET amount = :sum"
  . " WHERE bill_no = :bill_no";

  $ref = $dbh->prepare($sql);
  $ref->bindParam(':sum',$sum);
  $ref->bindParam(':bill_no',$bill_no);
  $ref->execute();
  display_bill($bill_no);



}




