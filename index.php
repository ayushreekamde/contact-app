<?php
   if($_POST['username']&&$_POST['usermobile']&&$_POST['useremail']&&$_POST['userpassword']&&$_POST['userconfirmpassword'])
    {
        echo "
           <p>
               Name : ".$_POST['username']."<br>
               Contact : ".$_POST['usermobile']."<br>
                Email : ".$_POST['useremail']."<br>
                Password : ".$_POST['userpassword']."<br>
                Confirm Password : ".$_POST['userconfirmpassword']."<br>
                
            </p>
        ";
    }
    else{
        echo "<h3>Data not recieved </h3>";
    }

?>