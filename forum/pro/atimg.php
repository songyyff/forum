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

$q="select a.realname as rn,a.type as t,r.stat as rs,r.uid as ru,r.rigt as rr,i.stat as iss,i.rdnum as ird,i.rigt as ir,i.uid as iu,g.stat as gs,g.level as gl,g.rigt as gr,s.rigt as spr,u.rigt as ur,u.level as ul,u.rdnum as urd
from trsc as a
left join trpl as r on a.rid=r.id
left join titem as i on if(a.iid>0,a.iid,r.iid)=i.id
left join tgup as g on i.gid=g.id
left join tspu as s on i.gid=s.gid and s.uid=$uid
left join tuser as u on u.id=$uid
where a.id=$adid";

$rs=mysql_query($q) or die(f_e($q));
if(mysql_num_rows($rs)){$z=mysql_fetch_object($rs);mysql_free_result($rs);}else r("");
if(substr($z->t,0,5)!="image")r("t");

//right
$eg=$right_saved['guestview'];
$eu=$right_saved['userview'];
$es=$right_saved['usershow']|$right_saved['supershow'];
$ev=$right_saved['superview'];
//replay
$u=(int)($z->ru?$z->ru:$z->iu);
$rs=$z->rs?$z->rs:'E';
$rr=($z->ru?(int)$z->rr:0xffffffff)|$eg|$eu;
//item
$is=$z->iss;
$ird=(int)$z->ird;
$ir=(int)$z->ir;
//if($z->ru)$ir|=$es;
//group
$gs=$z->gs;
$gl=(int)$z->gl;
$gr=(int)$z->gr;
//superuser
$sr=(int)$z->spr;
//user
$ul=$uid?(int)$z->ul:1;
$ud=$uid?(int)$z->urd:0;
$ur=$uid?(int)$z->ur:$eu;
//mix
$r=$rr&$ir&($gr|$es);

//check right
if($ur&$eu&&
// normal user or guest
(($rs=='E'&&$is=='E'&&$gs=='E'&&$gl<=$ul&&$ird<=$ud&&($r&$es)==$es&&($r&($uid?$eu:$eg)))||
// is supseruser
$sr&$ev||
// is picture own
$u==$uid)
)w($z);else r("r");

?>