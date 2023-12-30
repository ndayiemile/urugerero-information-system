<?php
session_start();
$_SESSION['userId'] = 1;
$_SESSION['cohortId'] = 1;
// function isLoggedIn()
// {
//     if (isset($_SESSION['userId'])) {
//         if (isset($_SESSION['cohortId'])) {
//             return true;
//         } else {
//             try {
//                 $dbs = new Database();
//                 $tuples = ["*"];
//                 $arguments = ["currentlyFocused" => 1];
//                 $cohort = $dbs->selectAnd("cohorts", $tuples, $arguments);
//                 $_SESSION['cohortId'] = (int)$cohort[0]->id;
//                 return true;
//             } catch (Throwable $th) {
//                 echo $th;
//                 return false;
//             }
//         }
//     } else {
//         return false;
//     }
// }