<?php

$server="127.0.0.1";
$user_name="Nisuga";
$password="mostwanted";
$database="mr.mcq";

$conn=new mysqli($server,$user_name,$password,$database);

if($conn->connect_error){

die("Connection Failed : " . $conn->connect_error);
echo "Error";
}

?>