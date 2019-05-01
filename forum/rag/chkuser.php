<?php include "../func/mustfunc.php"; ?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<script language=JavaScript>
parent.cnI.innerHTML="<?php
$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno())echo"Connect failed: %s\n", mysqli_connect_error();else{
$stmt=$mysqli->prepare("select id from tuser where name=?");
$stmt->bind_param('s',$N=str_replace("<","&lt;",$_R[username]));
$stmt->execute();
$stmt->store_result();
echo f_slquot($N),$stmt->num_rows?"<font class=warningc> 已经被":" 可以","使用";}
?>."
</script>