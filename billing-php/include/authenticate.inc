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
function check_password($username, $password) {
  $sql = "SELECT `role`"
      . " FROM `users`"
      . " WHERE `username` = :username"
      . " AND `password` = :password";
  global $dbh;
  $res = $dbh->prepare($sql);
  $res->bindParam(':username', $username);
  $password = sha1($password);
  $res->bindParam(':password', $password);
  $res->execute();
  if ($row = $res->fetch()) {
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
function display_login_form() {
  global $tpl;

  if (isset($_POST['username']) && isset($_POST['password'])) {
    if (check_password($_POST['username'], $_POST['password'])) {
      $tpl->msg = "Logged in sucessfully. Refresh page to go home";
      generate_bill();
      return;
    }
    else {
      $tpl->msg = "Username Password combination incorrect";
      $tpl->form = true;
    }
  }
  else {
    $tpl->form = true;
  }
  $tpl->content = $tpl->fetch("./template/login_form.php.tpl");
  $tpl->display("./template/index.php.tpl");
}

/**
 * Function to handle the logout from sessions.
 *
 */
function logout() {
  unset($_SESSION);
  session_destroy();
  global $tpl;
  $tpl->msg = "Logged out sucessfully";
  display_login_form();
}

/**
 * Function to check Role
 *
 * Function te check if the authenticated user role has permission to access
 * A particular sub module.
 *
 * @params string $perm
 *   The perm to be checked against the authenticated user.
 *
 * @return boolean
 *   Returns true if the user is allowed to access a particular function. False
 *   otherwise.
 *
 */
function check_perms($perm) {
  global $auth;
  return in_array($perm, $auth[$_SESSION['role']]);
}
