<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include_once 'dbConnection.inc.php';

    $orders = [];
    $orders = getOrders($dbConnection); 

    if(isset($_GET['action'])){
        handleAction($dbConnection);
    }

    function handleAction($dbConnection){
        if($_GET['action'] == 'CANCEL'){
            $orderId = $_GET['orderId'];
            $sql = "UPDATE Orders SET Status='CANCELLED' WHERE id='$orderId'";
            mysqli_query($dbConnection, $sql);
            header("Location: ../orders.php?result=cancelSuccess");
            exit();            
        }
    }

    function getOrders($dbConnection){
        $orders = [];
        $userId = $_SESSION["userId"];

        $sql = "SELECT Id, Total, CreatedDate, Status
                FROM Orders 
                WHERE UserId = '$userId'
                ORDER BY CreatedDate DESC";
        $result = mysqli_query($dbConnection, $sql);
        while($order = mysqli_fetch_assoc($result)){
            array_push($orders, $order);
        }

        return $orders;
    }