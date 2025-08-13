<?php

function connection(){
    $host = "localhost";
    $user = "root";
    $pass = "";

    $bd = "users_crud_php";

   $connect = mysqli_connect($host, $user, $pass, $bd, 33066);


    return $connect;
};

?>