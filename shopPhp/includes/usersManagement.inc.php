<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include_once 'dbConnection.inc.php';

    $users = [];
    $users = getUsers($dbConnection); 

    if(isset($_GET['action'])){
        handleAction($dbConnection);
    }

    function handleAction($dbConnection){
        if($_GET['action'] == 'DEMOTE'){
            $userId = $_GET['userId'];
            $role = $_GET['currentRole'];
            
            switch($role){
                case 'admin':
                    $role = 'salesman';
                    break;
                case 'salesman':
                    $role = 'user';
                    break;
                default:
                    $role = $_GET['currentRole'];
            }

            $sql = "UPDATE Logins SET Role='$role' WHERE id='$userId'";
            mysqli_query($dbConnection, $sql);
            header("Location: ../usersManagement.php?result=demotionSuccess");
            exit();             
        }

        if($_GET['action'] == 'PROMOTE'){
            $userId = $_GET['userId'];
            $role = $_GET['currentRole'];

            switch($role){
                case 'salesman':
                    $role = 'admin';
                    break;
                case 'user':
                    $role = 'salesman';
                    break;
                default:
                    $role = $_GET['currentRole'];
            }

            $sql = "UPDATE Logins SET Role='$role' WHERE id='$userId'";
            mysqli_query($dbConnection, $sql);
            header("Location: ../usersManagement.php?result=promotionSuccess");
            exit();            
        }
    }

    function getUsers($dbConnection){
        $users = [];
        $userId = $_SESSION["userId"];

        $sql = "SELECT Id, Role, Login
                FROM Logins";
        $result = mysqli_query($dbConnection, $sql);
        while($user = mysqli_fetch_assoc($result)){
            array_push($users, $user);
        }

        return $users;
    }
?>