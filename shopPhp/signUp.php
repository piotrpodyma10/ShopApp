<?php
    include_once 'header.php'
?>

<form  action="includes/signUp.inc.php" method="POST">
    <div>
        <input id="login" type="text" name="login">
        <label for="login">Login</label>
    </div>
    <div>
        <input id="password" type="password" name="password">
        <label for="password">Password</label>
    </div>
    <div>
        <input id="passwordRepeat" type="password" name="repeatPassword">
        <label for="passwordRepeat">Repeat Password</label>
    </div>
    <div>
        <input id="email" type="email"  name="email">
        <label for="email">Email</label>
    </div>
    <button type="submit"  name="submit" label="Sign Up">Sign Up</button>
</form>

<?php
    include_once 'footer.php'
?>

