<?php
    include_once 'header.php';
    include_once 'includes/dbConnection.inc.php';
    include_once 'includes/ordersManagement.inc.php';
?>
    <h1>Orders Management</h1>
    
    <table>
        <thead>
            <th>#</th>
            <th>Order</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Total</th>
            <th>Save</th>
        </thead>
        <?php for($i = 0; $i < count($orders); $i++): ?>
            <tr>
                <form action='includes/ordersManagement.inc.php' method='GET'>
                    <td><?php echo $i + 1 ?></td>
                    <td><a href='orderDetails.php?orderId=<?php echo $orders[$i]["Id"] ?>'><?php echo $orders[$i]["Id"] ?></a></td>
                    <td>
                        <select name="status">
                            <option value="NEW" <?php echo $orders[$i]["Status"] == "NEW" ? "selected" : "" ?>>New</option>
                            <option value="PENDING" <?php echo $orders[$i]["Status"] == "PENDING" ? "selected" : ""  ?>>Pending</option>
                            <option value="ACCEPTED" <?php echo $orders[$i]["Status"] == "ACCEPTED" ? "selected" : ""  ?>>Accepted</option>
                            <option value="REJECTED" <?php echo $orders[$i]["Status"] == "REJECTED" ? "selected" : ""  ?>>Rejected</option>
                            <option value="IN_PROGRESS" <?php echo $orders[$i]["Status"] == "IN_PROGRESS" ? "selected" : "" ?>>In progress</option>
                            <option value="SENT" <?php echo $orders[$i]["Status"] == "SENT" ? "selected" : ""  ?>>Sent</option>
                            <option value="DELIVERED" <?php echo $orders[$i]["Status"] == "DELIVERED" ? "selected" : ""  ?>>Delivered</option>
                            <option value="CANCELLED" <?php echo $orders[$i]["Status"] == "CANCELLED" ? "selected" : ""  ?>>Cancelled</option>
                        </select>
                    </td>
                    <td><?php echo $orders[$i]["CreatedDate"] ?></td>
                    <td><?php echo $orders[$i]["Total"] ?></td>
                    <td>
                        <input type='hidden' name='orderId' value='<?php echo $orders[$i]["Id"] ?>'/>
                        <input type='hidden' name='action' value='SAVE'/>
                        <button type='submit' label='Save'>Save</button>
                    </td>
                </form>
            </tr>
        <?php endfor; ?>
    </table>

<?php
    include_once 'footer.php';
?>