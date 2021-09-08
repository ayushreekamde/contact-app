<?php
    include 'config.php';
    if(!isset($_COOKIE['authentication']))
    {
       if(!isset($_SESSION['authentication']))
       {
           echo "<script>alert('Login to continue');
                      window.location='index2.php'</script>";
        }
}
$dir = 'image/upload/users/';

if($_SERVER['REQUEST_METHOD']=='POST')
{ 
       $name = $_POST['username'];
       $contact = $_POST['usermobile'];
       $email = $_POST['useremail'];
       $address = $_POST['adress'];
       
       if(isset ($_COOKIE['authentication']))
        {
           $userid = $_COOKIE['authentication'];
        } 
       else
        {
           $userid=$_SESSION['authentication']['email'];
        }

        $sql1="SELECT 'email' from contacts WHERE email='$email'";

        $result=$conn->query($sql1);
          
        if($result->num_rows<=0)
           {
              
              $path = $dir.$_FILES['profile_img']['name'];
              
                if(file_exists($path)) 
                {
                    echo "<script>
                    alert('This image already in use');
                    </script>";
                }
                else
                { 

                    move_uploaded_file($_FILES['profile_img']['tmp_name'],$path);

                    $sql="INSERT INTO contacts(fullname,mobile,email,adress,profile_img,userid,created) VALUES
                                        ('$name',$contact,'$email','$address','$path','$userid',now())";
                    
                        if($conn->query($sql))
                        {
                        echo "<script>
                                alert('Data saved successfully');
                                window.location='dashboard.php';
                                </script>";
                        }
                        else
                        {
                        echo $sql."ERROR :".$conn->error;
                        }
              
                }
           }    
          else
            {
              echo "<script>alert('Account is already exsist!'); </script>";
            
            }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php';  ?>
</head>
<body>
    <?php include 'includes/navbar.php';?>
    <div class="container mt-3 add-contact-form" >
        <h2 class="text-primary mt-3 mb-3 text-center">Add Contact </h2>
        
        <a href="dashboard.php"  class="border border-info p-4"
        data-bs-toggle="tooltip" data-bs-placement="bottom" title="View All Contacts">
        <img src="https://img.icons8.com/clouds/100/000000/todo-list.png"/>
        </a>  
        <hr>
    
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label  class="form-label">Profile Image</label>
            <input type="file" name="profile_img" class="form-control"  placeholder="abc xyz">
        </div>
        <div class="mb-3">
            <label  class="form-label">Full Name</label>
            <input type="text" name="username" class="form-control"  placeholder="abc xyz">
        </div>
        <div class="mb-3">
            <label  class="form-label">Mobile Number</label>
            <input type="tel" name="usermobile" class="form-control"  placeholder="xxxxxxxxxx">
        </div>
        <div class="mb-3">
            <label  class="form-label">Email address</label>
            <input type="email" name="useremail" class="form-control"  placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label  class="form-label">Address</label>
            <textarea class="form-control" name="useraddress" rows="3"></textarea>
        </div>
        <button class="btn btn-success" type="submit" name="submit">
            Add Contact
        </button>    
    </form>
    </div>
    <?php include "includes/script.php"; ?> 
</body>
</html>