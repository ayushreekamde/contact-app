<?php
    include 'config.php';
    if(!isset($_COOKIE['authentication']))
    {
       if(!isset($_SESSION['authentication']))
       {
           echo "<script>alert('Login to continue');
                      window.location='index2.php';</script>";
        }
    }
     
    $dir = 'image/upload/users/';

    // It retrives data from url
    
    $data=$_GET['q'];
    $file=$_GET['f'];
    if(isset($_POST['update']))
    {
        $name=$_POST['username'];
        $contact = $_POST['usermobile'];
        $email = $_POST['useremail'];
        $address = $_POST['useraddress'];
        
        $sql1="SELECT 'email' from contacts WHERE email='$email' AND  id!='$data'";

        $result=$conn->query($sql1);
          
        if($result->num_rows<=0)
        {
            if($_FILES['profile_img']['size']==0)
            {
                $sql="UPDATE contacts SET fullname='$name',email='$email',mobile='$contact',adress='$address',updated=now()
                WHERE id='$data'";
            }
            else
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
                    unlink($file); 

                    move_uploaded_file($_FILES['profile_img']['tmp_name'],$path);

                    $sql="UPDATE contacts SET fullname='$name',email='$email',mobile='$contact',adress='$address',
                    profile_img='$path',updated=now() WHERE id='$data'";
                }
            }

            if($conn->query("$sql")===TRUE)
            {
                echo "<script>
                alert('Data Updated successfully')
                window.location='dashboard.php';
                </script>";
            }
            else
            {
                echo $sql."ERROR :".$conn->error;
            }
        }
        else
        {
             echo "<script>
                    alert('This email is already used');
                    </script>";
        }    
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php';  ?>
     <style>
         .round{
             height: 150px;
             width: 150px;
             border-radius: 225px;
             
         }
      </style>   
</head>
<body>
    <?php include 'includes/navbar.php';?>
    <div class="container mt-3 add-contact-form" >
        <h2 class="text-primary mt-3 mb-3 text-center">Update Contact </h2>
        
        <a href="dashboard.php"  class="border border-info p-4"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="View All Contacts">
        <img src="https://img.icons8.com/clouds/100/000000/todo-list.png"/>
        </a>  
        <hr>
        <div>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php 
                    $sql="SELECT * FROM contacts WHERE id='$data'";
                    $result=$conn->query($sql);

                    if($result->num_rows>0)
                    {
                        while($row=$result->fetch_assoc())
                        {
            ?>  
            <div class="mb-3 text-center p-3">
                <img class= "round" src="<?php echo $row['profile_img']; ?>">
            </div>
        <div class="mb-3">
            <label  class="form-label">Profile Image</label>
            <input type="file" name="profile_img" class="form-control">
        </div>
        <div class="mb-3">
            <label  class="form-label">Full Name</label>
            <input type="text" name="username" value="<?php echo $row['fullname'] ;?>" class="form-control"  placeholder="abc xyz">
        </div>
        <div class="mb-3">
            <label  class="form-label">Mobile Number</label>
            <input type="tel" name="usermobile" value="<?php echo $row['mobile'] ;?>" class="form-control"  placeholder="xxxxxxxxxx">
        </div>
        <div class="mb-3">
            <label  class="form-label">Email address</label>
            <input type="email" name="useremail" value="<?php echo $row['email'] ;?>" class="form-control"  placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label  class="form-label">Address</label>
            <textarea class="form-control" name="useraddress" rows="3">
            <?php echo $row['adress'];?>
            </textarea>
        </div>
         <?php
                    }
                }
         ?>                     
        <button class="btn btn-success" type="submit" name="update">
            Update Contact
        </button>    
    </form>
            </div>
    </div>
    <?php include "includes/script.php"; ?> 
</body>
</html>