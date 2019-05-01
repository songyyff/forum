<div class=O>已发送消息</div>

<div class=blr>
<script src=js/mvw.js language=javascript></script>
<?php

e_e();

$q="select m.*,b.* from msg as m left join msgs as b on m.mid=b.bid where m.id=$_R[msgid]";
$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);

echo$r->uid==$su->id&&($right_saved['usermsg']&$su->rigt||$_S["seismng"])?"
<table width=100% cellpadding=5 cellspacing=0>
<tr><td width=70>接收人<td>$r->tos
<tr><td>发送时间<td>$r->time
<tr><td>标题<td>$r->til
<tr><td>内容<td><pre id=mpre>$r->body</pre>
</table>
":"<div style='padding:50 5'>消息不属于您或者您无消息权,无法查看.";
?>
</div>

<div class=O>已发送消息</div>