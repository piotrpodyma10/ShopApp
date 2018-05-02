<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
    <body>
    <header>
        <nav>
            <div>
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
                <div>
                    <?php
                        if(isset($_SESSION['login']) && isset($_SESSION['userId'])){
                            echo '
                                <form action="includes/logout.inc.php" method="POST">
                                    <button type="submit" name="submit" label="Log out">Log out</button>
                                </form>
                            ';
                            
                        } else {
                            echo '
                                <form action="includes/signIn.inc.php" method="POST">
                                    <input type="text" id="login" name="login" placeholder="login"/>
                                    <input type="password" id="password" name="password" placeholder="password"/>
                                    <button type="submit" name="submit" label="Sign In">Sign In</button>
                                </form>
                                <a href="signUp.php">Sign Up</a>
                            ';
                        }
                    ?>
                </div>
            </div>
        </nav>
    </header>