<?php
    // unset($_SESSION['alogin']);
	session_start();
	session_destroy();
	header('location: login.php');
?>