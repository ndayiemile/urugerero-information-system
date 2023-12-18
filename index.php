<?php
if(file_exists('web/pages/home.php')){
    header('location:web/pages/home.php');
}else{
    echo "directories error";
}
?>