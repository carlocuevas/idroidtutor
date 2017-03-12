<?php
    require 'dbconfig.php';
    session_start();
    if(isset($_POST['LogIn']))
    {
        $name = $_POST['Uname'];
        $pass = $_POST['UPass'];
        $query = mysqli_query($con,"SELECT * from tbldean where username = '$name' and password = '$pass' ");
        if($query)
        {
            if($row=mysqli_fetch_array($query))
            {
                    
                    $_SESSION['deanID'] = $row['DeanID'];
                    header("location:backend.php");    
            }


        }
    }

    if(isset($_SESSION['deanID']))
      {
          header("location:backend.php");                
      }
    if(isset($_POST['forgot_password']))
    {
      $queryyy=mysqli_query($con,"SELECT * from tbldean");
      $row=mysqli_fetch_array($queryyy);
      $message="Your password is ".$row['password'];
      $msg=wordwrap($message,100);
      $headers="From: IDroidTutor.com" . "\r\n" . "CC: cuevascarlo36@yahoo.com";
      mail("cuevascarlo36@yahoo.com","Forgot Password",$msg,$headers);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/logo1.png" type="image/png" sizes="16x16">
    <title>Backend</title>
    <!-- sources -->
    <link href="build/css/metro.css" rel="stylesheet">
    <link href="build/css/backend.css" rel="stylesheet">
    <link href="build/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="build/css/metro-icons.css" rel="stylesheet">
    <link href="build/css/metro-responsive.css" rel="stylesheet">
    <script src="build/js/jquery-2-1-3.min.js"></script>
    <script src="build/js/jquery.dataTables.min.js"></script>
    <script src="build/js/metro.js"></script>
    <style>
        html,body {
           
            height: 100%;
            padding:0;
            background-image: url(images/background1.PNG);
            background-repeat: repeat;
        }

        
    </style>
</head>
    

    
<body>
        <h3 class="small" style="background-color: #0072C6; padding:12px; color:#ffffff; margin-top:0px; border-bottom: solid #FFCE44">iDroidTutor: Maintenance</h3>
    
    <div class="container flex-grid" >
      <div class="cell size12 padding100" >
          
       <div class="row flex-just-center" >
       <div class="cell size5 padding20 shadow" style="background-color:#ffffff">
                <form action="" method="POST">
                          <div class="input-control modern text iconic full-size" data-role="input">
                              <input type="text"  name="Uname" maxlength="20">
                              <span class="informer">Please enter your username</span>
                              <span class="placeholder">Username</span>
                              <span class="icon mif-user fg-whitex"></span>
                              <button class="button helper-button clear"><span class="mif-cross"></span>
                                  </button>
                            </div>
                            <br/>
                            <br/>
                            <div class="input-control modern password iconic full-size" data-role="input">
                              <input type="password" name="UPass"  >
                              <span class="informer">Please enter your password</span>
                              <span class="placeholder">Password</span>
                              <span class="icon mif-lock"></span>
                              <button class="button helper-button reveal"><span class="mif-looks"></span></button>
                            </div>
                            <br/>
                            <br/>
                    
                    
                       <button class="button bg-darkBlue bg-active-lightBlue align-center fg-white full-size" name="LogIn">Sign In</button>
                       <button class="button link" name="forgot_password" style="text-decoration:none;">Forgot Password?</button>

                </form>
           
         </div>
         </div>
     </div>
  </div>
    
           <div class="copyright" style="float:center; position: absolute; left: 12; background-color: #242529; bottom: 0;color: #ffffff; height: 50px;width: 100%; text-align: center" >
                            <p>Copyright © 2016. This Website is for educational purposes only, Developed and Created by iDroidTutor Developers</p>
         </div>
      
</body>
<script type="text/javascript">
</script>
</html>