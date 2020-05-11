<?php
require_once 'Controller/AuthController.php';




?>
<!DOCTYPE html>
<html>

<head>
<?php require 'CDN/cdn.php';?>

<title>Sign in</title>  
<link rel="stylesheet" href="style.css">
</head>


<body>
  


                <div class="container" > 

                <div class="row" >

                <div class="col-md-4 offset-md-4 form-div" >  
               
      
                <form action="signin.php" method="post">
               

                <h3 class="text-center"> Register </h3>

                 <?php if(count($errors) > 0): ?>      
                 <div class="alert alert-danger">
                 <?php foreach($errors as  $error): ?>
                <li> <?php echo $error.'<br>';?></li>
                
                 <?php endforeach; ?>
                 </div>
                 <?php endif; ?>
           
           
                
                <div class="form-group">
                <label>username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username ?>">
                </div> 
                
                  
               
             

               


                  
               
                <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control"  value="<?php echo $email?>">    
                          
                </div>   
                  
                 
                <div class="form-group">
                <label>password</label>
                <input type="password" name="password" class="form-control"  value="<?php echo $password?>">
               
             
                 </div>   

                
                 <div class="form-group">
                <label>confirmPassword</label>
                <input type="password" name="passwordConf" class="form-control"  value="<?php echo   $passwordConf?>">
                <div class="red-text">
              
                 </div>
                 </div>

                 
                 <div class="form-group">      
                 <button type="submit" name='signin' class="btn btn-primary">sign in</button>
             
                 <p class='text-center'><strong>Already a member?</strong> <a href='login.php'><b>Sign Up</b></p>

                 </div> 

             </form>
              









        </div>   
        </div>
        </div>
    






    </body>
    </html>  