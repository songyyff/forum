<?php

e_e();

$q="select r.*,
i.rigt as ir,i.stat as ist,i.rdnum as ird,i.uid as iuid,
g.rigt as gr,g.level as gl,g.stat as gs,g.name,g.pid,
u.rigt as ur,u.stat as us,u.level as ul,u.rdnum as urd
".($M?",(select rigt from tspu as s where s.uid=$uid and s.gid=i.gid) as sr":"")."
from trpl as r
left join titem as i on i.id=r.iid
left join tgup as g on g.id=i.gid
left join tuser as u on u.id=$uid
where r.id=$sid";

$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);
mysql_free_result($R);

$i=

$r->stat=='E'&&$r->us=='E'&&$r->gs=='E'&&$r->ist=='E'
&&
$right_saved['usermodify']&$r->ur&$r->rigt&$r->gr&$r->ir
&&
$r->ul>=$r->gl
&&
$r->uid==$uid
&&
($r->iuid==$uid||$r->ird<=$r->urd)
||
$M&&$right_saved['supermodify']&$r->sr

?0:"nomodifyitemright";