<?php 
    require_once __DIR__.'/../backend/helpers.php';
    unset($_SESSION['logged_in']);
    $base = getConfig('base');
    header("LOCATION: $base")
?>