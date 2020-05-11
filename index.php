<?php

require_once 'Controller/AuthController.php';

//verify user using token
if (isset($_GET['token'])) {
  $token = $_GET['token'];
  verifyUser($token);
}


if(!isset($_SESSION['username'])){
    header('location:login.php');
}


?>
<!DOCTYPE html>
<html>

<head>
<?php require 'CDN/cdn.php';?>
<title>home</title>  
<link rel="stylesheet" href="style.css">
</head>


<body>
  


                <div class="container" > 

                <div class="row" >

                <div class="col-md-4 offset-md-4 form-div" >  

                <?php if(isset($_SESSION['message'])):?>   
                <div class="alert <?php echo  $_SESSION['alert-class']?>">
                <?php 
                echo  $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['alert-class']);
               
                ?>
                
               </div>
               <?php endif;?>
      
               <h3>Welcome <?php echo  $_SESSION['username']?></h3>
               <a href="index.php?logout=1" class="logout">logout</a>
                
               <?php if(!$_SESSION['verified']): ?>
               <div class="alert alert-warning" >
                 you need to verify your account
                 <strong> <?php echo  $_SESSION['email']?></strong>
               </div> 
               <?php endif;?>

               <?php if($_SESSION['verified']): ?>
               <button  class="btn btn-block btn-lg btn-primary">I am verified</button>
               <?php endif;?>





        </div>   
        </div>
        </div>
    






    </body>
    </html>  