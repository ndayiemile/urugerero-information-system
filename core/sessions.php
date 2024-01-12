<?php
session_start();
$_SESSION['cohortId'] = 1;
function isLoggedIn()
{
    if (isset($_COOKIE['userId'])) {
        return true;
    } else {
        return false;
    }
}
