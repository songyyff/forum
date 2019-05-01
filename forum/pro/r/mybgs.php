<?php e_e();
if($_REQUEST[sortgb]||$_REQUEST[altbg])include"s/bg.php";?>

<div id=o>获得徽章</div>

<div id=bgData style=visibility:hidden;width:100;height:100;overflow:scroll;position:absolute;top:0;><?php
$q="select b.*,u.name from bgs as b left join tuser as u on(b.mid=u.id) where b.uid=$ur->id order by b.s";
$rs=mysql_query($q) or die(f_e($q));
$n=mysql_num_rows($rs);
while($r=mysql_fetch_object($rs))echo"<p>$r->id,$r->s,$r->r,$r->mid,$r->bg<p>$r->name<p>$r->n<p>$r->q<p>$r->a";
mysql_free_result($rs);
?></div>
<table width=100% id=mrt class=b style=table-layout:fixed cellpadding=5 cellspacing=0><tr id=bgcon><th width=30><?php echo $n>1?"<input type=checkbox name=sortgb value=1 onclick=bg_sort(this)>":"";?><th width=40>徽章<th width=110><th>说明</table>

<script src="js/r/mybg.js" language=javascript></script>