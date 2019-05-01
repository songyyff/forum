<?php e_e();

if(isset($_REQUEST['nomsgperson'])&&$e=$right_saved['usermsg']&$ur->rigt){	//有提交
$q="update tuser set nomsg=\".".f_rpspc($_REQUEST['nomsgperson'])."\" where id=$su->id";
mysql_query($q) or die(f_e($q));
}

?>

<div class=O>拒绝消息人</div>

<div class=blrp5 style='width:100%'>
<table width=100% cellpadding=5 cellspacing=0 ><tr><td width=200 valign=top> 您将拒绝此筐内的人向您发送任何消息，填写格式如下：<br><br>[所有][用户名][用户名]...<br><br>如果您填写了[所有]，那么除了管理员所有人都无法向您发送消息，请谨慎使用；[用户名]就是您想拒绝的用户，可以没有或多个；“[” 和 “]”号是必须的，用来识别不同的用户。<td><textarea class=txtmultie id=nomsgperson name="nomsgperson"><?php echo isset($_REQUEST['nomsgperson'])?$_REQUEST['nomsgperson']:substr($su->nomsg,1,strlen($su->nomsg)-1); ?></textarea>
<tr height=50><TD><td><input type="button" onclick="nomsg_submit()" value='<?php echo$e?"  提交  '":"  无权消息权  ' disabled";?>><input type=reset style='margin-left:40' value=" 重置 "></table>
</div>

<div class=O>拒绝消息人</div>

<script language="JavaScript" src="js/r/nomsg.js"></script>