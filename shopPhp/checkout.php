<?php
    include_once 'css.php';
    include_once 'header.php';
    include_once 'includes/dbConnection.inc.php';
    include_once 'includes/checkout.inc.php';
    include_once './style/additional.php';
?>
    <h1>Checkout</h1>
    <script>
    function show() {
        var checkBox = document.getElementById("isOtherDeliveryAddress");
        var text = document.getElementById("text");
        if(checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
    
    </script>


    <?php if (count($cartItems) > 0): ?>
        <form  action="includes/checkout.inc.php" method="POST">
            <div>
                <input id="isOtherDeliveryAddress" type="checkbox" name="isOtherDeliveryAddress" onclick="show()">
                <label for="isOtherDeliveryAddress">Is delivery address different than default</label>
            </div>

        <div id="text" style="display:none;">
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
        </div>
        
            <button type="submit"  name="submit" label="Check out" id="ckeckOut">Check out</button>
        </form>
        <!-- <style>.banner{display:none;} body{background-color:black; color:white;} 
        a{color:lawngreen;} input{background-color:black; color:lawngreen;}</style> -->
        
    <?php else: ?>
        <h2> You have no products in your Cart </h2>
        Select something before checkout <a href="catalogue.php">Catalogue</a>
        <!-- <style>.banner{display:none;} body{background-color:black; color:white;}  -->
        <!-- a{color:lawngreen;}</style> -->
        
    <?php endif; ?>

<?php
    include_once 'footer.php';
?>