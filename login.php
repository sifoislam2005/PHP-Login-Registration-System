<?php 
session_start();
$page_title = 'Login Page';
require('include/header.php');
require('include/navbar.php')
?>


<form action="code.php" method="post">
  <div class="container-register">
    <h1>Login</h1>
    <p>Please fill in this form to Login</p>
    <hr>
     <?php if (isset($_SESSION['status'])) { ?>
     <p class="register-warning"><?php echo $_SESSION['status']; unset($_SESSION['status']); 
?></p>
    <?php } ?>

  

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
      <h2>You dont have an account yet ?</h2>
      <a href="register.php">Register here</a>

    <hr>
    <button type="submit" class="registerbtn" name="loginbtn">Login</button>
      <a href="forgot.php">Forgot your password?</a>
  </div>


</form>

<?php require('include/footer.php')?>