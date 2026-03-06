<?php
session_start();
include ('connexion.php');
include ('include/header.php');
include ('include/navbar.php');

if (isset($_GET['token_reset'])) {
    $token_reset = $_GET['token_reset'];
    $token_reset_search = 'select * from informations where psw_verify_token= ? LIMIT 1';
    $stmt_token_reset_search = $con -> prepare($token_reset_search);
    $stmt_token_reset_search->bind_param('s', $token_reset);
    $stmt_token_reset_search->execute();
    $stmt_token_reset_search_result = $stmt_token_reset_search -> get_result();
    if ($stmt_token_reset_search_result->num_rows > 0) {
        $row_token_reset = $stmt_token_reset_search_result -> fetch_assoc();?>
<form action="reset-password.php" method="post">

    <div class="container-register">
        <h1>Reset Your Password</h1>
        <p><b>hello <b><?php echo $row_token_reset['name']?> <b> Please fill in this form to reset your password</p>
        <hr>
        <?php if (isset($_SESSION['status'])) { ?>
            <p class="register-warning"><?php echo $_SESSION['status']; unset($_SESSION['status']);
                ?></p>
        <?php } ?>
        <input type="hidden" name="token_from_url" value="<?php echo $token_reset; ?>">
        <label for="new_pass"><b>New password</b></label>
        <input type="password" placeholder="Enter password" name="new_pass" id="new_pass" required>

        <label for="pass_conf"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="pass_conf" id="pass_conf" required>

        <hr>
        <button type="submit" class="registerbtn" name="resetbtn_confirm">Reset password</button>
    </div>


</form>
   <?php } ?>


<?php
} else {
    echo "<h4>Invalid or Expired Token!</h4>";

}

if (isset($_POST['resetbtn_confirm'])) {
    $token_hidden = $_POST['token_from_url'];
    $new_pass = $_POST['new_pass'];
    $pass_conf = $_POST['pass_conf'];
    if ($new_pass == $pass_conf) {
        $update_pass_query = "UPDATE informations SET pass = ? ,psw_verify_token = NULL WHERE psw_verify_token = ? LIMIT 1";
        $stmt_update_pass_query = $con -> prepare($update_pass_query);
        $stmt_update_pass_query->bind_param('ss', $new_pass, $token_hidden);
        $stmt_update_pass_query->execute();
        if ($stmt_update_pass_query) {
            $_SESSION['status'] = "Your password has been reset, you may now log in";
            header('location:login.php');
            exit(0);
        }
        else {
            $_SESSION['status'] = "Password cant be changed, try again later";
            header('location:forgot.php?token_reset='.$token_hidden);
            exit(0);
        }
    }
    else {
        $_SESSION['status'] = "Password did not match";
        header('location: reset-password.php?token_reset='.$token_hidden);
        exit(0);
    }
}

include ('include/footer.php');
?>