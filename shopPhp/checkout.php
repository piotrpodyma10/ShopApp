<?php
    include_once 'header.php';
    include_once 'includes/dbConnection.inc.php';
    include_once 'includes/checkout.inc.php';
?>
    <h1>Checkout</h1>
    
    <?php if (count($cartItems) > 0): ?>
        <form  action="includes/checkout.inc.php" method="POST">
            <div>
                <input id="isOtherDeliveryAddress" type="checkbox" name="isOtherDeliveryAddress">
                <label for="isOtherDeliveryAddress">Is delivery address different than default</label>
            </div>
            <div>
                <input id="firstName" type="text" name="firstName">
                <label for="firstName">First Name</label>
            </div>
            <div>
                <input id="lastName" type="text" name="lastName">
                <label for="lastName">Last Name</label>
            </div>
            <div>
                <input id="street" type="text" name="street">
                <label for="street">Street</label>
            </div>
            <div>
                <input id="houseNumber" type="text" name="houseNumber">
                <label for="houseNumber">House Number</label>
            </div>
            <div>
                <input id="flatNumber" type="text" name="flatNumber">
                <label for="flatNumber">Flat Number</label>
            </div>
            <div>
                <input id="postalCode" type="text" name="postalCode">
                <label for="postalCode">Postal Code</label>
            </div>
            <div>
                <input id="city" type="text" name="city">
                <label for="city">City</label>
            </div>
            <div>
                <input id="state" type="text" name="state">
                <label for="state">State</label>
            </div>
            <div>
                <input id="country" type="text" name="country">
                <label for="country">Country</label>
            </div>
            <div>
                <input id="phoneNumber" type="text" name="phoneNumber">
                <label for="phoneNumber">Phone Number</label>
            </div>
            <div>
                <input id="email" type="text" name="email">
                <label for="email">E-Mail</label>
            </div>
            <button type="submit"  name="submit" label="Check out">Check out</button>
        </form>
    <?php else: ?>
        <h2> You have no products in your Cart </h2>
        Select something before checkout <a href="catalogue.php">Catalogue</a>
    <?php endif; ?>

<?php
    include_once 'footer.php';
?>