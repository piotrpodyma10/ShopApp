<?php
    checkPost();
    include_once 'dbConnection.inc.php';
    $login = mysqli_real_escape_string($dbConnection, $_POST['login']);
    $password = mysqli_real_escape_string($dbConnection, $_POST['password']);
    $repeatPassword = mysqli_real_escape_string($dbConnection, $_POST['repeatPassword']);
    $email = mysqli_real_escape_string($dbConnection, $_POST['email']);
    
    $isLoginValid = isLoginValid($login);
    $isLoginAvailable = isLoginAvailable($login);
    $isPassworValid = isPassworValid($password, $repeatPassword);
    $isEmailValid = isEmailValid($email);

    if(!$isLoginValid || !$isPassworValid || !$isEmailValid){
        $header = "Location: ../signUp.php?error=";
        if(!$isLoginValid) $header = $header.'loginInvalid|';
        if(!$isPassworValid) $header = $header.'passwordInvalid|';
        if(!$isEmailValid) $header = $header.'emailInvalid|';
        if(!$isLoginAvailable) $header = $header.'loginTaken';

        header($header);
        exit();
    }

    $userId = createUser($email, $dbConnection);
    createCart($userId, $dbConnection);
    createLogin($login, $password, $userId, $dbConnection);

    function checkPost(){
        if(!isset($_POST['submit'])){
            header("Location: ../index.php?signUp=success");
            exit();
        }
    }

    function isLoginValid($login){
        return preg_match("/^[a-zA-Z]*$/", $login);
    }

    function isLoginAvailable($login){
        $sql = "SELECT Id FROM Logins WHERE Login='$login'";
        $result = mysqli_query($dbConnection, $sql);
        return (mysqli_num_rows($result) == 0);
    }

    function isPassworValid($password, $repeatPassword){
        return ($password == $repeatPassword);
    }

    function isEmailValid($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function createUser($email, $dbConnection){
        $sql = "INSERT INTO Users 
                    (Email) 
                VALUES
                    ('$email');";
        $isSuccess = mysqli_query($dbConnection, $sql);
        if($isSuccess){
            return mysqli_insert_id($dbConnection);
        } else {
            header("Location: ../signUp.php?signup=failed");
            exit();
        }
    }

    function createCart($userId, $dbConnection){
        $sql = "INSERT INTO Carts 
                    (UserId) 
                VALUES
                    ('$userId');";
        $isSuccess = mysqli_query($dbConnection, $sql);
        if($isSuccess){
            return mysqli_insert_id($dbConnection);
        } else {
            header("Location: ../signUp.php?signup=failed");
            exit();
        }
    }

    function createLogin($login, $password, $userId, $dbConnection){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Logins 
                    (Login, Password, UserId, Role) 
                VALUES
                    ('$login', '$hashedPassword', '$userId', 'user');";
        $isSuccess = mysqli_query($dbConnection, $sql);
        if($isSuccess){
            header("Location: ../index.php?signUp=success");
        } else {
            header("Location: ../signUp.php?signup=failed");
        }
        exit();
    }
?>
