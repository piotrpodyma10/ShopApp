<html>
    <head>
    <?php
                    include_once 'files.php';
                    include_once 'css.php';
                ?>
<script type="text/javascript">
// var typed3 = new Typed('.typed', {
//     strings: ['My strings are: <i>strings</i> with', 'My strings are: <strong>HTML</strong>', 'My strings are: Chars &times; &copy;'],
//     typeSpeed: 0,
//     backSpeed: 0,
//     smartBackspace: true, // this is a default
//     loop: true
//   });

    $(function(){
        $(".typed").typed({
            strings: [
                "Welcome to our shop! ;-)",
                "What do you need?",
                "Laptop?",
                "Mobile phone?",
                "Here you can find everything! Have fun! :-)"
            ],
            typeSpeed:30,
            startDelay: 1400,
            backDelay:1000,
            backSpeed:30,
            loop:true,
            loopCount:1
        })
    });
</script> 

    </head>

    <body>
        <div id="fullPage">
            <section class="intro">
                <?php
                    include_once 'header.php'
                ?>
                
            </section>

            <section>
                <div id="target">
                <div class="content">
                    <?php 
                        include_once 'catalogue.php';
                    ?>
                </div>
                </div>
             
            </section>

            <section id="Third">
                <div class="content">
                    <?php 
                        include_once 'contact.php';
                    ?>

                </div>
                
            </section>
           
        

        <script type="text/javascript">
                $('#fullPage').fullpage();
                FastClick.attach(document.body);
        </script>
    </body>
</html>