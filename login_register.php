<?php

session_start();
require_once 'login.php';

if(isset($_POST['register'])) {
  $email = $_POST['email'];
  $name = $_POST['name'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $checkEmail = $conn->query("SELECT * FROM users WHERE email='$email'");
  if($checkEmail->num_rows > 0) {
    $_SESSION['register_error'] = "Email is already registered!";
    $_SESSION['active_form'] = 'register';
  } else {
    $conn->query("INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$password')");
  }

  header("Location: register.php");
  exit();
}

if (isset($_POST['login'])) { 
  $email = $_POST['email'];
  $password = $_POST['password'];

  $result = $conn->query("SELECT * FROM users WHERE email='$email'");
  if($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if(password_verify($password, $user['password'])) {
      $_SESSION['name'] = $user['name'];
      $_SESSION['email'] = $user['email'];

      //Remember me functionality
      if(!empty($_POST['remember'])){
        setcookie("user_email",$user['email'], time() + (86400 * 30), "/"); 
      }

      header("Location: index.php");

      $_SESSION['login_error'] = 'Incorrect email or password!';
      $_SESSION['active_form'] = 'login';

    }
 }
}
    $_SESSION['login_error'] = 'Incorrect email or password!';
    $_SESSION['active_form'] = 'login';
    header("Location: register.php");
    exit();

?>