<?php

e_e();

if($mr)include "r/rmsg.php";

?>

<div class=O>写消息</div>

<div class=blr style='width:100%'>
<table width=100%<?php if($mr)echo " style='table-layout:fixed'";?> cellpadding=5 cellspacing=0>
<TR><TD width=70><TD>&nbsp;<?php if(strlen($SRM))echo "<pre><b>发送结果</b>
$SRM
</pre>";
?><td rowspan=7 width=200 align=center valign=top class=rightplain>
<DIV class=O>表情</DIV>
<?php include "../rag/em.php"; ?>
<TR><TD>接收人<td><INPUT id=receivename TYPE=text NAME=receivename accesskey="T" <?php echo $fr?"value=\"$fr->name\"":"";?>><TR><TD>标题<TD><INPUT id=replaytitle TYPE=text NAME=newtitle  accesskey=T <?php if($mr)echo "value=\"",isset($_REQUEST['userid'])?"":"回复 : ","$mr->title\"";?>><TR><td valign=top>内容<TD><TEXTAREA id=replaycontent NAME=newcontent accesskey=C><?php 
echo isset($_REQUEST['userid'])?$mr->msg:($mr?"


--- [user]$fr->id,$fr->name[/user] $mr->stime 说 ---
".substr($mr->msg,0,200):"");
?></TEXTAREA><TR><TD><td><INPUT type="reset" VALUE="重置(R)" id=fr ACCESSKEY=R><INPUT TYPE=button onclick="smsg_sendmsg()" VALUE='<?php echo$right_saved['usermsg']&$ur->rigt?"    提交(S)    '":" 无权发送消息，可向管理员申请权利 ' disabled";?> ACCESSKEY=S><tr><td>&nbsp;</table>
</div>

<div class=O>写消息</div>

<script language="JavaScript">
var countfriendnum=<?php echo $FF;?>
</script>

<script language="JavaScript" src="js/r/sdmsg.js"></script>