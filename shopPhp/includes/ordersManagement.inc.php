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
        if($_GET['action'] == 'SAVE'){
            $orderId = $_GET['orderId'];
            $status = $_GET['status'];
            $sql = "UPDATE Orders SET Status='$status' WHERE id='$orderId'";
            mysqli_query($dbConnection, $sql);
            header("Location: ../ordersManagement.php?result=updateSuccess");
            exit();
        }
    }

    function getOrders($dbConnection){
        $orders = [];
        $userId = $_SESSION["userId"];

        $sql = "SELECT Id, Total, CreatedDate, Status
                FROM Orders 
                ORDER BY CreatedDate DESC";
        $result = mysqli_query($dbConnection, $sql);
        while($order = mysqli_fetch_assoc($result)){
            array_push($orders, $order);
        }

        return $orders;
    }
?>