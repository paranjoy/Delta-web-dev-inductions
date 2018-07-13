<?php 

session_start();
    if($_SESSION['email']){
        header("location: main.php");
    }

     $password = $password2 = $first = $last = $email = $error = "";
	$db = mysqli_connect("localhost:3306", "paranjoy_task3i", "?,a!rM?*jg~W", "paranjoy_task3");// connect to database
       if (isset($_POST['submit1'])){
        $first = strtoupper($_POST['first']);
        $last = strtoupper($_POST['last']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
                $sql = "SELECT email FROM project_users WHERE email='$email'";
                $result = mysqli_query($db, $sql);
		if ($password == $password2 && mysqli_num_rows($result)==0){
//          $password = md5($password);//hash password before storing for security purposes
            $sql = "INSERT INTO `project_users` (`id`, `first`, `last`, `email`, `password`) VALUES (NULL, '$first', '$last', '$email', '$password')";
			mysqli_query($db, $sql);
            $error ="please proceed to SIGN IN";
//			header("location: index.php"); 
		   }
           else if(mysqli_num_rows($result)>0){
           $error = "This EMAIL already exist";   
           }
           else if($password != $password2){
			$error = "The two passwords do not match";
		   }   
	    }



    $s_password = $s_email = $err ="";
    $db = mysqli_connect("localhost:3306", "paranjoy_task3i", "?,a!rM?*jg~W", "paranjoy_task3");
    if (isset($_POST['submit'])) {
        $s_email = $_POST['s_email'];
        $s_password = $_POST['s_password'];
        $s_email = mysqli_real_escape_string($db, $s_email);
        $s_password = mysqli_real_escape_string($db, $s_password);
        $sql = "SELECT * FROM project_users WHERE (email='$s_email') AND (password='$s_password')";
        $res = mysqli_query($db, $sql);
        $row = mysqli_num_rows($res);
    if($row<=0)
        {
            $err = "Incorrect EMAIL/PASSWORD combination";
        }
        else{
            $_SESSION['email'] = $s_email;
           header("location: main.php");
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
    <div  style="position: absolute; left: 8%; top:13%;  ">
<center>
        <span style="color: #000; font-size: 2em; " > NOT yet a member?<br> SIGN UP! </span> 
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
   <br>    
  <input type="text" name="first" value="<?php echo $first; ?>" style="background-color:#FAFFBD02; width: 300px; height: 26px; text-align: center; border: 1px dashed black; " placeholder="FIRST NAME" required>
  <br><br>
    <input type="text" name="last" value="<?php echo $last; ?>" style="background-color:#FAFFBD02; width: 300px; height: 26px; text-align: center;  border: 1px dashed black; " placeholder="LAST NAME" required> 
   <br><br>
  <input type="email" name="email" value="<?php echo $email; ?>" style="background-color:#FAFFBD02; width: 300px; height: 26px; text-align: center; border: 1px dashed black; " placeholder="EMAIL" required> 
  <br><br>
  <input type="password" placeholder="PASSWORD" name="password"  style="background-color:#FAFFBD02; width: 300px; height: 26px; text-align: center; border: 1px dashed black;" required>    
   <br><br>
  <input type="password" placeholder="PASSWORD" name="password2"  style="background-color:#FAFFBD02; width: 300px; height: 26px; text-align: center; border: 1px dashed black;" required> 
   <br><br>
  <span class="error"><?php  echo $error;  ?></span>  
  <br><br>
  <input type="submit" name="submit1" value=" Submit " style="background-color: #444; color: yellow; font-size:1.5em; border: 2px solid yellow;">     
</form> 
    <br>      
</center>        
    </div>
    
    
                            <div style="border: 3px solid #555; height:400px; width:0px; margin: 60px auto;"></div>
    
    
<div style="position: absolute; right: 8%; top:13%;  ">
<center>
    <span style="color: #000; font-size: 2em; " > ALREADY a member?<br> SIGN IN! </span> 
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <br><br>
  		<input type="email" name="s_email" value="" style="background-color:#FAFFBD02; width: 300px; height: 26px; text-align: center; border: 1px dashed black; " placeholder="EMAIL" required>
        <br><br> 
  		<input type="password" placeholder="PASSWORD" name="s_password"  style="background-color:#FAFFBD02; width: 300px; height: 26px; text-align: center; border: 1px dashed black;" required>
        <br><br>
        <span class="error"><?php  echo $err;  ?></span>
        <br><br>
        <input type="submit" name="submit" value=" Login " style="background-color: #444; color: yellow; font-size:1.5em; border: 2px solid yellow;">
</form> 
</center>  
    </div>
    
    
    
    
</body>
</html>

