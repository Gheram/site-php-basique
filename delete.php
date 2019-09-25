<?php
session_start();
unlink("db/users/".hash('whirlpool', $_SESSION['mail']).".user");
unset($_SESSION['mail']);
session_destroy();
header("location: index.php");

?>