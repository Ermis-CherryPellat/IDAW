<?php
session_start();
session_destroy();
setcookie('login', '', time()-3600, '/');
header('Location: pages-login.php');
exit;
?>