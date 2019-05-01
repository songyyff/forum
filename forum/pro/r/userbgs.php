<?php e_e();

$q="select b.*,u.name from bgs as b use index(ho) left join tuser as u on(b.mid=u.id) where b.uid=$U->id and b.r=0";
$rs=mysql_query($q) or die(f_e($q));
if(mysql_num_rows($rs)){
echo"<tr class=bgtr><TD class=bdt1>获得徽章<div id=ubgs style=width:1;height:1;overflow:scroll;>$_S[sestyle]";
while($r=mysql_fetch_object($rs))echo"<p>$r->mid,$r->bg,$r->t<p>$r->name<p>$r->n<p>$r->q<p>$r->a";
echo"<td class=bdt1><script src=js/r/userbg.js language=javascript></script>";
}
mysql_free_result($rs);
?>