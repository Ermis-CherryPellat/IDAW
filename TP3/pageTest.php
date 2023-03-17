<?php 
    session_start();
    $login = $_SESSION['login'];
    echo "<h1>Bienvenu ".$login."</h1>";
    echo '<p><a href="connected.php">Page 1</a></p>';
    ?>
