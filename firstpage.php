<?php
session_start();  
if(!$_SESSION['email']){   
header("location: index.php");
}
echo $_SESSION['email'];
$db = mysqli_connect("localhost:3306", "paranjoy_task3i", "?,a!rM?*jg~W", "paranjoy_task3");
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$h = $m = $d = $mo = $y = "l ";
$error="";
if(isset( $_POST['submit']) && $_POST['title'] !="")
{
    $title=$_POST['title'];
    $_POST['title']="";
    $description=$_POST['description'];
    $ema=$_POST['email'];
    $sd=$_POST['startD']; 
    $st=$_POST['startT'];
    $h=substr($st,0,2);
    $m=substr($st,3,2);
    $d=substr($sd,8,2);
    $mo=substr($sd,5,2);
    $y=substr($sd,0,4);
    $sm = mktime($h,$m,0,$mo,$d,$y);
    $ed=$_POST['endD'];
    $et=$_POST['endT'];
    $h=substr($et,0,2);
    $m=substr($et,3,2);
    $d=substr($ed,8,2);
    $mo=substr($ed,5,2);
    $y=substr($ed,0,4);
    $em = mktime($h,$m,0,$mo,$d,$y);
$sql = "SELECT * FROM user_details WHERE uid ='$id' AND start ='$sm' AND end ='$em' AND title ='$title' AND notes ='$description' AND invitee ='$ema'";
$result = mysqli_query($db, $sql);    
$r = mysqli_num_rows($result);   
if(($em > $sm) && ($r == 0))
    {        
    $sql = "INSERT INTO `user_details` (`id`, `uid`, `start`, `end`, `title`, `notes`, `invitee`, `accept`) VALUES (NULL, '$id', '$sm', '$em', '$title', '$description', '$ema', '-1')";
    mysqli_query($db, $sql);    
    }
else if($em < $sm){
    $error="UNABLE TO SAVE. THERE WAS A MISTAKE IN YOUR INPUT!";
    }
}
$sql = "SELECT * FROM user_details WHERE uid ='$id' ORDER BY start ASC";
$result = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>welcome</title>
<meta charset="utf-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="style.css" rel="stylesheet">   
</head>
<body>
<div id="mySidenav" class="sidenav">
   <span style="font-size:1.5em;color: white; margin: 5px; position: absolute;top: 10px; cursor: default;"> YOU ARE LOGGED IN AS</span>
    <a class="closebtn" onclick="closeNav()">&times;</a>
    <br>
  <a href="#"><?php echo $row['first']; echo " &nbsp; &nbsp;" .$row['last'];  ?></a>
  <a href="#" style="font-size: 1.3em;" ><?php echo $row['email']; ?></a>
    <input type="hidden" id="emai" style="display:none;" value="<?php echo $row['email']; ?>">
    <br><br><hr>
  <a href="redirect.php" style=" cursor: pointer;">LOGOUT &nbsp;&nbsp;</a>  
</div> 
<div id="main">
    <div style="background-color: rgba(0,0,0,0.8); position:fixed; left: 0; top: 0; height;100px; width:100%">
    <span style="font-size:30px;cursor:pointer;color: white; " onclick="openNav()">
    profile &#9776;</span>    
    <center><button id="add"  > CREATE AN EVENT/APPOINTMENT </button></center>
        <button id="invitation" style="font-size:20px;cursor:pointer;color: white;  position:fixed; right:2px; top: 2px; background-color: rgba(0,0,0,0.8); border: 0px;" > INVITATIONS </button>
        <button id="home" style="font-size:20px;cursor:pointer;color: white; position:fixed; right:160px; top: 2px; background-color: rgba(0,0,0,0.8); border: 0px; border-bottom: 3px solid white;" > HOME </button>
        <hr>
    </div>
    <br><br><br><br>
