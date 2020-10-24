<?php
session_start();
unset($_SESSION['token_id']);
session_destroy();

header("Location: cms.php");
exit;


?>