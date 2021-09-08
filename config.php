<?php
   $servername="localhost";
   $username="root";
   $pass="";
   $dbname="mycontact";

   $conn = new mysqli($servername,$username,$pass,$dbname);

   if($conn->connect_error)
   {
       die("Connection failed by". $conn->connect_error);
    }
   //else{
    //    echo "Connection done successfully";
    //}
    session_start();
?>