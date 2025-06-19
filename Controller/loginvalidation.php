<?php

    if(isset($_POST['submit'])){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if($email == "" || $password == ""){
            echo "null username/password!";
        }else if($email == $password){
            echo "valid user!";
        }else{
            echo "invalid user!";
        }
    }else{
        echo "Invalid request! Please submit form!";
    }
?>