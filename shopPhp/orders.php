<?php
    include_once 'header.php';
    include_once 'includes/dbConnection.inc.php';
    include_once 'includes/orders.inc.php';
?>
    <h1>Orders</h1>
    
    <?php if (count($orders) > 0): ?>
        <table>
            <thead>
                <th>#</th>
                <th>Order</th>
                <th>Status</th>
                <th>Price</th>
                <th>Cancel</th>
            </thead>
            <?php for($i = 0; $i < count($orders); $i++): ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $orders[$i]["Id"] ?></td>
                    <td><?php echo $orders[$i]["Status"] ?></td>
                    <td><?php echo $orders[$i]["Total"] ?></td>
                    <td>
                        <?php if ($orders[$i]["Status"] == 'Pending'): ?>
                            <form action='includes/orders.inc.php' method='GET'>
                                <input type='hidden' name='orderId' value='<?php echo $orders[$i]["Id"] ?>'/>
                                <input type='hidden' name='action' value='Cancel'/>
                                <button type='submit' label='X'>X</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endfor; ?>
        </table>
    <?php else: ?>
        <h2> You have no Orders</h2>
        Buy something here: <a href="catalogue.php">Catalogue</a>
    <?php endif; ?>

<?php
    include_once 'footer.php';
?>