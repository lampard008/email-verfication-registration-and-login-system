<?php

require_once 'Controller/AuthController.php';



?>
<!DOCTYPE html>
<html>

<head>
<?php require 'CDN/cdn.php';?>
<title>Login </title>  
<link rel="stylesheet" href="style.css">
</head>


<body>
  


                <div class="container" > 

                <div class="row" >

                <div class="col-md-4 offset-md-4 form-div login" >  
               
      
                <form action="login.php" method="post">
               

                <h3 class="text-center">Login </h3>

                <?php if(count($errors) > 0): ?>      
                 <div class="alert alert-danger">
                 <?php foreach($errors as  $error): ?>
                <li> <?php echo $error.'<br>';?></li>
                
                 <?php endforeach; ?>
                 </div>
                 <?php endif; ?>
           
               


                
                <div class="form-group">
                <label>Username or Email</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username ?>">

                <div class="red-text">
               
                </div>
                </div>

               


                  
             
                  
                 
                <div class="form-group">
                <label>password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password ?>">
               
                <div class="red-text">
               
                 </div>
                 </div>   

                
            

                 
                 <div class="form-group">      
                 <button type="submit" name='login' class="btn btn-primary">sign in</button>
             
                 <p class='text-center'><strong>Not yet a member?</strong> <a href='signin.php'><b>Sign Up</b></p>

                 </div> 

             </form>
              









        </div>   
        </div>
        </div>
    






    </body>
    </html>  