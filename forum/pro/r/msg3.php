<?php

e_e();

if($mr)include "r/rmsg.php";

?>

<div class=O>写消息</div>

<div class=blr>

<?php

if(($right_saved['usermsg']&$su->rigt||$_S[seismng])&&$su->smnu<=$su->maxs)echo"

<table id=mt width=100%",$mr?" style=table-layout:fixed":""," cellpadding=5 cellspacing=0>
	
<TR><TD width=70><TD>",$SRM?"<pre><b class=warningc>发送结果</b> $SRM":"","
<TR><TD>接收人<td><INPUT id=receiver TYPE=text NAME=receiver maxlength=20 value=\"",$fr?$fr->id:($E?"":str_replace('"',"&#34",$Nm)),"\"><input type=checkbox name=isID id=isID value=1 style='margin:2 2 0 9'",$fr||$_R[isID]?" checked":"",">用户ID<font id=uNm color=darkgray>",$fr?" 用户名: $fr->name":"","
<TR><TD>标题<TD><INPUT id=til TYPE=text style=width:100% maxlength=500 NAME=til value=\"",$mr?((isset($_R['userid'])?"":"回复 : ").str_replace('"',"&#34",$mr->til)):($E?"":str_replace('"',"&#34",$tlE)),"\">
<TR><td>内容<TD style='padding:0 5'><div style='padding:0 5 5 50' id=mIcons></div><pre id=EW contenteditable>",$E?"":$coN,"</pre>
<div id=Info style=margin:0>状态</div><textarea id=con name=con></textarea>
<TR><TD><td height=60><INPUT TYPE=button onclick=sendmsg() VALUE='      发送      ' default>

</table>
";
else echo"<p style='padding:60 5'>",$su->smnu<=$su->maxs?"您的 [<a href=?type=1>已发送消息箱</a>] 已满,请清理后发送消息.":"无权发送消息,可向管理员申请权利! ";

?>
</div>

<div class=O>写消息</div>

<script language=javascript><?php echo"countfriendnum=$FF;tTheme='$_S[sestyle]'";?></script>
<script language=javascript src=e/msg.js></script>
<script language=javascript src=js/r/msg3.js></script>