<?php

session_start();

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
} else{
      unset($_SESSION['username']);
      unset($_SESSION['role']);

      unset($_COOKIE['PHPSESSID']);
      setcookie('PHPSESSID', '', time() - 3600, '/');

      session_destroy();
      header("Location: login.php");
      exit;
    }

header("Location: login.php");
exit;
?>