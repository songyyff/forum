<?php
function showmsgerror($errormsg){
echo "<table width=100% class=bar2 border=1 cellpadding=0 cellspacing=0><tr height=23><TD>&nbsp;消息： " .(int)$_REQUEST['id']."</td></tr></table><table width=100% class=bd1 border=1 cellpadding=0 cellspacing=0><tr><TD style=\"padding:5px\"><font class=warningc><b>警告!</b></font><br>$errormsg</td></tr></table>";
}
function showmsg($selectrow){
echo "<table width=100% class=bd1 border=0 cellpadding=0 cellspacing=0>".
"<tr height=23 class=bar2><TD width=150 align=center>$selectrow->stime</TD><td width=100>$selectrow->fname</td><td><b>$selectrow->title</b></td><td width=50><a class=whitelink href=\"msgs.php?type=3&".($selectrow->type=="0"?"msgid=$selectrow->id\">[回复]":($selectrow->type=="1"?"userid=$selectrow->fid\">[再发]":">[新消息]"))."</a></td></tr>".
"<tr><td colspan=3 height=200 valign=top style=\"padding:5px;\">$selectrow->msg</td></tr>".
"</table>";
}
e_e();
$query="select * from tmsg where id=" .(int)$_REQUEST['id'];
$result=mysql_query($query) or die(f_e($query));
if(mysql_num_rows($result)>0) {
	$selectrow=mysql_fetch_object($result);
	if($selectrow->uid==$_SESSION['seuserid']){
		if($row->isrd != "r"){
			$updatequery="update tmsg set isrd='r' where id=$selectrow->id";
			mysql_query($updatequery) or die(f_e($updatequery));
			if(!($row->type | $row->del)){
				$updatequery="update tuser set nmnu=nmnu-1 where id=".$_SESSION['seuserid'];
				mysql_query($updatequery) or die(f_e($updatequery));
			}
		}
		showmsg($selectrow);
	} else { //此消息不属于你
		showmsgerror("此消息不属于您，您无权查看");
	}
}else{//查无此消息
	showmsgerror("查无此消息");
}
mysql_free_result($result);
?>