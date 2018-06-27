<?php   

$db = mysqli_connect("localhost:3306", "paranjoy_task3i", "?,a!rM?*jg~W", "paranjoy_task3");
$q = $_GET['q'];
$sql = "SELECT * FROM user_details WHERE invitee ='$q'"; 
$resul = mysqli_query($db, $sql);
 if(mysqli_num_rows($resul)>0){ 
           while($ar = mysqli_fetch_array($resul, MYSQL_ASSOC)){ 
               $titl = $ar['title'];
               $to = $ar['start'];
               $eo = $ar['end'];
               $dif = $eo - $to;
               $i = $ar["uid"];
            $sq = "SELECT * FROM users WHERE id ='$i'";
            $res = mysqli_query($db, $sq);
            $ro = mysqli_fetch_assoc($res);
            $f=strtoupper($ro['first']); $l= strtoupper($ro['last']);
?>
<div style="color: white;">
    <span style="font-size: 1.5em;">You have an invition from </span><span style="font-size: 1.7em;"><b><u><?php echo $f."  ".$l; ?></u></b></span>
     <br>
    <span> on  <span style="font-size: 1.3em;"><b><?php echo date("l", $to); ?> ,</b></span> <?php  echo date(" d", $to)."   ".date("F, ", $to)." ".date("Y ", $to);  ?> 
    <br>    
        duration  <span style="font-size: 1.2em;"> <?php   $h= floor($dif/3600); echo $h; ?> hours <?php echo floor(($dif-($h*3600))/60); ?> minutes</span>
    </span>
    <br>
    <span style="font-size: 1.3em;" >TITLE: </span><span style="font-size: 1.7em;"><?php echo "'".$titl."'"; ?></span>        
</div>
<br>
<br>
<?php }} 
else{ ?>
<div style="color: white; font-size: 2.3 em"> <center>YOU HAVE NO INVITATION</center> </div> 
<?php } ?>
