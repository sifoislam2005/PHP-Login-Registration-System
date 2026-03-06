<?php
session_start();
$page_title = 'Forgot password Page';
require('connexion.php');
require('include/header.php');
require('include/navbar.php');

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';
function reset_password_mail( $email, $psw_forgot_token ) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sifoda2107@gmail.com';
    $mail->Password   = 'sdxtgodwjdeucijx';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('sifoda2107@gmail.com', 'DevSifo Website');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Email Verification from DevSifo';

    $email_template = "
        <h2>You Want to reset your password in DevSifo</h2>
        <h5>Click in the below given link to reset your password</h5>
        <br/><br/>
        <a href='http://localhost/auth%20php/reset-password.php?token_reset=$psw_forgot_token'> Click Here to reset </a>
    ";

    $mail->Body = $email_template;

    if($mail->send()) {
        return true;
    } else {
        return false;
    }
}

if(isset($_POST['resetbtn'])) {
    $psw_forgot_token = md5(rand() . time());
    $email_reset = $_POST['email'];
    $reset_search = "SELECT * FROM informations WHERE email = ? LIMIT 1";
    $stmt_reset = $con->prepare($reset_search);
    $stmt_reset->bind_param('s', $email_reset);
    $stmt_reset->execute();
    $stmt_reset_search=$stmt_reset->get_result();

    if ($stmt_reset_search->num_rows > 0) {
        $update_token_reset = "UPDATE informations SET psw_verify_token = ? WHERE email = ? LIMIT 1 ";
        $stmt_update_token = $con->prepare($update_token_reset);
        $stmt_update_token->bind_param('ss', $psw_forgot_token, $email_reset);
        $stmt_update_token_query = $stmt_update_token->execute();
        if ($stmt_update_token_query) {
            reset_password_mail($email_reset, $psw_forgot_token);
            $_SESSION['status'] = "An email has been sent to your email address. Please check your inbox to reset your password.";
            header('location:forgot.php');
            exit(0);
        }
        else {
            $_SESSION['status'] = "Something went wrong. Please try again.";
            header('location:forgot.php');
            exit(0);
        }
    }
    else{
        $_SESSION['status'] = "The email address you entered was not found.";
        header('location:forgot.php');
        exit(0);

    }
}
?>
    <form action="forgot.php" method="post">
        <div class="container-register">
            <h1>Reset password</h1>
            <p>Please write your email to reset password </p>
            <?php if (isset($_SESSION['status'])) { ?>
                <p class="register-warning"><?php echo $_SESSION['status']; unset($_SESSION['status']);
                    ?></p>
            <?php } ?>
            <hr>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>
            <hr>
            <button type="submit" class="resetbtn" name="resetbtn">Reset password</button>
        </div>
    </form>

<?php require('include/footer.php')?>