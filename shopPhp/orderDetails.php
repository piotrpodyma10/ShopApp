<?php
    include_once 'header.php';
    include_once 'includes/dbConnection.inc.php';
    include_once 'includes/orderDetails.inc.php';
?>
    <h1>Orders Management</h1>
    
    <h2>Order</h2>
    User: <?php echo $order["Login"] ?> <br />
    Order Number: <?php echo $order["Id"] ?> <br />
    Total: <?php echo $order["Total"] ?> <br />

    <h2>Details</h2>

    <form  action="includes/orderDetails.inc.php" method="POST">
            <select name="status">
                <option value="NEW" <?php echo $order["Status"] == "NEW" ? "selected" : "" ?>>New</option>
                <option value="PENDING" <?php echo $order["Status"] == "PENDING" ? "selected" : ""  ?>>Pending</option>
                <option value="ACCEPTED" <?php echo $order["Status"] == "ACCEPTED" ? "selected" : ""  ?>>Accepted</option>
                <option value="REJECTED" <?php echo $order["Status"] == "REJECTED" ? "selected" : ""  ?>>Rejected</option>
                <option value="IN_PROGRESS" <?php echo $order["Status"] == "IN_PROGRESS" ? "selected" : "" ?>>In progress</option>
                <option value="SENT" <?php echo $order["Status"] == "SENT" ? "selected" : ""  ?>>Sent</option>
                <option value="DELIVERED" <?php echo $order["Status"] == "DELIVERED" ? "selected" : ""  ?>>Delivered</option>
                <option value="CANCELLED" <?php echo $order["Status"] == "CANCELLED" ? "selected" : ""  ?>>Cancelled</option>
            </select>
            <div>
                <input id="firstName" type="text" name="firstName" value='<?php echo $order["FirstName"]?>'>
                <label for="firstName">First Name</label>
            </div>
            <div>
                <input id="lastName" type="text" name="lastName" value='<?php echo $order["LastName"]?>'>
                <label for="lastName">Last Name</label>
            </div>
            <div>
                <input id="street" type="text" name="street" value='<?php echo $order["Street"]?>'>
                <label for="street">Street</label>
            </div>
            <div>
                <input id="houseNumber" type="text" name="houseNumber" value='<?php echo $order["HouseNumber"]?>'>
                <label for="houseNumber">House Number</label>
            </div>
            <div>
                <input id="flatNumber" type="text" name="flatNumber" value='<?php echo $order["FlatNumber"]?>'>
                <label for="flatNumber">Flat Number</label>
            </div>
            <div>
                <input id="postalCode" type="text" name="postalCode" value='<?php echo $order["PostalCode"]?>'>
                <label for="postalCode">Postal Code</label>
            </div>
            <div>
                <input id="city" type="text" name="city" value='<?php echo $order["City"]?>'>
                <label for="city">City</label>
            </div>
            <div>
                <input id="state" type="text" name="state" value='<?php echo $order["State"]?>'>
                <label for="state">State</label>
            </div>
            <div>
                <input id="country" type="text" name="country" value='<?php echo $order["Country"]?>'>
                <label for="country">Country</label>
            </div>
            <div>
                <input id="phoneNumber" type="text" name="phoneNumber" value='<?php echo $order["PhoneNumber"]?>'>
                <label for="phoneNumber">Phone Number</label>
            </div>
            <div>
                <input id="email" type="text" name="email" value='<?php echo $order["Email"]?>'>
                <label for="email">E-Mail</label>
            </div>
            <input type='hidden' name='action' value='SAVE'/>
            <input type='hidden' name='orderId' value='<?php echo $order["Id"]?>'/>
            <button type="submit"  name="submit" label="Save">Save</button>
        </form>


    <h2>Products</h2> 
    <table>
            <thead>
                <th>#</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
            </thead>
            <?php for($i = 0; $i < count($orderItems); $i++): ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><img src='<?php echo $orderItems[$i]["ImageUrl"] ?>' width='64px' height='48px'/></td>
                    <td><?php echo $orderItems[$i]["Name"] ?></td>
                    <td><?php echo $orderItems[$i]["Description"] ?></td>
                    <td><?php echo $orderItems[$i]["Unitprice"] ?></td>
                    <td><?php echo $orderItems[$i]["Quantity"] ?></td>
                </tr>
            <?php endfor; ?>
        </table>

<?php
    include_once 'footer.php';
?>