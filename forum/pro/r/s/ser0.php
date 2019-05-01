<?php

e_e();

function f_mtime(){list($u,$s)=explode(" ",microtime());return((float)$u+(float)$s);}

$umstr="";

if($l=count($_R['forums'])){


for($i=0;$i<$l;$i++)$umstr.=($i?",":"").(int)$_R['forums'][$i];

$X=(int)$_R[UT];
$u=(int)$_R[U];
$D=(int)$_R[id];
$M=f_rpspc($_R[T1]);
$Y=f_rpspc($_R[T2]);
$A=trim($_R[AN]);

$ix=$U?($A!=""?"uat":"ut"):($A!=""?"ati":($M?"ti":"i"));

if($X){
$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$stmt=$mysqli->prepare("select id from tuser use index(name) where name=?");
$stmt->bind_param('s',str_replace('<',"&lt;",$_R[U]));
$stmt->execute();
$stmt->bind_result($u);
$stmt->fetch();
}

$q="select ".(($T=$_R['RI'])?"r.id as rid,r.content as rcon,r.id as rid,r.iid,r.rigt as rr,r.uid as ruid,r.adnu as radnu,r.stat as rs,r.pos,r.uid as ruid,
ru.name as run,ru.rigt as rur,":"")."
i.*,
g.name as gn,g.rigt as gr,g.inum as ginu,g.level as gl,g.stat as gs,
u.name as un,u.rigt as ur
from ".
($T?"trpl as r":"titem as i")." use index(s$ix)".
($T?"left join titem as i on r.iid=i.id
left join tuser as ru on r.uid=ru.id":"")."
left join tgup as g on i.gid=g.id
left join tuser as u on u.id=i.uid
where ".($t=$T?"r":"i").".gid in($umstr) and {$t}.stat='E'".

($U?" and {$t}.uid=$u".($A!=""?" and {$t}.adnu=".(int)$A:"").($M?" and {$t}.ctime>=\"$M\"":"").($Y?" and {$t}.ctime<=\"$Y\"":"")
:(($a=$A!="")?" and {$t}.adnu=".(int)$A:"").($M?" and {$t}.ctime".($D?"":">")."=\"$M\"":"").($Y&&!$D?" and {$t}.ctime<=\"$Y\"":"").((!$a||$M)&&$D?" and {$t}.id>=".(int)$D:"")).
" limit 50";

$starttime=f_mtime();
$R=mysql_query($q) or die(f_e($q));
$endtime=f_mtime();
$len=mysql_num_rows($R);

}else $RM="没有选择任何查询目标论坛";

?>