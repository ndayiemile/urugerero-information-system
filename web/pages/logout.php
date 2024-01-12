<?php
require_once('../../core/App.php');
try {
    $validityDuration = time() - COOKIE_VALIDITY_TIME;
    $path = "/";
    setcookie("userId", " ", $validityDuration, $path);
    header("location:login.php");
} catch (Throwable $e) {
    var_dump($e);
}
