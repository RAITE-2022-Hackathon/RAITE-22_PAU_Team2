<?php
  $con = mysqli_connect("localhost","root","","testb");
  ?>

<?php 
 
    $query = "SELECT * FROM users";
    $result = $con->query($query);

    $resident = array();
    while($row = $result->fetch_assoc()){
        $resident[] = $row; 
    }

   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Registration</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Login-Box-En.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <form action="index.php" method="post">
    <div class="d-flex flex-column justify-content-center" id="login-box">
        <div class="login-box-header">
            <h4 style="color:rgb(139,139,139);margin-bottom:0px;font-weight:400;font-size:27px;">Registration</h4>
        </div>

        <div class="email-login" style="background-color:#ffffff;">
             <form method="POST" action="save_com.php" enctype="multipart/form-data">
            <input type="text" id="uname" name="name" class="email-imput form-control" style="margin-top:10px;" required="" placeholder="Name" minlength="6"> 
            <input type="email" id="username" name="mail" class="email-imput form-control" style="margin-top:10px;" required="" placeholder="Email" minlength="6"id="username" > 
             <input type="text" id="number" name="contact" class="email-imput form-control" style="margin-top:10px;" required="" placeholder="Contact No." minlength="11" > 


            <input type="password" id="password" name="pass" class="password-input form-control" style="margin-top:10px;" required="" placeholder="Password" minlength="6"></div>
        <div class="submit-row" style="margin-bottom:8px;padding-top:0px;">
            <button class="btn btn-primary d-block box-shadow w-100" id="submit-id-submit" type="submit">Register</button>
        </form>
            <div class="d-flex flex-row align-items-center login-box-seperator-container">
                <div class="login-box-seperator"></div>
                <div class="login-box-seperator-text">
                    <p style="margin-bottom:0px;padding-left:10px;padding-right:10px;font-weight:400;color:rgb(201,201,201);">or</p>
                </div>
                <div class="login-box-seperator"></div>
            </div>
            <div class="login-box-content" data-onsuccess="onSignUp">
                <div class="fb-login box-shadow"></div>
                <div class="gp-login box-shadow"><a class="d-flex flex-row align-items-center social-login-link"  style="margin-bottom:10px;"  name ="google" id="google" href="#"><i class="fa fa-google" style="color:rgb(255,255,255);width:56px;"></i>Sign up with Google+</a></div>

            </div>
            <div class="d-flex justify-content-between">
                
            </div>
        </div>
        <div id="login-box-footer" style="padding:10px 20px;padding-bottom:23px;padding-top:18px;">
            <p style="margin-bottom:0px;">Already have an account?<a id="register-link" href="index.php">Login</a></p>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<script type="module" src="firebase.js"></script>

</html>




    <h4> </h4>
   
 

                   

<?php

include 'config.php';

if(isset($_POST["id"]) && isset($_POST["pass"]))
{
        
    $id = $_POST["id"];
    $pass = $_POST["pass"]; 
        
    try
    {
        //connect to db
        $conn = new PDO("mysql:host=$servername;dbname=$dbname" , $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //sql query
        $stmt = $conn->prepare("INSERT INTO users email, password, name, phone");

        //execute query
        $stmt->execute();
        
        //fetch
        while($result = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            //store fetched data into variable
            $i = $result['EMAIL'];
            $p = $result['PASSWORD'];
            $l = $result['TOKEN'];
            
            if($id == $i && $pass == $p)
            {
                session_regenerate_id();
                $_SESSION['SESS_MEMBER_EMAIL'] = $i;
                $_SESSION['SESS_MEMBER_PASS'] = $p;
                $_SESSION['SESS_MEMBER_TOKEN'] = $l;
                session_write_close();
                $err = "Sucessfuly Registered";
                exit();
            }
            else
            {
                $err = "Please try again";
            }
        }
        
        
        if(isset($err))
        {
            echo "<center><font color='red'><p>$err</p></font></center>";
        }
        
    }
    catch(PDOException $e)
    {
        echo "Connection failed : " . $e->getMessage();
    }

    $conn = null;
}

?>

</form>