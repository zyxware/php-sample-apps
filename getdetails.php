<?php



require_once './config.php';
$dbh = new PDO("mysql:host=localhost;dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
$sql = "SELECT `item_name`,`price`"
. " FROM `stock`"
. " WHERE `code` = '" . $_REQUEST['code'] . "'";
$ref = $dbh->query($sql);
$row = $ref->fetch();
$return['item'] = $row['item_name'];
$return['price'] = $row['price'];
$return = json_encode($return);
echo $return;
