<?php
    session_start();
?>

<body>
<div class="content">
            <div id="logo_menu">
            <div id="test">
                <div id="logo"></div>
                <div id="text_logo">Brave King</div>
            </div>
                <?php if (isset($_SESSION['login']) && isset($_SESSION['userId'])): ?>
                            
                            <div id="login_menu">
                                <div id="primary">
                            <a href="index.php"><div class="block icon-home">Home</div></a>
                            <!-- <a href="catalogue.php"><div class="block">Catalogue</div></a> -->
                            <a href="index.php #target"><div class="block icon-book">Catalogue</div></a>
                            <a href="cart.php"><div class="block icon-basket">Basket</div></a>
                            <a href="orders.php"><div class="block icon-money-1">Orders</div></a>
                                </div>
                            <div id="sec">
                            <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'salesman' || $_SESSION['role'] == 'admin')): ?>
                                <a href="OrdersManagement.php"><div class="block icon-cog">Manage Orders</div></a>
                                <style> .block2{height:150px !important;}</style>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                    <a href="UsersManagement.php"><div class="block icon-group">Manage Users</div></a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <form action="includes/logout.inc.php" method="POST" class="block2">
                                <button type="submit" name="submit" class="icon-logout">Log out</button>
                            </form>
                            
                            </div>
                            <!-- <div id="login_menu2"> -->
                            
                            <!-- </div> -->
                            </div>


                <?php endif; ?>
                
            </div>
                <div class="banner">
		            <div class="typed_wrap">
			            <h1><span class="typed"></span></h1>
		            </div>
	            </div>


                <?php if (!isset($_SESSION['login']) && !isset($_SESSION['userId'])): ?>
                <div id="box">
                        <div id="main"></div>
                                <form action="includes/signIn.inc.php" method="POST">      
                                <div id="loginform">
                                    <h1>LOGIN</h1>
                                    <input type="text" id="login" name="login" placeholder="Login">
                                    <input type="password" id="password" name="password" placeholder="Password"/><br>
                                    <button class="submit2" type="submit" name="submit" label="Sign In" >LOGIN</button>
                                </div>
                                </form>

                                <form action="includes/signUp.inc.php" method="POST">
                                <div id="signupform">
                                    <h1>SIGN UP</h1>
                                    <input type="text" name="login" id="login" placeholder="Full Name"/><br>
                                    <input type="email" name="email" id="email" placeholder="Email"/><br>
                                    <input type="password" name="password" id="password" placeholder="Password"/><br>
                                    <input id="passwordRepeat" type="password" name="repeatPassword" placeholder="Password again">
                                    <button class="submit2" type="submit" name="submit" label="Sign Up" >SIGN UP</button>
                                </div>
                                </form>

                                <div id="login_msg">Have an account?</div>
                                <div id="signup_msg">Don't have an account?</div>
                                
                                <button id="login_btn">LOGIN</button>
                                <button id="signup_btn">SIGN UP</button>
                    </div>
            </div>
            <?php endif; ?>
    <?php
    include_once 'footer.php';
?>
</body>
