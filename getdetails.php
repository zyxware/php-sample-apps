<?php



require_once './config/config.php';
$dbh = new PDO("mysql:host=localhost;dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
$sql = "SELECT `item_name`,`price`"
. " FROM `stock`"
. " WHERE `code` = :stock_code";
$ref = $dbh->prepare($sql);
$ref->bindParam(':stock_code',$_REQUEST['code']);
$ref->execute();
$row = $ref->fetch();
$return['item'] = $row['item_name'];
$return['price'] = $row['price'];
$return = json_encode($return);
echo $return;
