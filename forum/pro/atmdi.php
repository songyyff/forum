<?php
include "../func/mustfunc.php";
function r($f){header("Location: ../images/no$f.gif");exit;}
if(!($adid=(int)$_REQUEST['id']))r("");
function w($i){
global $uploaddir;
$f=$uploaddir.$i->rn;
if(!file_exists($f))r("");
header("Content-type: $i->t");
readfile($f);
}

$uid=$_SESSION['seuserid'];
if(!$uid)r("r");

$q="select a.realname as rn,a.type as t,b.stat as rs,b.uid as ru,b.rigt as rr,c.stat as iss,c.rdnum as ird,c.rigt as ir,c.uid as iu,d.stat as gs,d.level as gl,d.rigt as gr,e.rigt as spr
from trsc as a
left join trpl as b on a.rid=b.id
left join titem as c on if(a.iid>0,a.iid,b.iid)=c.id
left join tgup as d on c.gid=d.id
left join tspu as e on c.gid=e.gid and e.uid=$uid where a.id=$adid";

$rs=mysql_query($q) or die(f_e($q));
if(mysql_num_rows($rs)){$z=mysql_fetch_object($rs);mysql_free_result($rs);}else r("");
if(($mt=substr($z->t,0,5))!="auido"&&$mt!="video")r("t");

//right
$eg=$right_saved['guestview'];
$eu=$right_saved['userview'];
$es=$right_saved['usershow']|$right_saved['supershow'];
$ev=$right_saved['superview'];
//replay
$u=(int)($z->ru?$z->ru:$z->iu);
$rs=$z->rs?$z->rs:'E';
$rr=(int)($z->ru?$z->rr:-1);
//item
$is=$z->iss;
$ird=(int)$z->ird;
$ir=(int)$z->ir;
if($z->rs)$ir|=$es;
//group
$gs=$z->gs;
$gl=(int)$z->gl;
$gr=(int)$z->gr;
//superuser
$sr=(int)$z->spr;
//user
$ul=$uid?$_SESSION['selevel']:1;
$ud=$uid?$_SESSION['serdright']:0;
$ur=$uid?$_SESSION['seright']:$eu;
//mix
$r=$rr&$ir&($gr|$es);
//check right
if($ur&$eu&&
// normal user or guest
(($rs=='E'&&$is=='E'&&$gs=='E'&&$gl>=$ul&&$ird>=$ud&&($r&$es)==$es&&($uid?$r&$eu:$r&$eg))||
// is supseruser
$sr&$ev||
// is picture own
$u==$uid)
)w($z);else r("r");
?>