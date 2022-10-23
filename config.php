<?php
//function db(){
    //set your configs here
    $host = "localhost";
    $user = "femi";
    $db = "zuriphp";
    $password = "femi";

    $conn = mysqli_connect($host, $user, $password,$db);

    if($conn->connect_error){
        die( "connection failed:". $conn->connect_error);
    }
    echo "Connected to database successfully";
     echo "<br>";


    //$conn = mysqli_connect($host, $user, $password,$db);
     /* if(!$conn){
        //echo "<script> alert('Error connecting to the database') </script>";
   }
     return $conn;
    else{
        echo "Connected to database successfully";
    }
}  */

 ?>