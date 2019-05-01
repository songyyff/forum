<?php
e_e();
if($resultmsg!="") echo "<table width=100% border=0 cellpadding=0 cellspacing=0><tr height=23 class=bar3><td>&nbsp;查询结果</td></tr><TR><TD class=bd1pd1><font class=warningc><b>错误</b></font><br>$resultmsg</td></TR></table>";
else{
	echo "<table width=100% class=bar3 border=1 cellpadding=0 cellspacing=0><tr height=23><td width=150>&nbsp;查询".($_REQUEST['norr']?"回复":"帖子")." 结果</td><td>&nbsp;</td><td width=150 align=right>查询用时 ".substr($endtime-$starttime,0,8)." 秒&nbsp;</td></tr></table>\n";
	if($len){
		echo "<table width=100% class=darkbar border=1 cellpadding=0 cellspacing=0><tr height=23><TD width=120>&nbsp;发表时间</td><td>标题".($_REQUEST['norr']?"":"&nbsp;[阅读权限]&nbsp;(访问/回复数)")."&nbsp;&#123;附件数&#125;&nbsp;[用户]</td><td width=200>论坛<td></tr></table>\n";
		for($i=0; $i<$len;$i++){ 
			$row=mysql_fetch_object($result);
			echo "<table width=100%  border=1 cellpadding=0 cellspacing=0>".
			"<tr height=23 class=lightbar><TD width=120>&nbsp;".f_date($row->ctime)."</td><td>".
			($_REQUEST['norr']?"<a class=itemlink href=\"../pro/view.php?noteid=$row->iid&page=".((int)($row->pos/$_SESSION['serpsize'])+1)."#site".($row->pos%$_SESSION['serpsize'])."\" target=_blank>$row->title</a>":"<a class=goldlink href=\"../pro/view.php?noteid=$row->id\">$row->title</a>").
			($_REQUEST['norr']?"":($row->rdnum?"&nbsp;[$row->rdnum]":"")."&nbsp;($row->vnum/$row->rnum)").
			($row->adnu?"&nbsp;&#123;$row->adnu&#125;":"").
			"&nbsp;<font class=darkfont>[<a class=goldlink href=\"userinfo.php?userid=$row->uid\">$row->uname</a>]</font></td>";
			echo "<td width=200><a class=goldlink href=\"../pro/list.php?groupid=$row->gid\" title=\"$row->gname ($row->ginum)\">$row->gname</a>&nbsp;($row->ginum)<td>".
			"</tr></table>\n";
			//内容
			echo "<table width=100% class=bd1  border=0 cellpadding=0 cellspacing=0><tr><td class=pd1>".
			"<table width=100% border=0 cellpadding=0 cellspacing=0>".
			"<tr height=23><td width=115>&nbsp;快照</td><td>".substr($row->content,0,200)." &nbsp;</td>".
			"<td width=30 align=center><font class=darkfont12>#$i</font></td></tr>".
			($_REQUEST['norr']?"":"<tr height=23><td width=115  class=bdt1>&nbsp;最近回复</td><td class=bdt1>".($row->luid?"<font class=darkfont>$row->ltitle [<a class=goldlink href=\"../pro/userinfo.php?userid=$row->luid\">$row->luser</a>]&nbsp;".f_date($row->ltime)."</font>":"&nbsp;")."</td><td class=bdt1>&nbsp;</td></tr>").
			"</table>".
			"</td></tr></table>\n";
		}
	} else echo "<table width=100% class=bd1><tr height=100><td align=center>--- 没有记录 ---</td></tr></table>";
	//echo "\n</td></tr></table>\n";
	mysql_free_result($result);
}
 if($len=count($_REQUEST['forums'])){
	echo "<script language=JavaScript>var subforums=new Array(";
	for($i=0;$i<$len;$i++) echo ($i?",":"").(int)$_REQUEST['forums'][$i];
	echo ");\nexpandsearch();\nsetsubforum();\n".
	"</script>\n";
}
?>