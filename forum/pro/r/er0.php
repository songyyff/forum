<?php
e_e();

$q="select g.*,
u.rigt as ur,u.stat as us,u.level as ul,u.irgt
".($M?",(select rigt from tspu where uid=$uid and gid=$sid) as sr":"")."
from tgup as g
left join tuser as u on u.id=$uid
where g.id=$sid";

$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);
mysql_free_result($R);

if(!(

$r->stat=='E'&&$r->us=='E'
&&
$right_saved['usernew']&$r->ur&$r->rigt
&&
$r->level<=$r->ul
||
$M&&$right_saved['supernew']&$r->sr

))$i=norightnewitem;