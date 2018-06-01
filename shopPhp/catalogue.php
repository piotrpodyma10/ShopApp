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
    <h1>Product Catalogue</h1>

    <?php if (count($products) > 0): ?>
        <?php foreach( $products as $product ): 
            $id = $product['Id'];
            $name = $product['Name'];
            $price = number_format($product['Unitprice'], 2);
            $imageUrl = $product['ImageUrl'];
            ?>
            <div style='border-style: solid; border-width: medium; padding: 10px; margin: 10px'>
                <img src='<?php echo $imageUrl ?>'/>
                Product Name: <?php echo $name ?><br/>
                Price: <?php echo $price ?><br />
                <?php if (isset($_SESSION['login']) && isset($_SESSION['userId'])): ?>
                    <form action='includes/cart.inc.php' method='GET'>
                        <input id='quantity' name='quantity'  type='number' min='1' value='1'>
                        <input type='hidden' name='productId' value='<?php echo $id ?>'/>
                        <input type='hidden' name='action' value='ADD'/>
                        <input type='hidden' name='retUrl' value='<?php echo $_SERVER['REQUEST_URI'] ?>'/>
                        <button type='submit' label='Buy'>Buy</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h2> No products found </h2>
    <?php endif; ?>
    
<?php
    include_once 'footer.php';
?>