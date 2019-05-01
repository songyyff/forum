<?php e_e();

$v_enkey="";
$v_enstr="";
$v_userpass="";
function f_encode($r){
global $v_enkey,$v_enstr;
$v_enstr="";
$v_enkey="";
for($i=0,$l=strlen($r);$i<$l;$i++){
$c=$r[$i];
$k=rand(0,255);
$e=ord($c)+$k;
$e=$e>255?$e-255:$e;
$v_enkey.=sprintf("%02X",$k);
$v_enstr.=sprintf("%02X",$e);
}}
function f_decode($r,$k){
$l=strlen($r);
if($l==strlen($k)){
for($i=0;$i<$l;$i+=2){
$s=base_convert(substr($r,$i,2),16,10)-base_convert(substr($k,$i,2),16,10);
$d.=chr($s+($s>0?0:255));
}
return $d;
}else return "";}

function f_login($uname,$upass,$d){global$_S,$v_ontlen,$v_postpt,$_alias,$_host,$_port,$_super,$_pass,$_db,$pass;

$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$stmt=$mysqli->prepare("select t1.id,name,stat,pass,pkey,level,rdnum,rigt,isize,rsize,newt,ltime,t2.info,(select count(*)from tspu where tspu.uid=t1.id) as c
from tuser as t1 left join tdict as t2 on t2.type=4 and t1.styl=t2.key1 where t1.name=?");
$stmt->bind_param('s',$U=str_replace("<","&lt;",f_delsla($uname)));
$stmt->execute();
$stmt->bind_result($id,$name,$stat,$pass,$pkey,$level,$rdnum,$rigt,$isize,$rsize,$newt,$ltime,$info,$c);
$stmt->fetch();
if($id){
if($stat!='E')f_toerror("userdisabled");
if($d?$pass==$upass:f_decode($pass,$pkey)==f_delsla($upass)){
//登陆成功
$_S["seuserid"]=$id;
$_S["seusername"]=$name;
$_S["seuserpass"]=$pass;
$_S["selevel"]=$level;
$_S["serdright"]=$rdnum;
$_S["seright"]=(int)$rigt;
$_S["seitsize"]=$isize;
$_S["serpsize"]=$rsize;
$_S["senew"]=$newt;
$_S["selastpost"]=time()-$v_postpt;
$_S['sestyle']=$info;
$_S["seismng"]=$c;
$q="update tuser set ip=\"".f_rpspc($_SERVER['REMOTE_ADDR'])."\"";
if((strtotime($ltime)+$v_ontlen*60)<time()){
$q.=",ltime=\"".date("Y-m-d H:i:s",time())."\",ontime=ontime+$v_ontlen";
$_S["seltime"]=time()+$v_ontlen*60;
}else $_S["seltime"]=strtotime($ltime);
$q.=" where id=$id";
mysql_query($q) or die(f_e($q));
$logined=1;
}
}
return $logined;}