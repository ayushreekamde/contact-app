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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php';  ?>
</head>
<body>
    <?php include 'includes/navbar.php';?>

    <div class="container view-contact mt-3">
       <h1 class="text-center">Welcome <span class="text-primary">, 
           <?php
                if(isset($_COOKIE['authentication']))
                {
                    $data = $_COOKIE['authentication'];
                    echo $data;
                }
                else
                {
                    $data = $_SESSION['authentication']['email'];
                    echo $data;
                }
            
            ?> 
        </span>
        </h1>
       <div>
           <a class="btn btn-info add-contact-btn" href="addcontact.php" 
              data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add New Contact">
              <img src="https://img.icons8.com/clouds/50/000000/add.png"/>
            </a>
       </div> 
       <hr>
        <div class="row">
            <?php 
                $sql="SELECT * from contacts where userid='$data'";
                $result=$conn->query($sql);

                if($result->num_rows>0)
                {
                    while($row=$result->fetch_assoc())
                    {
            ?>    
                        <div class="col-md-3">
                            <div class="card" >
                            <img src="<?php echo $row['profile_img' ]?>" class="card-img-top contacts" alt="user image" style="height:200px">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['fullname']?></h5>
                                    <p class="mb-1">
                                        <a href="tel:<?php echo $row['mobile' ]?>" target='_blank'><?php echo $row['mobile' ]?></a>
                                    </p>
                                    <p class="mb-1">
                                        <a href="mailto:<?php echo $row['email' ]?>" target='_blank'><?php echo $row['email']?></a>
                                    </p>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <!-- Edit contact button-->
                                    <a href="editcontact.php? q=<?php echo $row['id']?> & f=<?php echo $row['profile_img'];?>" class="btn btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Contact">
                                        <img src="https://img.icons8.com/ios-glyphs/30/000000/edit.png"/>
                                    </a>
                                      
                                        <!-- Delete contact button-->
                                    <a href="deletecontact.php? q=<?php echo $row['id']?> & f=<?php echo $row['profile_img'];?>" class="btn btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Contact">
                                        <img src="https://img.icons8.com/clouds/30/000000/delete-sign.png"/>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
                else
                    {
                        echo "<h3 class='text-danger'>No records found</h3>";

                    }
            ?>    
        </div>
    </div>
    <?php include "includes/script.php"; ?> 
</body>
</html>