<?php if($error !=""){  ?>
    <center><span id="err" style="font-size:2em; color: white;">  <?php echo $error; ?> </span></center>
    <br>
<?php } ?>    
<!--START LOOP HERE    -->
    <div id="homeshow" style="display: block;">
 <?php
       if(mysqli_num_rows($result)>0){ 
           while($arr = mysqli_fetch_array($result, MYSQL_ASSOC)){ 
               
               $title = $arr['title'];
               $des = $arr['notes'];
               $t = $arr['start'];
               $et = $arr['end'];
               $diff = $et - $t;
              $i = $arr["id"];
        ?>
<div style="color: white;"> 
    <span style="font-size: 2.5em;"> <b><?php echo date("l", $t); ?> </b></span> &nbsp;&nbsp;<span style=" font-size: 1.2em">  <?php echo date(" d", $t)." ".date("F,", $t)." ".date("Y", $t); ?> </span>  <br><br>
     <div style="border-right: 3px solid #eee; height: 40px; width: 185px; height:auto; float: left;">
     <br>
     <span> <?php echo date(" h : i A ", $t); ?> </span>
     <br>
     <span>for <?php   $h= floor($diff/3600); echo $h; ?> hours <?php echo floor(($diff-($h*3600))/60); ?> minutes</span>
     <br>  
     <span style="color: rgba(0,0,0,0.01)">lol</span>
     </div>
   <div id='<?php  echo $i."d"; ?>' style="float: left; border: 0px solid white;margin-left: 20px;height: 80px;max-width: 74%;" 
                             onmouseover="document.getElementById('<?php  echo $i."d"; ?>').innerHTML = document.getElementById('<?php  echo $i; ?>').innerHTML;"
                             onmouseout="document.getElementById('<?php  echo $i."d"; ?>').innerHTML = document.getElementById('<?php  echo $i."t"; ?>').innerHTML;"  >
       <h1><?php echo $title; ?></h1>
   </div>
    <span id="<?php  echo $i; ?>" style="display:none;" ><span style="font-size: 1.2em;"><?php echo $des;  ?></span></span>
    <span id="<?php  echo $i. "t"; ?>" style="display:none;"><h1><?php echo $title; ?></h1></span>
</div>
<br><br><br><br><br><br>  
<!--END LOOP HERE    -->
    <?php  }} ?>
    </div>
<div id="request" style="display: none; color: white;">
</div>      
</div>
<div id="myModal" class="modal">    
<form method="post" action="">
    <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
<center><input id="title" type="text" value="" placeholder="TITLE OF THE EVENT..." name="title" maxlength="50" required ></center>
    </div>
    <div class="modal-body">    
        <center>
<!--    insert minimum date and time using php    -->
                <h2>STARTING DATE AND TIME</h2>
<b>DATE: </b> <input type="date" class="ac" id="startD" name="startD" min="<?php $k=strtotime("+330 Minutes"); echo date("Y-m-d", $k); ?>"  required>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <b>TIME: </b> <input type="time" class="ac" id="startT" name="startT"  required>
            <br><br>
                <h2>ENDING DATE AND TIME</h2> 
<b>DATE:  </b><input type="date" class="ac" id="endD" name="endD" min="<?php $k=strtotime("+330 Minutes"); echo date("Y-m-d", $k); ?>"                    required>
                 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <b>TIME:  </b><input type="time" class="ac" id="endT" name="endT"   required>
            <br><br><br>
            <textarea name="description" placeholder=" ADD A DESCRIPTION FOR THE EVENT " required></textarea>
            <br><br>  
        </center>
    </div>
    <div class="modal-footer">
      <input id="email" type="email" placeholder="SEND EMAIL TO AN INVITEE" name="email" maxlength="50" >
        <input id="submit" type="submit" name="submit" value=" SAVE ">
    </div>
</div>
</form>
</div>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "320px";
    document.getElementById("main").style.marginLeft = "320px";
    document.getElementById("main").style.zIndex = -1;
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
var modal = document.getElementById('myModal');// Get the modal
var btn = document.getElementById("add");// Get the button that opens the modal
var span = document.getElementsByClassName("close")[0];// Get the <span> element that closes the modal
btn.onclick = function() {
    modal.style.display = "block";// When the user clicks the button, open the modal 
    closeNav();
}
span.onclick = function() {
    modal.style.display = "none";// When the user clicks on <span> (x), close the modal
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none"; // When the user clicks anywhere outside of the modal, close it
    }
}
document.getElementById("invitation").addEventListener("click", function(){ch();});
document.getElementById("home").addEventListener("click", function(){cha();});
function ch(){
    document.getElementById("homeshow").style.display="none";
    document.getElementById("request").style.display="block";
    document.getElementById("home").style.borderBottom="0px";
    document.getElementById("invitation").style.borderBottom="2px solid white";
    show();
} 
function cha(){
    document.getElementById("homeshow").style.display="block";
    document.getElementById("request").style.display="none";
    document.getElementById("home").style.borderBottom="2px solid white";
    document.getElementById("invitation").style.borderBottom="0px";
} 
function startCountdown(){
    var action = setInterval(function(){show();}, 1000);
}
startCountdown();        
function show() {
    var str=document.getElementById("emai").value;
        if (window.XMLHttpRequest) {
            //  code for IE7+, Firefox, Chrome, Opera, Safari
          var  xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
          var  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("request").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","invite.php?q="+str, true);
        xmlhttp.send();
    }
</script>        
</body>    
</html>