<?php

e_e();

$q="select r.*,
u.rigt as ur,u.stat as us,u.level as ul,u.rdnum as urd,
i.rigt as ir,i.stat as ist,i.rdnum as ird,i.uid as iu,
iu.rigt as iur,iu.stat as ius,
g.rigt as gr,g.level as gl,g.stat as gs"
.(($ism=$_SESSION['seismng'])?",(select s.rigt from tspu as s use index(unind) where s.uid=u.id and i.gid=s.gid)as sr":"").
($i<0?"":",d.info,d.info2").
(($rd=(int)$_REQUEST['rid'])?",(select realname from trsc where id=$rd)":"")."
from trpl as r
left join titem as i on r.iid=i.id
left join tgup as g on i.gid=g.id
left join tuser as u on r.uid=u.id
left join tuser as iu on i.uid=iu.id
".($i<0?"":"left join tdict as d use index(k2) on d.type=10 and d.key2='$e_'")."
where r.id=$id";

$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);
mysql_free_result($R);

if(

$r->id&&$r->stat=='E'&&$r->rigt&$right_saved['usermodify']
&&
$r->uid==$_SESSION['seuserid']&&$r->us=='E'&&$r->ur&$right_saved['usermodify']&&$r->ul>=$r->gl&&($r->urd>=$r->ird||$r->uid==$r->iu)
&&
$r->ist=='E'
&&
$r->gs=='E'&&$r->gr&$right_saved['usermodify']
||
$ism&&$r->sr&$right_saved['supermodify']

){