<?php
require_once '../Model/users.php';
// require_once '../Controller/signUpvalidation.php';  

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['submit'])) {
    $fname  = trim($_POST['firstName']);
    $lname  = trim($_POST['lastName']);
    $email  = trim($_POST['email']);
    $pass   = trim($_POST['password']);
    $cpass  = trim($_POST['confirmPassword']);

    $user = [
        'firstname' => $fname,
        'lastname'  => $lname,
        'email'     => $email,
        'password'  => $pass,
    ];

    $result = register($user);
    $uname = $fname . " " . $lname;
    if ($result === "email_exists") {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../View/signUp.php?error=email_exists');
        exit();
    } elseif ($result === "password_mismatch") {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../View/signUp.php?error=password_mismatch');
        exit();
    } elseif ($result === "empty_fields") {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../View/signUp.php?error=empty_fields');
        exit();
    } elseif ($result === "invalid_email") {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../View/signUp.php?error=invalid_email');
        exit();
    } elseif ($result === "invalid_password") {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../View/signUp.php?error=invalid_password');
        exit();
    }
    if ($result === "success") {
        $_SESSION['status'] = true;
        $_SESSION['username'] = $uname;
        header("Location: ../View/login.php");
        exit();
    }

    $_SESSION['form_data'] = $_POST;
    header('Location: ../View/signUp.php?error=valid');
    exit();
}

header('Location: ../View/signUp.php?error=invalid');
exit();

?>