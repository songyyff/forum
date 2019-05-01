<?php
/*
mybgs.php
用户管理徽章
*/

e_e();

if($_R['bgsort']){ // resort bg
$l=count($a=explode(" ,",$_R['bgsort']));$d=0;
//$l-=$a[$l-1]?0:1;
for($i=1;$i<$l;$i++)if($i!=$c=(int)$a[$i]){$q="update bgs set s=-$i where uid=$id and s=$c";mysql_query($q) or die(f_e($q));$d=1;}
if($d){$q="update bgs set s=-s where uid=$id and s<0";mysql_query($q) or die(f_e($q));}
}else if($_R[resbgs]){ // ini sort
$q="select id,s from bgs use index(us) where uid=$id and order by s";
$rs=mysql_query($q) or die(f_e($q));
for($i=1;$r=mysql_fetch_object($rs);$i++)if($r->s!=$i){$q="update bgs set s=$i where id=$r->id";mysql_query($q) or die(f_e($q));}
mysql_free_result($rs);
}

if($N=count($A=&$_R[altbg])){
$C=&$_R[bgcom];
$R=&$_R[bgright];
$mysqli = new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$stmt=$mysqli->prepare("update bgs set a=?,r=r&254|? where id=?");
$stmt->bind_param('sdd',$S,$r,$ii);
for($i=0;$i<$N;$i++){
ckstr(f_delsla($C[$i]),$S,3000);
if(!$E&&$ii=(int)$A[$i]){$r=$R[$i]?1:0;$stmt->execute();}
}
}