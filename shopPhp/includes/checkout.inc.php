<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include_once 'dbConnection.inc.php';

    $cartItems = [];
    $cartItems = getCartItems($dbConnection); 

    if(isset($_POST['submit'])){
        handlePost($dbConnection, $cartItems);
    }

    function handlePost($dbConnection, $cartItems){
        $userId = $_SESSION['userId'];
        $orderId = insertOrder($dbConnection, $userId, $cartItems);
        $orderDetailsId = insertOrderDetails($dbConnection, $orderId, $userId);
        insertOrderItems($dbConnection, $orderId, $cartItems);
        clearCart($dbConnection);
    }

    function insertOrder($dbConnection, $userId, $cartItems){
        $total = 0;
        foreach($cartItems as $cartItem){
            $total += $cartItem['UnitPrice'] * $cartItem['Quantity'];
        }

        $sql = "INSERT INTO Orders 
                    (UserId, Total, Status) 
                VALUES
                    ('$userId', '$total', 'Pending');";        
        mysqli_query($dbConnection, $sql);
        return mysqli_insert_id($dbConnection);
    }

    function insertOrderDetails($dbConnection, $orderId, $userId){
        $firstName;
        $lastName;
        $country;
        $postalCode;
        $city;
        $state;
        $street;
        $houseNumber;
        $flatNumber;
        $phoneNumber;
        $email;
        if(isset($_POST['isOtherDeliveryAddress'])){
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
        } else {
            $sql = "SELECT * FROM Users WHERE Id = $userId";
            $user = mysqli_fetch_assoc(mysqli_query($dbConnection, $sql));
            $firstName = $user['FirstName'];
            $lastName = $user['LastName'];
            $country = $user['Country'];
            $postalCode = $user['PostalCode'];
            $city = $user['City'];
            $state = $user['State'];
            $street = $user['Street'];
            $houseNumber = $user['HouseNumber'];
            $flatNumber = $user['FlatNumber'];
            $phoneNumber = $user['PhoneNumber'];
            $email = $user['Email'];
        }

        $sql = "INSERT INTO OrderDetails 
                    (OrderId, FirstName, LastName, PhoneNumber, Email, Street, HouseNumber, FlatNumber, City, PostalCode, State, Country) 
                VALUES
                    ('$orderId', '$firstName', '$lastName', '$phoneNumber', '$email', '$street', '$houseNumber', '$flatNumber', '$city', '$postalCode', '$state', '$country');";        
        mysqli_query($dbConnection, $sql);
        return mysqli_insert_id($dbConnection);
    }

    function insertOrderItems($dbConnection, $orderId, $cartItems){
        $sql = "INSERT INTO OrderItems
                    (OrderId, ProductId, Quantity, Unitprice)
                VALUES";
        
        foreach($cartItems as $cartItem){
            $productId = $cartItem['ProductId'];
            $quantity = $cartItem['Quantity'];
            $price = $cartItem['UnitPrice'];
            $sql = $sql."('$orderId', '$productId', '$quantity', '$price'),";
        }
        $sql = rtrim($sql, ",");
        mysqli_query($dbConnection, $sql);      
    }

    function clearCart($dbConnection){
        $cartId = $_SESSION['cartId'];
        $sql = "DELETE FROM cartItems WHERE CartId='$cartId'";
        mysqli_query($dbConnection, $sql);    
    }

    function getCartItems($dbConnection){
        $cartItems = [];
        if(!isset($_SESSION["cartId"])){
            $_SESSION["cartId"] = getCartId($dbConnection);
        }
        $cartId = $_SESSION["cartId"];

        $sql = "SELECT CartItems.Id, CartItems.UnitPrice, CartItems.ProductId, CartItems.Quantity, Products.Name, Products.ImageUrl
                FROM CartItems 
                LEFT JOIN Products ON CartItems.ProductId = Products.Id 
                WHERE CartId = '$cartId'";
        $result = mysqli_query($dbConnection, $sql);
        while($item = mysqli_fetch_assoc($result)){
            array_push($cartItems, $item);
        }

        return $cartItems;
    }

    function getCartId($dbConnection){
        $userId = $_SESSION["userId"];
        $sql = "SELECT Id FROM Carts WHERE UserId = '$userId'";
        $result = mysqli_query($dbConnection, $sql);
        return mysqli_fetch_assoc($result)["Id"];     
    }
?>