<?php
e_e();
if($resultmsg!="") echo "<table width=100% border=0 cellpadding=0 cellspacing=0><tr height=23 class=bar3><td>&nbsp;查询结果</td></tr><TR><TD class=bd1pd1><font class=warningc><b>错误</b></font><br>$resultmsg</td></TR></table>";
else{
	if($lens){
		$q="select * from tdict force index(typekey) where type in (6) order by type";
		$rs=mysql_query($q) or die(f_e($q));
		$s="";
		while($row=mysql_fetch_object($rs))$s.=($s?" ":"")."$row->info2.$row->info";
		mysql_free_result($rs);
		echo "<table width=100% class=bdb1 border=1 cellpadding=0 cellspacing=0><tr height=23 class=darkbar><TD width=120>&nbsp;发表时间</td><td>编号. &#123;附件数&#125; [用户] - (从属帖子)</td><td width=215>论坛<td><td width=30 align=right><a class=goldlink id=eprs href=\"javascript:exprows()\">[+]</a>&nbsp;</td></tr></table>\n".
		"<table width=100% class=bdb1 border=1 cellpadding=0 cellspacing=0><tr height=23 class=darkbar><TD width=120>&nbsp;状态</td><td>权限,$s,最后修改人/时间,最后管理人/时间</td></tr></table>\n";
		for($i=0;$i<$lens;$i++){
			$row=mysql_fetch_object($rsrows);
			echo "<table width=100%  border=1 cellpadding=0 cellspacing=0>".
			"<tr height=23 class=darkbar><TD width=120>&nbsp;".f_date($row->ctime)."</td>".
			"<td><a class=goldlink href=\"../pro/view.php?noteid=$row->iid&page=".((int)($row->pos/$_S['serpsize'])+1)."#site".($row->pos%$_S['serpsize'])."\" target=i$row->id>$row->id</a>. ".
			($row->adnu?" &#123;$row->adnu&#125;":"").
			" <font class=darkfont>[<a class=goldlink href=\"../pro/userinfo.php?userid=$row->uid\" target=u$row->uid>$row->uname</a>]</font> - (<a class=goldlink href=\"../pro/view.php?noteid=$row->iid\" target=i$row->iid>$row->ititle</a>)</td>".
			"<td width=190><a class=goldlink href=\"../pro/list.php?groupid=$row->gid\" target=g$row->gid title=\"$row->gname ($row->ginum)\">$row->gname</a>&nbsp;($row->ginum)<td>".
			"<td width=60 align=right><font class=darkfont12>#$i</font> <a class=goldlink id=li$i href=\"javascript:exprow($i)\">[+]</a>&nbsp;</td>".
			"</tr></table>\n";
			//内容, content
			$r=$row->rigt;
			echo "<div id=cdiv$i class=hdiv><table width=100% class=bd1  border=0 cellpadding=0 cellspacing=0><tr><td class=pd1>".
				"<table width=100% border=0 cellpadding=0 cellspacing=0>".
				"<tr height=23><td width=115>&nbsp;快照</td><td>",str_replace("<","&lt;",substr($row->content,0,300)),"&nbsp;</td>".
				"<td width=42 align=rigt>[<a class=goldlink href=\"javascript:addtomng($row->id)\">加管</a>]</td></tr>".
				"<tr height=23><td width=115 class=bdt1>&nbsp;状态</td>".
				"<td class=bdt1>".($r&$right_saved['guestview']?"1":"0").($r&$right_saved['userview']?"1":"0").($r&$right_saved['usershow']?"1":"0").($r&$right_saved['usermodify']?"1":"0").($r&$right_saved['supershow']?"1":"0").",$row->stat,$row->cuser/$row->lctm,$row->lmng/$row->lmtm</td>".
				"</tr></table></td></tr></table></div>\n";
		}
	} else echo "<table width=100% class=bd1><tr height=100><td align=center>--- 没有记录 ---</td></tr></table>";
	//echo "\n</td></tr></table>\n";
	mysql_free_result($rsrows);
	}
?>