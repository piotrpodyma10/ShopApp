<?php
    include_once 'header.php';
    include_once 'includes/dbConnection.inc.php';
    $sql = "SELECT * FROM Products WHERE IsActive = 'true'";
    $result = mysqli_query($dbConnection, $sql);
    $products = [];
    while ($product = mysqli_fetch_assoc($result)){
        array_push($products, $product);
    }
    
?>
    <br>
    <h1>Select your product</h1>

    <?php if (count($products) > 0): ?>
        <?php foreach( $products as $product ): 
            $id = $product['Id'];
            $name = $product['Name'];
            $price = number_format($product['Unitprice'], 2);
            $imageUrl = $product['ImageUrl'];
            ?>
            <div class="product">
                <img src='<?php echo $imageUrl ?>'/>
                Product Name<?php echo $name ?><br/>
                Price <?php echo $price ?>'PLN<br />
                <?php if (isset($_SESSION['login']) && isset($_SESSION['userId'])): ?>
                    <form action='includes/cart.inc.php' style="margin-left:30px;"method='GET'>
                        <input id='quantity' name='quantity'  type='number' min='1' value='1'>
                        <input type='hidden' name='productId' value='<?php echo $id ?>'/>
                        <input type='hidden' name='action' value='ADD'/>
                        <input type='hidden' name='retUrl' value='<?php echo $_SERVER['REQUEST_URI'] ?>'/>
                        <button id="buy" type='submit' label='Buy' class="icon-money-1">Buy</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h2> No products found </h2>
    <?php endif; ?>
    
    <div id="footer">
                <div id="footerBox">
                    <div class="icon-facebook-rect icon"></div>
                    <div class="icon-twitter icon"></div>
                    <div class="icon-email icon"></div>
                    <div class="footerText">Brave King</div>
                </div>
    </div>