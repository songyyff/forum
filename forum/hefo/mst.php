<?php e_e();

$q="select rmnu,smnu,dmnu,nmnu,maxr,maxd,maxs from tuser force index(PRIMARY) where id=$_S[seuserid]";
$rs=mysql_query($q) or die(f_e($q));
if($rs)$s=mysql_fetch_object($rs);
mysql_free_result($rs);
$_S["semsgt"]=time();
$_S["semsgs"]=($s->nmnu?"(<font class=lightfont>$s->nmnu</font>)":"").($_S['seuserid']&&($s->rmnu>=$s->maxr||$s->smnu>=$s->maxs||$s->dmnu>=$s->maxd)?"[过载]":"");