<?php e_e();

$E=0;

if(($right_saved['usermsg']&$su->rigt||$_S["seismng"])&&$su->smnu<=$su->maxs){

function &sendmsg(){
global $i,$su,$r,$SD,$mid,$ref,$to,$SRM;
$U="[<a class=goldlink href=userinfo.php?userid=$r->id>$r->name</a>]";
if(!$_S['seismng']){
$q="select fid from tfrid where uid=$r->id and type=$r->msgt and fid in($su->id,0)";
$R=mysql_query($q) or die(f_e($q));
$R=mysql_num_rows($R);
$S=$r->msgt?($R?"用户 $U 拒绝了您的消息.":0):($R?0:"用户 $U 只接受朋友的消息.");
}
if(!$S)if($r->rmnu>=$r->maxr)$S="用户 $U 的消息箱已满，不能接收您的消息.";
else{
if(!$mid){
$q="insert into msgs(time)values(now())";
mysql_query($q) or die(f_e($q));
$mid=mysql_insert_id();
}
$q="insert into msg(uid,fid,mid)values($r->id,$su->id,$mid)";
mysql_query($q) or die(f_e($q));
$ref++;
$to.="<a href=userinfo.php?userid=$r->id>$r->name</a> ";
$q="update tuser set nmnu=nmnu+1, rmnu=rmnu+1 where id=$r->id";
mysql_query($q) or die(f_e($q));
}
if($S)$SRM.="<br>[$i].".$S;
}

if(strlen($NM)&&!$_R['isID']){
$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$stmt=$mysqli->prepare("select id from tuser where name=?");
$stmt->bind_param('s',$Nm);
$stmt->execute();
$stmt->bind_result($NM);
$stmt->fetch();
if(!$NM)$SRM.="用户 $Nm 不存在.";
}

$frds=strlen($NM)?$NM:"0";
$len=count($_R['friends']);
for($i=0; $i< $len; $i++) if(ctype_digit($_R['friends'][$i]))$frds.=",".$_R['friends'][$i];

$q="select * from tuser where id in($frds)";
$R=mysql_query($q) or die(f_e($q));
for($i=1;$r=mysql_fetch_object($R);$i++)sendmsg();

if($mid){

$q="insert into msg(type,uid,fid,mid) values(1,$su->id,0,$mid)";
mysql_query($q) or die(f_e($q));
$myid=mysql_insert_id();
$ref++;
$q="update tuser set smnu=smnu+1 where id=$su->id";
mysql_query($q) or die(f_e($q));
$su->smnu+=1;

$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$stmt=$mysqli->prepare("update msgs set tos=?,til=?,body=?,ref=$ref where bid=$mid");
$stmt->bind_param('sss',$to,$tlE,$coN);
$stmt->execute();

}

}else$SRM=$su->smnu<=$su->maxs?"[<a href=?type=1>已发送消息箱</a>] 已满,请清理后发送消息.":"您没有发送消息权。";

if(!$SRM&&$ref){@header("location: http://".$_SERVER['HTTP_HOST'].f_getsubpath()."pro/msgs.php?type=5&msgid=$myid");exit;}