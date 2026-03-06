<?php 
include ('connexion.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendemail_verify($name, $email, $verify_token) {
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
        <h2>You have Registered with DevSifo</h2>
        <h5>Verify your email address to Login with the below given link</h5>
        <br/><br/>
        <a href='http://localhost/auth%20php/verify-email.php?token=$verify_token'> Click Here </a>
    ";

    $mail->Body = $email_template;

    if($mail->send()) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['register_btn']))
{
    $verify_token = md5(rand());
    $name = $_POST['name'];
    $phone =$_POST['phone'];
    $email = $_POST['email'];
    $password =$_POST['psw'];
    $password_repeat = $_POST['psw-repeat'];

    $check_email_query = "SELECT email from informations where email = ? limit 1";
    $stmt = $con->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    

    if ($result->num_rows > 0 ) {
        $_SESSION['status'] = 'Email address Already exists';
        header("location: register.php");
        exit(0);
    }
    else {
        if ($password == $password_repeat) {
            $add_infos = "INSERT INTO informations(name,email,phone,pass,psw_repeat,verify_token) VALUES(?,?,?,?,?,?)";
            $stmt_instert = $con->prepare($add_infos);
            $stmt_instert->bind_param("ssssss", $name, $email, $phone, $password, $password_repeat, $verify_token);
            $insert_query = $stmt_instert->execute();


        if ($insert_query) {
            sendemail_verify($name,$email,$verify_token);
            $_SESSION['status'] = "Registration Seccessful ! Please verify your Email Address";
            header("location: register.php");
            exit(0);

        }
        else {
            $_SESSION['status'] = "Registration Failed ❌, Try again !";
            header("location: register.php");
            exit(0);
        }
        }
        else {
            $_SESSION['status'] = 'Password and Password confirm must be matched !‼️';
            header("location: register.php");
            exit(0);
        }
        
        
    }
}


if (isset($_POST['loginbtn'])) {
    $email_login = $_POST['email'];
    $password_login =  $_POST['psw'];


    $login_db_search = "SELECT * FROM informations WHERE email=? AND pass=? LIMIT 1";
    $stmt_login = $con->prepare( $login_db_search);
    $stmt_login->bind_param('ss',$email_login, $password_login);
    $stmt_login->execute();
    $result_login_search = $stmt_login->get_result();
    
    if(mysqli_num_rows($result_login_search) > 0) {
        
        $ligne = mysqli_fetch_array($result_login_search);

        if($ligne['verify_status'] == '1') {
            $_SESSION['status'] = 'Login Success!';
            header("Location: dashboard.php");
            exit(0);
        }
        else {
            $_SESSION['status'] = 'Please validate your email before login!';
            header("Location: login.php");
            exit(0);
        }
    }
    else {
        $_SESSION['status'] = "Email or Password wrong, try again!";
        header("Location: login.php");
        exit(0);
    }
}

?>

