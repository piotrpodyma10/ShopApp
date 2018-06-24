<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include_once 'dbConnection.inc.php';

    $order = getOrder($dbConnection); 
    $orderItems = getOrderItems($dbConnection); 

    if(isset($_POST['action'])){
        handlePostAction($dbConnection);
    }

    function getOrder($dbConnection){
        $order;
        $orderId = $_GET["orderId"];

        $sql = "SELECT Orders.Id, Orders.Total, Orders.CreatedDate, Orders.Status, 
                        OrderDetails.FirstName, OrderDetails.LastName, 
                        OrderDetails.PhoneNumber, OrderDetails.Email, OrderDetails.Street, 
                        OrderDetails.HouseNumber, OrderDetails.FlatNumber, OrderDetails.City, 
                        OrderDetails.PostalCode, OrderDetails.State, OrderDetails.Country,
                        Logins.Login
                FROM Orders 
                LEFT JOIN OrderDetails ON Orders.OrderDetailsId = OrderDetails.Id
                LEFT JOIN Logins ON Orders.UserId = Logins.UserId
                WHERE Orders.Id = $orderId";

        $result = mysqli_query($dbConnection, $sql);
        $order = mysqli_fetch_assoc($result);

        return $order;
    }

    function getOrderItems($dbConnection){
        $orderItems = [];
        $orderId = $_GET["orderId"];

        $sql = "SELECT OrderItems.Quantity, OrderItems.Unitprice, 
                        Products.ImageUrl, Products.Name, Products.Description
                FROM OrderItems 
                LEFT JOIN Products ON OrderItems.ProductId = Products.Id 
                WHERE OrderId = '$orderId'";

        $result = mysqli_query($dbConnection, $sql);
        while($orderItem = mysqli_fetch_assoc($result)){
            array_push($orderItems, $orderItem);
        }

        return $orderItems;
    }

    function handlePostAction($dbConnection){
        if($_POST['action'] == 'SAVE'){ 
            $orderId = $_POST['orderId'];
            $status = $_POST['status'];

            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $country = $_POST['country'];
            $postalCode = $_POST['postalCode'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $street = $_POST['street'];
            $houseNumber = $_POST['houseNumber'];
            $flatNumber = $_POST['flatNumber'];
            $phoneNumber = $_POST['phoneNumber'];
            $email = $_POST['email'];

            $sql = "UPDATE OrderDetails 
                    SET FirstName='$firstName', LastName='$lastName', PhoneNumber='$phoneNumber', 
                        Email='$email', Street='$street', HouseNumber='$houseNumber', 
                        FlatNumber='$flatNumber', City='$city', PostalCode='$postalCode', 
                        State='$state', Country='$country'
                    WHERE OrderId = '$orderId';";
            mysqli_query($dbConnection, $sql);

            $sql = "UPDATE Orders 
                    SET Status='$status'
                    WHERE Id = '$orderId';";
            mysqli_query($dbConnection, $sql);
            
            header("Location: ../orderDetails.php?orderId=$orderId&result=success");
            exit();
        }
    }
?>