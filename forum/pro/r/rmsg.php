<script language=javascript>
document.write("<style>#oldmsg{width:"+(MIW=screen.width-(IE?310:320))+"}#oldmsg img{max-width:"+MIW+"px;behavior:url(../images/img.htc)}</style>")
</script>
<?php e_e();
echo"
<div class=O><tt class=fr>收到时间 $mr->time</tt>原消息</div>

<table width=100% style='table-layout:fixed' class=blr cellpadding=5 cellspacing=0 >
<tr><td width=70>",isset($_R['userid'])?"接收":"发送","人<td>",$mr->fid?"<a href='userinfo.php?userid=$fr->id'>$fr->name":$mr->tos,"
<tr><td>标题<td>$mr->til
<tr><td>内容<td><pre id=oldmsg>$mr->body</table>";