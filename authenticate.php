<?php
/**
* @file
* Authentication scripts.
*/

/**
* Check if username, password pair exists.
*
* @params string $username
*   The username of the person
* @params string $password
*   The password of the person
*
* @return bool
*   Returns true if the username password pair match. False otherwise.
*/
function check_password($username,$password){
  $sql = "SELECT `role`"
  . " FROM `users`"
  . " WHERE `username` = '$username'"
  . " AND `password` = '" . sha1($password) . "'";
  global $dbh;
  $res = $dbh->query($sql);

  if($row = $res->fetch()){
    $_SESSION['user'] = $username;
    $_SESSION['role'] = $row['role'];
    return true;


  }
  return false;
}
/**
* Function to display the login form and authentication details.
*
*/
function display_login_form(){
  global $tpl;

  if(isset($_POST['username']) && isset($_POST['password'])){
    if(check_password($_POST['username'],$_POST['password'])){
      $tpl->msg = "Logged in sucessfully. Refresh page to go home";
    }
    else{
      $tpl->msg = "Username Password combination incorrect";
      $tpl->form = true;
    }
  }
  else{
    $tpl->form = true;
  }
  $tpl->display("login_form.php.tpl");
}

function logout(){
  unset($_SESSION);
  session_destroy();
  global $tpl;
  $tpl->msg = "Logged out sucessfully";
  $tpl->display("login_form.php.tpl");
}

