<?php
session_start();
header('Location: ../index.php' );
setcookie(session_name(), '', 100);
session_unset();
session_destroy();
exit();
?>
