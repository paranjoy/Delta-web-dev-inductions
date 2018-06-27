<?php 	
     session_start();

    if($_SESSION['email']){
        
        header("location: firstpage.php");
    }
  
    $password = $email = $err ="";
    $db = mysqli_connect("localhost:3306", "paranjoy_task3i", "?,a!rM?*jg~W", "paranjoy_task3");
    

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $email = mysqli_real_escape_string($db, $email);
        $password = mysqli_real_escape_string($db, $password);
        
        
        $sql = "SELECT * FROM users WHERE (email='$email') AND (password='$password')";
        $result = mysqli_query($db, $sql);
        $row = mysqli_num_rows($result);
        
    if($row<=0)
        {
            $err = "Incorrect EMAIL/PASSWORD combination";
        }
        else{
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['email'] = $email;
           header("location: firstpage.php");
        }
    
    
    }




?>

<html>
<head>
<title>LOGIN</title>
<meta charset="utf-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="style.css" rel="stylesheet">
</head>
<body>

    <div id="signup">
<center>
      
   
    
    
     <p>  </p>
<form method="post" action="">  
        <br><br>
        
        <br><br><br><br> <br><br>
  		<input type="email" name="email" value="" style="background-color:#bbb; width: 300px; height: 26px; text-align: center; border: 0px; ; " placeholder="EMAIL" required>
        <br>
        <br> 
  		<input type="password" placeholder="PASSWORD" name="password"  style="background-color:#bbb; width: 300px; height: 26px; text-align: center; border: 0px;" required>
        <br><br>
        <span class="error"><?php  echo $err;  ?></span>
        <br><br>
    
        <input type="submit" name="submit" value=" Login " style="background-color: rgba(0,0,0,0.9); color: yellow; font-size:1.5em; border: 0;">
    
        <br> <br>
        <br><br> <br> 
  	
      <span style="color: #eee">Not yet a member?</span>   
    <a href="signup.php" style="color:white; font-size:1.2em;"><b>Sign up</b></a>

  
  
</form> 
</center>
            
    </div>
    
</body>

</html>

