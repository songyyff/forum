<?php
function showwarning($u){
if($u->inmnu || $u->rmnu>=$u->maxr || $u->smnu>=$u->maxs || $u->dmnu>=$u->maxd){
echo "<table width=100% class=bd1 border=0 cellpadding=0 cellspacing=0><TR><TD class=pd1><font class=warningc><b>警告!</b></font><br>",
$u->inmnu?"您有 <b>$u->inmnu</b> 条新消息未入站，请删除 [收到消息箱] 内不需要的消息，才能接收新消息<br>":"",
$u->rmnu>=$u->maxr?"您的 [收到消息箱] 已满，最大容量为[<b>$u->maxr</b>]，请删除不需要的消息<br>":"",
$u->smnu>=$u->maxs?"您的 [已发送消息箱] 已满，最大容量为[<b>$u->maxs</b>]，请删除不需要的消息<br>":"",
$u->dmnu>=$u->maxd?"您的 [被删除消息箱] 已满，最大容量为[<b>$u->maxd</b>]，请删除不需要的消息":"",
"</td></TR></table>";
}
}
?>