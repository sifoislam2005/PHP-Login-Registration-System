<?php 
session_start();
include ('connexion.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $search_token = "SELECT * FROM informations WHERE verify_token='$token' LIMIT 1";
    $query_token = mysqli_query($con, $search_token);

    if (mysqli_num_rows($query_token) > 0) {
        $row = mysqli_fetch_array($query_token);
        if ($row['verify_status'] == "0") {
            $clicked_token = $row['verify_token'];
            $modify_status = "UPDATE informations SET verify_status = '1' where verify_token = '$clicked_token' LIMIT 1";
            $query_modify_status = mysqli_query($con , $modify_status);
            if($query_modify_status) {
                $_SESSION['status'] = 'Account Verified Successfully! You can login now.';
                header('location:login.php');

                exit(0);
            }
            else { 
                $_SESSION['status'] = 'Verification Failed!';
                header('location:register.php');
                exit(0);
            }
               
        }
        else {
            $_SESSION['status'] = 'Email Already Verified. Please Login.';
            header('location:login.php');
            exit(0);
        }
    }
    else {
        $_SESSION['status'] = 'Your email cant be verified, your token isnt valide !';
        header('location:register.php');
        exit(0);
    }
}
else {
    
$_SESSION['status'] = 'You dont have access this page yet !';
header('location: register.php;');
exit(0);

}


?>
