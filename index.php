<?php 
    session_start();
    include "VelOne/crookwork.php";

    $div1 = new compiler("div"); 
?>

<html>
    <?php include "head.php" ?>
    <body>

        <!-- HEADER HERE -->
        <?php include "header.php" ?>
        <!-- HEADER HERE -->

        <?php $div1->open(); echo"Poop"; $div1->close(); ?>

        <!-- HEADER HERE -->
        <?php include "footer.php" ?>
        <!-- HEADER HERE -->
    </body>
</html>