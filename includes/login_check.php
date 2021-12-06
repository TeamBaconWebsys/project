<?php
  session_start();
  if (!isset($_SESSION['user_id']) && !isset($_SESSION['username'])) {
    ob_start();
    header('Location: ../auth/login.php');
    ob_end_flush();
    die();
  }
?>