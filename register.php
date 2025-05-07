<?php
session_start();
$errors = [
  'login' => $_SESSION['login_error'] ?? '',
  'register' => $_SESSION['register_error'] ?? ''
  ];
  $activeForm = $_SESSION['active_form'] ?? 'login';

  session_unset();

  function showError($error){
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
  }
  function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
 
    <link rel="stylesheet" href="styles/register.css"> 

</head>
<body>

  <!--Login Form-->
    <div class ="form-container">
      <div class ="form-col">
        <div class ="btn-box">
          <button class ="btn btn-1" name = "login" id="login">Sign In</button>
          <button class ="btn btn-2" name = "register" id="register">Sign Up</button>
        </div>
        <?= showError($errors['login']); ?>

        <form class="form-box login-form <?= isActiveForm('login',$activeForm); ?>" id="login-form"
          action="login_register.php" method="POST">
          <div class="form-title">
            <span>Sign In</span>
          </div>
          <div class="form-inputs">
            <div class="input-box">
              <input type="text"class="inputs input-field " name = "name" placeholder="Username" required>
              <i class="bi bi-person"></i>
          </div>
          <div class="input-box">
              <input type="password"class="inputs input-field " name = "password" placeholder="Password" required>
              <i class="bi bi-lock"></i>
          </div>
          <div class="forgot-password">
             <a href="#">Forgot Password?</a>
          </div>
          <div class="input-box">
            <button class="inputs submit-btn" name="login">
              <span>Sign In</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>
        </form>


        <!--Register Form-->
        <form class="form-box register-form <?= isActiveForm('register',$activeForm); ?>" id="register-form" action="login_register.php" method="POST">
          <div class="form-title">
            <span>Sign Up</span>
          </div>
          <?= showError($errors['register']); ?>

          <div class="form-inputs">
            <div class="input-box">
              <input type="text"class="inputs input-field " name = "email" placeholder="E-mail" required>
              <i class="bi bi-envelope"></i>
          </div>
          <div class="form-inputs">
            <div class="input-box">
              <input type="text"class="inputs input-field " name = "name" placeholder="Username" required>
              <i class="bi bi-person"></i>
          </div>
          <div class="input-box">
              <input type="password"class="inputs input-field " name = "password" placeholder="Password" required>
              <i class="bi bi-lock"></i>
          </div>
          <div class="remember-me">
             <input type="checkbox" id="remember-me-check">
              <label for="remember-me-check">Remember me</label>
          </div>
          <div class="input-box">
            <button class="inputs submit-btn" name="register">
              <span>Sign Up</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>
        </form>






    </div> 
</div>
<script src="jsFiles/register.js" defer></script>
</body>
</html>