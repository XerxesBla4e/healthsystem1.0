<?php

$conn = new mysqli("localhost","root","xerxescodes","healthsystem");

if($conn->connect_error){
    echo "Failed To connect:{$conn->connect_error}";
}else{
    
}

?>