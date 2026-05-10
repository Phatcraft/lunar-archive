<?php
    session_start();

    // Check user session exist
    if(!isset($_SESSION["user"])){
        ?>
            <script>location.replace("/account/login.php")</script>
        <?php
    }
?>