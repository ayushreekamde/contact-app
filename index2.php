<?php 
   include 'config.php';
   if(isset($_COOKIE['authentication']))
    {
      
           echo "<script> window.location='dashboard.php'</script>";
        //header("Location:index2.php");
    }

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
    $email = $_POST['useremail'];
    $pass = $_POST['userpassword'];
    $saveme= $_POST['saveme'];

    $pass=md5($pass);

    $sql="SELECT * from authentication WHERE email='$email'";

    $result=$conn->query($sql);

    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            if($row['pass']==$pass)
            {
               $_SESSION['authentication']=$row;
               if(!empty($_POST['saveme']))
               {
                   setcookie('authentication',$row['email'],time()+(86400*30));
               }   

               echo "<script>alert('Login Succefully !');
                         window.location ='dashboard.php';</script>"; 
            }
            else
            {
                echo "<script>alert ('Password is incorrect !') ;</script>"; 

            }

        }
    }    
    else
    {
        echo "<script>alert('Account does not exist!');</script>"; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php"; ?>
</head>
<body>
   <?php include "includes/navbar.php";?>
   <div class="container mt-5 ">
        <h2 class="text-primary text-center mt-5">Login Here!</h2>
        <form class="signup-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Email address<sup class = "text-danger";>*</sup></label>
            <input type="email" class="form-control" name ="useremail" placeholder="name@example.com"required>
        </div>
        <div class="mb-3">
            <label class="form-lable">Password <sup class = "text-danger";>*</sup></label>
            <input type="password" class="form-control" name="userpassword" placeholder="password"required>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" name="saveme" type="checkbox" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Remember me
            </label>
        </div>
        <div class="row">
        <div class="col-md-6">
            <button class="btn btn-success d-inline" type="submit" name ="submit">Login</button>
        </div>
        <div class="col-md-6">
            <a href="signup.php">New User? Create an account</a>
        </div>
        </div>
    </div>
   <?php include "includes/script.php"; ?> 
</body>
</html>
