<?php 
session_start();

//Unset semua session variabel

unset($_SESSION['username']);
unset($_SESSION['password']);

//unset all
session_unset();

//Destroy
session_destroy();

//Arahkan ke halaman login

header('location: ../login.php?pesan=logout');
exit;


?>