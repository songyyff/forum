<?php
e_e();
$q="select id,name,pass,pkey from tuser where id=$ur->id";
$R=mysql_query($q) or die(f_e($q));
$pupass=f_delsla($_R['userpass']);
include"../func/login.php";
$r=mysql_fetch_object($R);
$plen=strlen($pupass);
$depass=f_decode($r->pass,$r->pkey);
if($depass==f_delsla($_R['oldpass'])&&strlen($Nm)>1&&(!$plen||$plen>5&&$plen<51)){
if($plen)f_encode($pupass);

$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$stmt=$mysqli->prepare("update tuser set name=?".($plen?", pass=\"$v_enstr\",pkey=\"$v_enkey\"":"")." where id=$ur->id");
$stmt->bind_param('s',$Nm);
$stmt->execute();

$_COOKIE['cousername']=$ur->name=$_S['seusername']=$Nm;
if($plen)$_COOKIE['couserpass']=$v_enstr;
}else $MSG.=($depass!=f_delsla($_R['oldpass'])?"原密码错误，无法修改":"新用户名或新密码长度不合法错误，无法修改")."<br>";