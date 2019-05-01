<?php
e_e();

$q="select i.*,
g.rigt as gr,g.level as gl,g.stat as gs,g.name,g.pid,
u.rigt as ur,u.stat as us,u.level as ul
".($M?",(select rigt from tspu where uid=$uid and gid=i.gid) as sr":"")."
from titem as i
left join tgup as g on g.id=i.gid
left join tuser as u on u.id=$uid
where i.id=$sid";

$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);
mysql_free_result($R);

$i=

$r->stat=='E'&&$r->us=='E'&&$r->gs=='E'
&&
$right_saved['usermodify']&$r->ur&$r->rigt&$r->gr
&&
$r->ul>=$r->gl
&&
$r->uid==$uid
||
$M&&$right_saved['supermodify']&$r->sr

?0:"nomodifyitemright";