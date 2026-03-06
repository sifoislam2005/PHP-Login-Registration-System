<?php 
session_start();
$page_title = 'Registration Form';
require('include/header.php');
require('include/navbar.php')
?>

<form action="code.php" method="post">
  <div class="container-register">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <?php
  if (isset($_SESSION['status'])) { ?>
  <p class="register-warning"><?php echo $_SESSION['status']; unset($_SESSION['status']); ?></p>
<?php } ?>

    <hr>

    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" id="name" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="email"><b>Phone Number</b></label>
    <input type="text" placeholder="Enter Phone" name="phone" id="phone" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
    <hr>


    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" name="register_btn" class="registerbtn">Register</button>
      <div class="container signin">
          <h2>Already have an account? <a href="#">Sign in</a>.</h2>
      </div>
  </div>



</form>

<?php require('include/footer.php')?>

