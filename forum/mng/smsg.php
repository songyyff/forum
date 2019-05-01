<?php e_e(); //更新: 2008-6-27

function sendmsg($fromuser,$touser,$title,$body,$copy){
global$_host,$_port,$_super,$_pass,$_db;
if(!$touser->id){
$q="select id,name,rmnu,maxr from tuser where id=$touser";
$r1=mysql_query($q) or die(f_e($q));
$touser=mysql_fetch_object($r1);
mysql_free_result($r1);
if(!$touser->id) return 4;
}
$head="[管理员消息] ";
$bodyhead="";
$bodyend="";

$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n",mysqli_connect_error());die;}
$stmt=$mysqli->prepare("insert into msgs(tos,til,body,ref,time)values(?,?,?,".(($d=$copy&&$fromuser->smnu<=$fromuser->maxs)?2:1).",now())");
$stmt->bind_param('sss',$to="<a href=userinfo.php?userid=$fromuser->id>$fromuser->name",$t=$head.$title,$b="  $bodyhead$body$bodyend  ");
$stmt->execute();

$q="insert into msg(uid,fid,mid,type)values($touser->id,$fromuser->id,$mysqli->insert_id,0)".($d?",($fromuser->id,0,$mysqli->insert_id,1)":"");
mysql_query($q) or die(f_e($q));
$q="update tuser set nmnu=nmnu+1,rmnu=rmnu+1 where id=$touser->id";
mysql_query($q) or die(f_e($q));
if($d){$q="update tuser set smnu=smnu+1 where id=$fromuser->id";mysql_query($q) or die(f_e($q));}
}