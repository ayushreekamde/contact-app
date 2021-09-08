<?php
    include 'config.php';
    $dir = 'image/upload/';

if($_SERVER['REQUEST_METHOD']=='POST')
{ 
       $name = $_POST['username'];
       $contact = $_POST['usermobile'];
       $email = $_POST['useremail'];
       $pass = $_POST['userpassword'];
       $conf_pass = $_POST['userconfirmpassword'];

       if($pass==$conf_pass)
       {
         $sql1="SELECT 'email' from authentication WHERE email='$email'";

         $result=$conn->query($sql1);
          
         if($result->num_rows<=0)
         {
              $pass=md5($pass);

              $path = $dir.$_FILES['profile_img']['name'];

              move_uploaded_file($_FILES['profile_img']['tmp_name'],$path);

              $sql="INSERT INTO authentication(username,contact,email,pass,profile_img,created) VALUES
                                  ('$name',$contact,'$email','$pass','$path',now())";
             
                if($conn->query($sql))
               {
                  echo "<script>
                        alert('Data saved successfully');
                        window.location = 'index2.php';
                        </script>";
                }
                else
                {
                  echo $sql."ERROR :".$conn->error;
                }
              
          }
          else
          {
              echo "<script>alert('Account is already exsist!'); </script>";
          }
        }
        else
        {
          echo "password does not match";
        }
}
?>

<!doctype html>
<html>
<head>
<?php include "includes/head.php";  ?>

</head>        
<body>
      <?php include "includes/navbar.php";?>
    
<div class="container mt-5 ">
  <h2 class="text-primary text-center mt-5">Add new contact</h2>

  <form class="signup-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
  
  <div class="mb-3">
    <label class="form-label">Name<sup class = "text-danger";>*</sup> </label>
    <input type="text" class="form-control" name="username" placeholder="abc xyz" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Mobile Number</label>
    <input type="tel" class="form-control" name="usermobile" placeholder="xxxxxxxxxx">
  </div>
  <div class="mb-3">
    <label class="form-label">Email address<sup class = "text-danger";>*</sup></label>
    <input type="email" class="form-control" name ="useremail" placeholder="name@example.com"required>
  </div>
  <div class="mb-3">
    <label class="form-lable">Password <sup class = "text-danger";>*</sup></label>
    <input type="password" class="form-control" name="userpassword" placeholder="password"required>
  </div>
  <div class="mb-3">
    <label class="form-lable">Confirm Password <sup class = "text-danger";>*</sup></label>
    <input type="password" class="form-control" name ="userconfirmpassword" placeholder="confirm password"required>
  </div>
  <div class="mb-3">
    <input type="file" class="form-control" name ="profile_img"required>
  </div>
  <div class="row">
    <div class="col-md-6">
       <button class="btn btn-success d-inline" type="submit" name ="submit">Create</button>
    </div>
    <div class="col-md-6">
       <a href="index2.php">Already have an Account? Login Here!</a>
    </div>
</div>
</form>
</div>
       
<?php include "includes/script.php"; ?> 

</body>
</html>    