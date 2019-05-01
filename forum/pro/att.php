<?php include "../func/mustfunc.php";

//require"../debug/write_server_info.php";

set_time_limit(600);

$adid=$T=(int)$_R['id'];
if(!$T)$adid=(int)substr(($a=&$_SERVER[REDIRECT_URL])?$a:$_SERVER[HTTP_X_REWRITE_URL],strlen($_alias)+10);

function E($i){global$z,$adid;include"r/ae.php";}

$uid=$_S['seuserid'];

$mi=new mysqli($_host,$_super,$_pass,$_db,$_port);
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$mi->query("set names utf8");
$R=$mi->query("call z($adid,$uid)");
$mi->close();
if(!$z=mysqli_fetch_object($R))E(0);

if($x=$z->t[1]=="/"){$t=$z->t;$z->t=(($c=$z->t[0])=="i"?"image":($c=="v"?"video":"audio")).substr($z->t,1);}

$ul=$uid?$_S['selevel']:1;
$ud=$uid?$_S['serdright']:0;
if(!$z->ru)$z->rur=$z->rr=-1;

if(

($z->gs=='E'&&$z->gl<=$ul&&
$z->iss='E'&&($z->ad<=$ud||$z->iu==$uid)&&
$z->gr&$z->ir&$z->rr&$right_saved['userview']
&&
($uid?
$z->us=='E'&&$z->ur&$right_saved['userview']:
$z->gr&$z->ir&$z->rr&$right_saved['guestview'])
&&
($z->ru?
$z->rr&$right_saved['supershow']&&$z->rr&$right_saved['usershow']&&$z->rur&$right_saved['userstop']&&$z->rs=='E'||$z->ru==$uid:
$z->ir&$right_saved['supershow']&&$z->ir&$right_saved['usershow']&&$z->iur&$right_saved['userstop']||$z->iu==$uid))
||
($z->spr&$right_saved['superview'])
||
((0>$z->rid||0>$z->iid)&&$uid==$z->uu)

){
$fE=file_exists($f=$uploaddir."$z->p/$adid.$z->e");
if(isset($_SERVER['HTTP_RANGE']))include"r/rg.php";
if($fE){
$s=filesize($f);
header('HTTP/1.1 200 OK');
header("Content-Length: $s");
if($T||$t[0]!='i')header("Content-Disposition: attachment; filename=\"".str_replace('"',"&quot;",stripslashes($z->n))."\";");
if(!$x||$T){
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: binary');
}else{
header("Cache-Control: private, max-age=99999");
header("Content-Type: $z->t");
}
@readfile($f);
}else E(0);
}else E(1);