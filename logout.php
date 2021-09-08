<?php
     include 'config.php';

     session_unset();

     session_destroy();
     if(isset($_COOKIE['authentication']))
     {
     setcookie('authentication','',time()-3600);
     }
     echo"<script>
            window.location = 'index2.php';
        </script>";
?>