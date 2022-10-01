<?php
  $con = mysqli_connect("localhost","root","","testb");

    


  $name 		= $con->real_escape_string($_POST['name']);
  $mail         = $con->real_escape_string($_POST['mail']);
  $conta         = $con->real_escape_string($_POST['contact']);
  $passw         = $con->real_escape_string($_POST['pass']);
	

	/*$check = "SELECT student FROM contribution WHERE student='$lname'";
	$nat = $con->query($check)->num_rows;
if($nat == ""){*/
	 if(!empty($name)){

        $insert  = "INSERT INTO users (`name`,'email','phone','password')
         VALUES ('$name','$mail','$conta','$passw')";
        $result  = $con->query($insert);

        if($result){
            $_SESSION['message'] = 'added!';
            $_SESSION['success'] = 'success';
            

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';

        }
     
    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
/*}else{
		$_SESSION['message'] = 'already taken. Please enter a unique Government ID!';
		$_SESSION['success'] = 'danger';
	}*/
    header("Location: dashoard.php");
$con->close();