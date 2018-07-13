<?php
session_start();
$db = mysqli_connect("localhost:3306", "paranjoy_task3i", "?,a!rM?*jg~W", "paranjoy_task3");
$email = $_SESSION['email'];
$sql = "SELECT * FROM project_users WHERE email='$email'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$f = $row['first'];
$l = $row['last'];
$n =" ".$f." ".$l;
$id = $row['id'];
if(isset($_POST['submit'])){
     $url = $_POST['value'];
     $k=strtotime("+330 Minutes");
     $sql = "INSERT INTO `project_users_details` (`id`, `uid`, `image`, `time`) VALUES (NULL, '$id', '$url', '$k')";
     mysqli_query($db, $sql);
}
$sql="SELECT * FROM `project_users_details` WHERE uid='$id' ORDER BY time DESC";
$result = mysqli_query($db, $sql);
 $counter = 0;
 $counter = mysqli_num_rows($result);
?>



<!DOCTYPE html>
<html>
    <head>
        <title> PAINT </title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body> 
                <a href="redirect.php"><button id="lg" title="hope you come back soon"  > LOGOUT </button></a>
                <span style="position: fixed; top: 10px;right: 20px;">YOU ARE LOGGED IN AS
                <span style="color: orangered; font-size:1.3em; cursor: pointer;"><?php echo $n; ?></span>
                </span>
                <a><span style="position: fixed; top: 52px;right: 290px; font-size:1.5em; cursor: pointer; border-bottom: 2px solid dodgerblue; color: #286090; font-weight: 300;" id="1" title="back to drawing area"> HOME </span></a>
                <a><span style="position: fixed; top: 52px;right: 140px; font-size:1.2em; cursor: pointer; border-bottom: 0px solid dodgerblue; color: #286090; font-weight: 300;" id="2" title="My previous drawings" > DRAWINGS </span></a>
        
        
        <div id="draw">
        <div class="colorandwidth" style="position: absolute; left:10px; top:10px;  ">
            <div >
                 <span style="float: left; margin-right: 5px; font-size: 1.3em; font-weight: bolder"> COLOUR : &nbsp;&nbsp;</span>
                <input type="color" list id="color">&nbsp;&nbsp; 
                <div id="circle" style="float: left; margin-left: 20px; position: absolute; top: 12px; left: 190px "></div>
            </div>
           <div style="float: left">
               <span style="font-size: 1.23em; font-weight: bold"> BRUSH size : &nbsp;&nbsp;</span>
               <input type="range" min="2" max="32" value="2" class="slider" id="myRange" style="width:120px"> 
           </div>
            <br>     
            <br>
