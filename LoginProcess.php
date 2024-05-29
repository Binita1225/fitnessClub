<?php 

session_start();
require 'includes/validate.php';
require 'includes/url.php';
require 'includes/database.php';

$conn=getDB();

if (isset($_POST['email'])) {
    $user= getUser($conn, $_POST['email']);
    if ($user) {
        $fullName=$user['FullName'];
        $email=$user['Username'];
        $password=$user['Password'];
        $customerId=$user['Id'];
    }
    else{
        die("User not found");
    }
}
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $formEmail=$_POST['email'];
    $formPass=$_POST['password'];
    if ($formEmail=='' || $formPass=='') {
        echo 'One or more fields are empty';
    }
    elseif ($formPass==$password) {
        session_start();

        $_SESSION['loggedIn'] = true;
        $_SESSION ['fullname']=$fullName;
        $_SESSION['username'] = $email;
        $_SESSION['customerId']=$customerId;
        // echo '<script>window.parent.redirectToHome();</script>';
        header("Location:index.php");
        exit;
    }else{
        echo 'Invalid credentials';
    }
}

$conn->close();

?>