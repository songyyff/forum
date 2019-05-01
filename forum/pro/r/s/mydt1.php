<?php
e_e();
$q="select id,name,pass,pkey from tuser where id=$ur->id";
$R=mysql_query($q) or die(f_e($q));
$puname= f_rpspc($_REQUEST['username']);
$pupass=f_delsla($_REQUEST['userpass']);
include "../func/login.php";
$r=mysql_fetch_object($R);
$plen=strlen($pupass);
$depass=f_decode($r->pass,$r->pkey);
if($depass==f_delsla($_REQUEST['oldpass'])&&strlen($puname)>1&&($plen==0||$plen>5)){
if($plen)f_encode($pupass);
$q="update tuser set name=\"$puname\"".($plen?", pass=\"$v_enstr\",pkey=\"$v_enkey\"":"")." where id=$ur->id";
mysql_query($q) or die(f_e($q));
//need change cookie,session,$ur
$_SESSION['seusername']=$puname;
$_COOKIE['cousername']=f_delsla($_REQUEST['username']);
if(strlen($pupass))$_COOKIE['couserpass']=$v_enstr;
$ur->name=$puname;
}else $Rmsg=($depass!=f_delsla($_REQUEST['oldpass'])?"原密码错误，无法修改":"新用户名或新密码长度不合法错误，无法修改")."<br>";
mysql_free_result($R);
?>