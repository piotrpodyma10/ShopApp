<?php
    include_once 'css.php';
    include_once 'header.php';
    include_once 'includes/dbConnection.inc.php';
    include_once 'includes/cart.inc.php';
    include_once './style/additional.php';
    
?>

<?php
    
    ?>

    <h1>Basket</h1>
    
    <?php if (count($cartItems) > 0): ?>
        <table>
            <thead>
                <th>#</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </thead>
            <?php for($i = 0; $i < count($cartItems); $i++): ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><img src='<?php echo $cartItems[$i]["ImageUrl"] ?>' width='64px' height='48px'/></td>
                    <td><?php echo $cartItems[$i]["Name"] ?></td>
                    <td><?php echo $cartItems[$i]["UnitPrice"] ?></td>
                    <td>
                        <?php if($cartItems[$i]["Quantity"] > 1): ?>
                            <form action='includes/cart.inc.php' method='GET'>
                                <input type='hidden' name='itemId' value='<?php echo $cartItems[$i]["Id"] ?>'/>
                                <input type='hidden' name='action' value='DECREMENT'/>
                                <button id="minus" type='submit' label='Subtract'>-</button>
                            </form>
                        <?php endif; ?>
                        <?php echo $cartItems[$i]["Quantity"] ?>
                        <form action='includes/cart.inc.php' method='GET'>
                            <input type='hidden' name='itemId' value='<?php echo $cartItems[$i]["Id"] ?>'/>
                            <input type='hidden' name='action' value='INCREMENT'/>
                            <button id="add" type='submit' label='Increment'>+</button>
                        </form>
                    </td>
                    <td>
                        <form action='includes/cart.inc.php' method='GET'>
                            <input type='hidden' name='itemId' value='<?php echo $cartItems[$i]["Id"] ?>'/>
                            <input type='hidden' name='action' value='REMOVE'/>
                            <button id="remove" type='submit' label='Remove'>X</button>
                        </form>
                    </td>
                </tr>
            <?php endfor; ?>
            <tfoot>
                    <td></td>
                    <td></td>
                    <td>Total: </td>
                    <td><div id="sum"><?php echo $total ?> PLN</div></td>
                    <td></td>
                    <td></td>
            </tfoot>
        </table>
        <a href="./checkout.php"> Checkout Now </a>
        <!-- <style>.banner{display:none;} body{background-color:black; color:white;} a{color:lawngreen;}</style> -->
        
    <?php else: ?>
        <h2> You have no products in your Cart </h2>
        Select something now <a href="index.php #target">Catalogue</a>
        <!-- <style>.banner{display:none;} body{background-color:black; color:white;} a{color:lawngreen;}</style> -->
    <?php endif; ?>

<?php
    include_once 'footer.php';
?>