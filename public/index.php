<?php 
session_start();

$rota = trim($_GET['route'] ?? '/', '/');

if ($rota === '') {
    $rota = '/';
}


require __DIR__ . "/../routes.php";
?>