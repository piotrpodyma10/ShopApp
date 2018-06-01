<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include_once 'dbConnection.inc.php';

    $total = 0;
    $action = '';
    $retUrl = '../cart.php';
    if(isset($_GET["action"])){
        $action = $_GET["action"];
    }
    if(isset($_GET["retUrl"])){
        $retUrl = $_GET["retUrl"];
    }
    $cartItems = [];

    switch ($action){
        case "ADD": 
            add($dbConnection, $retUrl);
            break;
        
        case "REMOVE": 
            remove($dbConnection);
            break;

        case "INCREMENT": 
            increment($dbConnection);
            break;

        case "DECREMENT": 
            decrement($dbConnection);
            break;

        default : 
            $cartItems = getCartItems($dbConnection);
            $total = getTotal($cartItems);
    }

    function getCartItems($dbConnection){
        $cartItems = [];

        if(!isset($_SESSION["CartId"])){
            setCartId($dbConnection);
        }
        $cartId = $_SESSION["cartId"];

        $sql = "SELECT CartItems.Id, CartItems.UnitPrice, CartItems.Quantity, Products.Name, Products.ImageUrl
                FROM CartItems 
                LEFT JOIN Products ON CartItems.ProductId = Products.Id 
                WHERE CartId = '$cartId'";
        $result = mysqli_query($dbConnection, $sql);
        while($item = mysqli_fetch_assoc($result)){
            array_push($cartItems, $item);
        }

        return $cartItems;
    }

    function add($dbConnection, $retUrl){
        if(!isset($_SESSION["CartId"])){
            setCartId($dbConnection);
        }
                
        $cartId = $_SESSION["cartId"];
        $quantity = $_GET["quantity"];
        $productId = $_GET["productId"];
        $productUnitPrice = getProduct($productId, $dbConnection)["Unitprice"];

        $sql = "INSERT 
                    INTO cartItems 
                            (CartId, ProductId, Quantity, Unitprice)
                    VALUES 
                            ('$cartId', '$productId', '$quantity', '$productUnitPrice')";
        
        $isSuccess = mysqli_query($dbConnection, $sql);
        if($isSuccess){
            header("Location: $retUrl?itemAdd=success");
            exit();
        } else {
            header("Location: $retUrl?itemAdd=failed");
            exit();
        }


    }

    function remove($dbConnection){
        $itemId = $_GET["itemId"];
        $sql = "DELETE FROM cartItems WHERE id='$itemId'";
        $isSuccess = mysqli_query($dbConnection, $sql);
        if($isSuccess){
            header("Location: ../cart.php?result=removeSuccess");
            exit();
        } else {
            header("Location: ../cart.php?result=removeFailed");
            exit();
        }
    }

    function increment($dbConnection){
        $itemId = $_GET["itemId"];
        $newItemQuantity = ++getCartItem($dbConnection, $itemId)['Quantity'];
        $sql = "UPDATE cartItems SET Quantity='$newItemQuantity' WHERE id='$itemId'";
        $isSuccess = mysqli_query($dbConnection, $sql);
        if($isSuccess){
            header("Location: ../cart.php?result=updateSuccess");
            exit();
        } else {
            header("Location: ./cart.php?result=updateFailed");
            exit();
        }        
    }

    function decrement($dbConnection){
        $itemId = $_GET["itemId"];
        $newItemQuantity = --getCartItem($dbConnection, $itemId)['Quantity'];
        $sql = "UPDATE cartItems SET Quantity='$newItemQuantity' WHERE id='$itemId'";
        $isSuccess = mysqli_query($dbConnection, $sql);
        if($isSuccess){
            header("Location: ../cart.php?result=updateSuccess");
            exit();
        } else {
            header("Location: ../cart.php?result=updateFailed");
            exit();
        } 
        
    }

    function getCartItem($dbConnection, $itemId){
        $sql = "SELECT * FROM cartItems WHERE Id = '$itemId'";
        $result = mysqli_query($dbConnection, $sql);
        
        if(mysqli_num_rows($result) > 0){
            return mysqli_fetch_assoc($result);
        }else{
            header("Location: ./cart.php?result=cannotAccessItem");
            exit();
        }  
    }

    function setCartId($dbConnection){
        $userId = $_SESSION["userId"];
        $sql = "SELECT Id FROM Carts WHERE UserId = '$userId'";
        $result = mysqli_query($dbConnection, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $_SESSION["cartId"] = mysqli_fetch_assoc($result)["Id"];
        }else{
            $result = mysqli_query($dbConnection, $sql);
            $userId = $_SESSION["userId"];
            $sql = "INSERT INTO Carts 
                    (UserId) 
                VALUES
                    ('$userId');";
            $isSuccess = mysqli_query($dbConnection, $sql);
            if($isSuccess){
                $_SESSION["cartId"] = mysqli_insert_id($dbConnection);
            } else {
                header("Location: ../cart.php?cartCreation=failed");
                exit();
            }
        }        
    }

    function getProduct($productId, $dbConnection) {
        $sql = "SELECT Id, Unitprice FROM Products WHERE Id = '$productId'";
        $result = mysqli_query($dbConnection, $sql);

        if(mysqli_num_rows($result) == 1){
            return mysqli_fetch_assoc($result);
        } elseif (mysqli_num_rows($result) == 0){
            header("Location: ../cart.php?queryProduct=productNotFound");
            exit();
        } else {
            header("Location: ../cart.php?queryProduct=errorQueryingProduct");
            exit();
        }
    }
    
    function getTotal($cartItems){
        $total = 0;
        foreach($cartItems as $item){
            $total += $item['UnitPrice'] * $item['Quantity'];
        }
        return $total;
    }
?>