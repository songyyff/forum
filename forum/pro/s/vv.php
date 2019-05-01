<?php

/*
调查表提交内容 view.php
*/

e_e();

if($_REQUEST['suv']==$X->alts){
$l=count($a=&$_REQUEST['suvid']);
$iid=(int)$_REQUEST['noteid'];
$h="";
for($i=0;$i<$l;$i++){
if(!($n=count($c=&$_REQUEST['suvi'.$a[$i]])))break;
$s=join(',',$c);
$q="select count(*)as c,y.iid,y.id,y.min,y.max,y.time,y.peri,y.numi from suvi as i left join suvy as y on(i.sid=y.id)where i.id in($s) group by y.id";
$rs=mysql_query($q) or die(f_e($q));
if(!($r=mysql_fetch_object($rs))||$r->c!=$n||$r->iid!=$iid||(!$r->min&&$n>1))break;
if($r->peri&&(time()-strtotime($r->time))>$r->peri*86400)continue;
$q="select type from suvu where type=1 and ids=$r->id and uid=$uid";
$ra=mysql_query($q) or die(f_e($q));
if(!mysql_num_rows($ra)){
$q="update suvi set num=num+1 where id in($s)";
mysql_query($q) or die(f_e($q));
$q="update suvy set num=num+1,inu=inu+$n,imax=(select max(num) from suvi where sid=$r->id) where id=$r->id";
mysql_query($q) or die(f_e($q));
$h.=",(1,$r->id,$uid)";
for($k=0;$k<$n;$k++)$h.=",(0,{$c[$k]},$uid)";
}
mysql_free_result($ra);
mysql_free_result($rs);
}
if($h){
$h[0]=' ';
$q="insert suvu values$h";
mysql_query($q) or die(f_e($q));
}
}
?>