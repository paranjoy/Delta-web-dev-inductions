<?php 
   
     
    $password = $first = $last = $email = $error = "";

    // connect to database

	$db = mysqli_connect("localhost:3306", "paranjoy_task3i", "?,a!rM?*jg~W", "paranjoy_task3");
	
       if (isset($_POST['submit'])) {

        
        $first = strtoupper($_POST['first']);
        $last = strtoupper($_POST['last']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
                $sql = "SELECT email FROM users WHERE email='$email'";
                $result = mysqli_query($db, $sql);
		if ($password == $password2 && mysqli_num_rows($result)==0) {
//            $password = md5($password);//hash password before storing for security purposes
           $sql = "INSERT INTO `users` (`id`, `first`, `last`, `email`, `password`) VALUES (NULL, '$first', '$last', '$email', '$password')";
			mysqli_query($db, $sql);
			header("location: index.php"); 
		}
           else if(mysqli_num_rows($result)>0){
           $error = "This EMAIL already exist";   
           }
           else{
			$error = "The two passwords do not match";
		}
	}
?>






<html>
<head>
<title>SIGNUP</title>
<meta charset="utf-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="style.css" rel="stylesheet">
</head>
<body>
 

    <div id="signup">
<center>     
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
   <p>   <br>   </p>  
  <input type="text" name="first" value="<?php echo $first; ?>" style="background-color:#bbb; width: 300px; height: 26px; text-align: center; border: 0px; ; " placeholder="FIRST NAME" required>
  <br><br>
    <input type="text" name="last" value="<?php echo $last; ?>" style="background-color:#bbb; width: 300px; height: 26px; text-align: center; border: 0px; ; " placeholder="LAST NAME" required> 
   <br><br>
  <input type="email" name="email" value="<?php echo $email; ?>" style="background-color:#bbb; width: 300px; height: 26px; text-align: center; border: 0px; ; " placeholder="EMAIL" required> 
  <br><br>
  <input type="password" placeholder="PASSWORD" name="password"  style="background-color:#bbb; width: 300px; height: 26px; text-align: center; border: 0px;" required>    
   <br><br>
  <input type="password" placeholder="PASSWORD" name="password2"  style="background-color:#bbb; width: 300px; height: 26px; text-align: center; border: 0px;" required> 
   <br><br><br>
  <span class="error"><?php  echo $error;  ?></span>  
  <br><br>
  <input type="submit" name="submit" value=" Submit " style="background-color: rgba(0,0,0,0.9); color: yellow; font-size:1.5em; border: 0;">     
</form> 
    <br>
    <p>
        <span style="color: #eee"> Already a member? </span> 
         <a href="index.php" style="color:white; font-size: 1.2em; "><b>Sign in</b></a>
  	</p>
        
</center>
            
    </div>
    
</body>





</html>