<!--            <div id="dd">7</div>-->
            <u><span id="using">PENCIL IN USE</span></u>
        </div>
        <div style="width:35px;height:34px;border: 1px solid red;position:absolute;top:100px;background:red; cursor: pointer;" id="pencil" title="pencil">
        <img src="pencil.png">
        </div>
        <div style="width: 35px; height: 34px; border: 1px solid red; position: absolute; top: 100px; left: 70px; cursor: pointer" id="eraser" title="eraser">
        <img src="eraser.png" >
        </div>
        <div style="width: 36px; height: 35px; border: 1px solid red; position: absolute; top: 100px; left: 132px; cursor: pointer" id="letter" title="text">
        <img src="letter.png" >
        </div>
        <div style="width: 32px; height: 32px; border: 1px solid white; position: absolute; top: 300px; cursor: pointer; padding: 4px 4px 4px 4px;" id="oval" title="draw circle">
        <img src="circle.png" >
        </div>
        <input type="number" placeholder="RADIUS" id="draw_circle"  style="position: absolute; left: 98px; height:20px ; width: 70px; top: 302px; display: none" min="15" max="300" value="15" title="enter radius" >
        <div style="width: 32px; height: 32px; border: 1px solid white; position: absolute; top: 350px; cursor: pointer; padding: 4px 4px 4px 4px;" id="line" title="draw lines">
        <img src="drawing.png" >
        </div>
        <div id="text" style="width:250PX;  position: absolute; top: 150px;left:50px; border: 0px solid black; display: none;">
        <input type="number" min="8" max="72" value="8" style="width: 45px; height: 23px; float: left; margin-left: 40px" id="number" >
        <select id="select" style="float: left; margin-left: 20px; width: 120px; height: 30px">
                <option value="Arial">Arial</option>
                <option value="Arial Black">Arial Black</option>
                <option value="Book Antiqua">Book Antiqua</option>
                <option value="Courier New">Courier New</option>
                <option value="Georgia">Georgia</option>
                <option value="Helvetica">Helvetica</option>
                <option value="Impact">Impact</option>
                <option value="initial">initial</option>
                <option value="Lucida Console">Lucida Console</option>
                <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
                <option value="Palatino Linotype">Palatino Linotype</option>
                <option value="Tahoma">Tahoma</option>
                <option value="Times New Roman">Times New Roman </option>
                <option value="Verdana">Verdana</option>
            </select>
            <br><br>
            <input type="text" placeholder="type your text here" id="text_input" style="width: 230px; height: 25px; margin: 1px auto;">
            <br>
           <SPAN style="font-size:0.7em; ">CLICK ON DRAWING AREA TO DISPLAY TEXT </SPAN>
        
        </div>
        <br><br><br><br>
        
        <div id="canvasarea" style="height:480px;width: 940px; border: 4px dotted black; cursor: crosshair; background: white;
            margin: 10px; margin-left: 300px;"> 
        <canvas id="canvas"  width="940px" height="480px"></canvas>
        </div>
        <button id="reset"> CLEAR ALL </button>
        <button id="undo"> UNDO </button>
            
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="submit" name="submit" id="share" value="SAVE" title="SAVE my drawing" >    
        <input type="text" name="value" id="sharepost" style="display: none;">
        </form>
        </div>
        
        <div id="previous" style="display: none;">
            <?php 
            
       if(mysqli_num_rows($result)>0){
           //$i = 990;
           while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){ 
                  $tt=$row['time'];
                  $img=$row['image']; 
                  $idd=$row['id'];
                  //$i = $i + 1;
            ?>
        <div style="height:480px; width: 940px; border: 4px dotted black; background: white;
            margin-top: 80px; margin-left: 8px; display: block;"> 
            <img src="<?php echo $img; ?>" width="940px" height="480px"> 
        </div>
            <?php    echo "&nbsp;&nbsp;created &nbsp; ".date("d M Y,  g:i:s  a",$tt)."<br>";  ?>
       
       <?php }}       ?>
            
        </div>

         
    <script>
        
        document.getElementById("2").onclick = function(){
         document.getElementById("draw").style.display="none";
         document.getElementById("previous").style.display="block";
         document.getElementById("2").style.borderBottom="2px solid dodgerblue";
         document.getElementById("1").style.borderBottom="0px solid dodgerblue";
         document.getElementById("2").style.fontSize="1.5em";
         document.getElementById("1").style.fontSize="1.2em";    
            
        }
        document.getElementById("1").onclick = function(){
         document.getElementById("draw").style.display="block";
         document.getElementById("previous").style.display="none";
         document.getElementById("2").style.borderBottom="0px solid dodgerblue";
         document.getElementById("1").style.borderBottom="2px solid dodgerblue";
         document.getElementById("1").style.fontSize="1.5em";
         document.getElementById("2").style.fontSize="1.2em";     
        }
        
        
        var line=1;
        var src = [];
        var c1 = -1;
        var j = 0;
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var container = document.getElementById("canvasarea");
        var mouse = {x: 0, y: 0};//mouse_position
        var paint = false;
        var mode = "paint"; var mode_e = "paint";
        ctx.lineWidth = 2;
        ctx.lineJoin = "round";
        ctx.lineCap = "round";
        
        document.getElementById("color").onchange=function(){
//            window.alert(document.getElementById("color").value);
        document.getElementById("circle").style.background = document.getElementById("color").value;   
        };
        var slider = document.getElementById("myRange");
