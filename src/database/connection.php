<?php

function connect(){
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mock-api';
  $conn = new mysqli($host, $user, $pass, $database);
  if($conn->connect_errno > 0){
    die("Failed to connect to database: ".$db->connect_error);
  }
  return $conn;
}

?>
