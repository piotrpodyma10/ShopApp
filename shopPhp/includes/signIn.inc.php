<?php

session_start();

checkPost();
include_once 'dbConnection.inc.php';
$login = mysqli_real_escape_string($dbConnection, $_POST['login']);
$password = mysqli_real_escape_string($dbConnection, $_POST['password']);
checkLogin($login);
checkPassword($password);
signIn($login, $password, $dbConnection);

function checkPost(){
    if(!isset($_POST['submit'])){
        header("Location: ../index.php?login=error");
        exit();
    }
}

function checkLogin($login){
}

function checkPassword($password){
}

function signIn($login, $password, $dbConnection){
    $sql = "SELECT * FROM Logins WHERE Login='$login'";
    $result = mysqli_query($dbConnection, $sql);
    
    if(mysqli_num_rows($result) > 0){
        if($row = mysqli_fetch_assoc($result)){
            $isPasswordVerified = password_verify($password, $row["Password"]);
            if($isPasswordVerified){
                $_SESSION["login"] = $row["Login"];
                $_SESSION["userId"] = $row["UserId"];
                $_SESSION["role"] = $row["Role"];
                $_SESSION["cartId"] = getCartId($dbConnection);
                header("Location: ../index.php?login=success");
                //header("Location: ../signUp.php");
                exit();
            }else{
                header("Location: ../index.php?login=invalidData");
                exit();
            }
        }
    }else{
        header("Location: ../index.php?login=invalidData");
        exit();
    }
}

function getCartId($dbConnection){
    $userId = $_SESSION["userId"];
    $sql = "SELECT Id FROM Carts WHERE UserId = '$userId'";
    $result = mysqli_query($dbConnection, $sql);
    return mysqli_fetch_assoc($result)["Id"];  
}

?> 