//        var output = document.getElementById("dd");
//        output.innerHTML = slider.value;
        slider.oninput = function() {
//        output.innerHTML = this.value;
        var c = 13 - (this.value/2);
        document.getElementById("circle").style.width=this.value+"px"; 
        document.getElementById("circle").style.height=this.value+"px"; 
        document.getElementById("circle").style.top=c+"px"; 
        ctx.lineWidth = this.value;
        line=1;    
        }
        var p=1;
        var x; var y;
        container.addEventListener("mousedown", function(e){//click inside canvasarea
        paint=true;
        mouse.x = e.pageX - this.offsetLeft;
        mouse.y = e.pageY - this.offsetTop;
        if(mode == "paint" || mode == "erase"){
        ctx.beginPath();    
        ctx.moveTo(mouse.x, mouse.y);   
        src[c1++] = canvas.toDataURL();
        j=0;    
        ctx.lineTo(mouse.x, mouse.y);
        ctx.stroke();
        line=1;}
        else if(mode == "text"){
             var txt = document.getElementById("text_input").value;
             var num = document.getElementById("number").value;
             var sty = document.getElementById("select").value;
             ctx.font = num+"px "+ sty;
             ctx.fillStyle = document.getElementById("color").value;
             src[c1++] = canvas.toDataURL();
             j=0;
             ctx.fillText(txt, mouse.x, mouse.y);
            line=1;
        }
        else if(mode == "line"){
             src[c1++] = canvas.toDataURL();
             j=0;
             if(line == 1){ 
             ctx.beginPath();
             ctx.moveTo(mouse.x, mouse.y);          
             line=2;
             }
             ctx.lineWidth = slider.value;
             ctx.strokeStyle = document.getElementById("color").value;
             ctx.lineTo(mouse.x, mouse.y);
             ctx.stroke();
             ctx.moveTo(mouse.x, mouse.y);
             x=mouse.x;
             y= mouse.y;
        }  
        else if(mode == "circle"){
            src[c1++] = canvas.toDataURL();
            j=0;
            var r=document.getElementById("draw_circle").value;
            ctx.lineWidth = slider.value;
            ctx.strokeStyle = document.getElementById("color").value;
            ctx.beginPath();
            ctx.arc(mouse.x,mouse.y,r,0,2*Math.PI);
            ctx.stroke();
            line=1;
        }
            
        } );
        container.addEventListener("mousemove", function(e){//move the mouse while holding mouse key
        mouse.x = e.pageX - this.offsetLeft;
        mouse.y = e.pageY - this.offsetTop;
        if(paint == true && p==1){
            if(mode == "paint"){   
                ctx.strokeStyle = document.getElementById("color").value;
                ctx.lineTo(mouse.x, mouse.y);
                ctx.stroke();
            }else if(mode == "erase"){
                ctx.strokeStyle = "white";
                ctx.lineTo(mouse.x, mouse.y);
                ctx.stroke();
            }
        }        
    });
    container.addEventListener("mouseup",function(){
        //mouse up->we are not drawing or erasing anymore
        paint = false;
        document.getElementById("sharepost").value = canvas.toDataURL();
    });
              
    document.getElementById("reset").onclick = function(){
             ctx.clearRect(0, 0, canvas.width, canvas.height);
             c1=-1;
             line=1;
    };
    document.getElementById("undo").onclick = function(){
              if(c1 - 2 >= -2){
//              window.alert("holla");
              ctx.clearRect(0, 0, canvas.width, canvas.height); 
              var img = new Image();
              img.onload = function(){
              ctx.drawImage(img, 0, 0);   
              }
              if(j == 0){
              img.src = src[c1-1];}
              c1 = c1 - 1;
              }
        line=1;
        document.getElementById("sharepost").value = canvas.toDataURL();
    }; 
    document.getElementById("letter").onclick = function(){
        var line=1;
        if(mode != "text"){
            mode = "text";
            document.getElementById("draw_circle").style.display="none";
            document.getElementById("oval").style.backgroundColor="";
            document.getElementById("pencil").style.backgroundColor="";
            document.getElementById("eraser").style.backgroundColor="";
            document.getElementById("letter").style.backgroundColor="red";
            document.getElementById("line").style.backgroundColor="";
            document.getElementById("text").style.display="block";
            document.getElementById("using").innerHTML="TEXT IN USE";
        }
        else{
            mode = "";
            document.getElementById("draw_circle").style.display="none";
            document.getElementById("oval").style.backgroundColor="";
            document.getElementById("pencil").style.backgroundColor="";
            document.getElementById("eraser").style.backgroundColor="";
            document.getElementById("letter").style.backgroundColor="";
            document.getElementById("line").style.backgroundColor="";
            document.getElementById("text").style.display="none";
            document.getElementById("using").innerHTML="SELECT A DRAWING TOOL";
            }   
    };        
    document.getElementById("line").onclick = function(){
     line=1;
        if(mode != "line"){
            mode = "line";
            line =1;
            document.getElementById("draw_circle").style.display="none";
            document.getElementById("oval").style.backgroundColor="";
            document.getElementById("pencil").style.backgroundColor="";
            document.getElementById("eraser").style.backgroundColor="";
            document.getElementById("letter").style.backgroundColor="";
            document.getElementById("text").style.display="none";
            document.getElementById("line").style.backgroundColor="white";
            document.getElementById("using").innerHTML="LINE IN USE";
        }
        else{
            mode = "";
            document.getElementById("draw_circle").style.display="none";
            document.getElementById("oval").style.backgroundColor="";
            document.getElementById("pencil").style.backgroundColor="";
            document.getElementById("eraser").style.backgroundColor="";
            document.getElementById("letter").style.backgroundColor="";
            document.getElementById("text").style.display="none";
            document.getElementById("line").style.backgroundColor="";
            document.getElementById("text").style.display="none";
            document.getElementById("using").innerHTML="SELECT A DRAWING TOOL";
            }   
    };
    document.getElementById("eraser").onclick = function(){
        var line=1;
        if(mode != "erase")
            {
                document.getElementById("eraser").style.backgroundColor="red";
                document.getElementById("draw_circle").style.display="none";
                document.getElementById("line").style.backgroundColor="";
                document.getElementById("pencil").style.backgroundColor="";
                document.getElementById("letter").style.backgroundColor="";
                document.getElementById("oval").style.backgroundColor="";
                document.getElementById("text").style.display="none";
                document.getElementById("using").innerHTML="ERASER IN USE";
                mode = "erase";
                p=1;
            }
        else{
                document.getElementById("eraser").style.backgroundColor="";
                mode = "";
                paint = false;
                document.getElementById("using").innerHTML="SELECT A DRAWING TOOL";
                p= -1;
        }
    }; 
        document.getElementById("pencil").onclick = function(){
            var line=1;
            if(mode == "paint")
            {
                document.getElementById("pencil").style.backgroundColor="";
                mode = "";
                paint = false;
                p= -1;
                document.getElementById("using").innerHTML="SELECT A DRAWING TOOL";
            }
        else{
                document.getElementById("draw_circle").style.display="none";
                document.getElementById("pencil").style.backgroundColor="red";
                document.getElementById("eraser").style.backgroundColor="";
                document.getElementById("letter").style.backgroundColor="";
                document.getElementById("oval").style.backgroundColor="";
                document.getElementById("line").style.backgroundColor="";
                document.getElementById("text").style.display="none";
                mode = "paint";
                p=1;
                document.getElementById("using").innerHTML="PENCIL IN USE";
            }
    };
    document.getElementById("oval").onclick = function(){
           var line=1;
        if(mode != "circle"){
            mode = "circle";
            line =1;
            document.getElementById("draw_circle").style.display="block";
            document.getElementById("pencil").style.backgroundColor="";
            document.getElementById("eraser").style.backgroundColor="";
            document.getElementById("letter").style.backgroundColor="";
            document.getElementById("text").style.display="none";
            document.getElementById("line").style.backgroundColor="";
            document.getElementById("oval").style.backgroundColor="white";
            document.getElementById("using").innerHTML="CIRCLE IN USE";
        }
        else{
            mode = "";
            document.getElementById("draw_circle").style.display="none";
            document.getElementById("pencil").style.backgroundColor="";
            document.getElementById("eraser").style.backgroundColor="";
            document.getElementById("letter").style.backgroundColor="";
            document.getElementById("text").style.display="none";
            document.getElementById("line").style.backgroundColor="";
            document.getElementById("oval").style.backgroundColor="";
            document.getElementById("text").style.display="none";
            document.getElementById("using").innerHTML="SELECT A DRAWING TOOL";
            }   
    };
    </script>
    </body>
</html>
        