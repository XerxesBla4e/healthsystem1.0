<?php

include('../config/constants.php');

$connect = new mysqli(LOCALHOST,USERNAME,PASSWORD,DBNAME);

if($connect->connect_error){
    echo "Failed To connect:{$connect->connect_error}";
}else{
    
}
?>