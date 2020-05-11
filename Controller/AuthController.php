<?php
    
      session_start();
      require 'db.php';
      require 'Controller/emailController.php';
     $errors = array();
     $username =  '';
     $email = '';
     $password = '';
     $passwordConf = '';
    
    
   //if user clicks on the sign up button

    if (isset($_POST['signin'])){
         $username  = $_POST['username'];
         $email  = $_POST['email'];
         $password  = $_POST['password'];
         $passwordConf  = $_POST['passwordConf'];


         if (empty($username)) {
             $errors['username'] = 'username is required';
         }
         else if  (!preg_match('/^[a-zA-Z\s]+$/', $username)) {
              $errors['username']  = 'title must be a letter and space only';     
         } 



         if (empty( $email )) {
            $errors['email']  = 'email is required';
          }
          else if (!filter_var( $email,FILTER_VALIDATE_EMAIL)) {
              $errors['email']  = 'email must be a valid email address'.'</br>';
           }


           if  (empty( $password )) {
            $errors['password']  = 'password is  required';
           }
      
          
           
          if  (empty($passwordConf)) {
          $errors['password']  = 'confirm password is  required';
          }
          if ($password !== $passwordConf) {
          $errors['password']  = 'password don\'t match';
          } 
         
        
         
         $emailquery = "SELECT * from users WHERE email=? LIMIT 1";
         $stmt = $conn->prepare($emailquery);
         $stmt->bind_param('s',$email);
         $stmt->execute();
         $result = $stmt->get_result();
         $userCount =  $result->num_rows;
         $stmt->close();
 
          if ( $userCount > 0) {
            $errors['email']  = 'email already exist';  
          }
         
       if (count($errors) ===0 )   {
           $password = password_hash( $password, PASSWORD_DEFAULT);
           $token = bin2hex(random_bytes(50));
           $verified = false;

           $sql = "INSERT  INTO users (username,email,verified,token,password) VALUES (?,?,?,?,?)";
           $stmt = $conn->prepare($sql);
           $stmt->bind_param('ssbss',$username,$email,$verified,$token,$password);

          if($stmt->execute()){
          // login user
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = $verified;
            sendVerificationEmail($email,$token);

           //flash message
           $_SESSION['message'] = 'you re logged in'; 
           $_SESSION['alert-class'] ='alert success' ;
           header('location:index.php');
           exit();
          }
          else{
            $errors['db_error']  = 'database error';   
          }

       }


        
    }

      //logout 
        if(isset($_GET['logout'])) {
            session_destroy();
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            unset($_SESSION['verified']);
    
            header('location: login.php');
            exit();
        }





     
     
     
   //if user clicks on login button
    if (isset($_POST['login'])){
        $username  = $_POST['username'];
        $password  = $_POST['password'];
    
    
        if (empty($username)) {
            $errors['username'] = 'username is required';
        }
    
        if  (empty( $password )) {
        $errors['password']  = 'password is  required';
        }
    
    
           if(count($errors) === 0) {
    
            $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss',$username,$username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user =  $result->fetch_assoc();
         
            
            if(password_verify($password, $user['password'])){
               $_SESSION['id'] = $user['id']; 
               $_SESSION['username'] = $user['username'];
               $_SESSION['email'] = $user['email'];
               $_SESSION['verified'] = $user['verified'];
           
    
              //flash message
              $_SESSION['message'] = 'you re logged in'; 
              $_SESSION['alert-class'] ='alert success' ;
              header('location:index.php');
              exit();  
    
            }else{
                $errors['wrong'] = 'wrong credentials';
            }
    
    
    
           }
    
        }    
     
     //verify user by token
     function verifyUser($token) {
        global $conn;
        $sql = "SELECT * FROM users WHERE token = '$token' LIMIT 1";
        $result = mysqli_query($conn,$sql);
         if(mysqli_num_rows($result) > 0 ) {
               $user = mysqli_fetch_assoc($result);
               $update_query = "UPDATE users SET verified=1 WHERE token = '$token' LIMIT 1";

               if (mysqli_query($conn, $update_query )){
                $_SESSION['id'] = $user['id']; 
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = 1;
            
     
               //flash message
               $_SESSION['message'] = 'your emil address was successfully verified'; 
               $_SESSION['alert-class'] ='alert success' ;
               header('location:index.php');
               exit();  

               }
         } else{
           $errors['user'] = 'user not found';
         }

     }
?>
