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
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck < 1){
        header("Location: ../index.php?login=invalidData");
        exit();
    }else{
        if($row = mysqli_fetch_assoc($result)){
            $isPasswordVerified = password_verify($password, $row['Password']);
            if($isPasswordVerified){
                $_SESSION['login'] = $row['Login'];
                $_SESSION['userId'] = $row['UserId'];
                header("Location: ../index.php?login=success");
                exit();
            }else{
                header("Location: ../index.php?login=invalidData");
                exit();
            }
        }
    }
}
?> 