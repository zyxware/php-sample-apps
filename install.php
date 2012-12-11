<?php
/**
* @file
* Install script
*
* This is the install script file. Used to install the to create the database.
*/
require_once("./config.php");

try{
  $dbh = new PDO("mysql:host=localhost;dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
  echo "Connected";
  $sql = "CREATE TABLE IF NOT EXISTS `stock` ("
  . " `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,"
  . " `code` VARCHAR(5) DEFAULT NULL,"
  . " `item_name` VARCHAR(50) DEFAULT NULL,"
  . " `quantity` INT DEFAULT NULL,"
  . " `price` DECIMAL(10,2) DEFAULT NULL"
  . " )";
  $dbh->exec($sql);

  $sql = "CREATE TABLE IF NOT EXISTS `bill` ("
  . " `bill_no` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,"
  . " `amount` DECIMAL(10,2) DEFAULT NULL,"
  . " `bill_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
  . ")";
  $dbh->exec($sql);


  $sql = "CREATE TABLE IF NOT EXISTS `items`("
  . "`bill_no` INT REFERENCES `bill` (`bill_no`),"
  . "`item_id` INT REFERENCES `stock` (`id`),"
  . "`quantity` INT DEFAULT 0,"
  . "`price` DECIMAL(10,2) DEFAULT NULL"
  . ")";
  $dbh->exec($sql);


}
catch(Exception $e){
  echo "Failed to connect $DB_NAME";
}

