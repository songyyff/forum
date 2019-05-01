<?php

e_e();

?>

<div class=O>论坛徽章</div>

<table width=100% id=mrt class=b style=border-top:0;border-bottom:0;table-layout:fixed cellpadding=5 cellspacing=0>
<tr><th width=150>徽章<th>说明
<?php

$q="select * from bgs use index(us) where uid=0 order by s";
$R=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($R))echo"<tr><td><img onmouseover=im(this) onmouseout=io(this) src=../icons/bg/$r->bg.gif><td><pre>$r->n
$r->q";
$R=mysql_free_result($R);

?>
</table>

<div class=O>论坛徽章</div>

<script src=js/r/con3.js language=javascript></script>