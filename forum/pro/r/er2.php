<?php
e_e();

$q="select i.*,
g.rigt as gr,g.level as gl,g.stat as gs,g.name,g.pid,
u.rigt as ur,u.stat as us,u.level as ul,u.rdnum as urd,u.rrgt
".($M?",(select rigt from tspu where uid=$uid and gid=i.gid) as sr":"")."
from titem as i
left join tgup as g on g.id=i.gid
left join tuser as u on u.id=$uid
where i.id=$sid";

$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);
mysql_free_result($R);

if(!(

$r->stat=='E'&&$r->us=='E'&&$r->gs=='E'
&&
$right_saved['userrpy']&$r->ur&$r->rigt&$r->gr&&$right_saved['superrpy']&$r->rigt
&&
$r->ul>=$r->gl
&&
($r->uid==$uid||$r->rdnum<=$r->urd)
||
$M&&$right_saved['supernew']&$r->sr

))$i=norightnewreplay;