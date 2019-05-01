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
		echo "<table width=100% class=bdb1 border=1 cellpadding=0 cellspacing=0><tr height=23 class=darkbar><TD width=150>&nbsp;注册时间</td><td width=100>编号</td><td width=150>用户名</td><td>状态,性别,等级,权限,贴/无效数,回复/无效数</td></tr>".
		"<tr height=23 class=darkbar><TD class=bdt1>&nbsp;描述</td><td class=bdt1 colspan=3>$states, $levels</td></tr></table>\n";
		echo "<table width=100% border=1 cellpadding=0 cellspacing=0>";
		for($i=0;$i<$lens;$i++){
			$row=mysql_fetch_object($rsrows);
			$r=$row->rigt;
			echo "<tr height=23 class=".($i&1?"dark":"light")."bar><TD width=150>&nbsp;$row->ctime</td><td width=100>$row->id</td>".
			"<td width=150><a class=goldlink href=\"../pro/userinfo.php?userid=$row->id\" target=u$row->id>$row->name</a></td><td>".($row->stat=='E'?"$row->stat":"<font class=warningc>$row->stat</font>")." , $row->sex , $row->level , ".
			($r&$right_saved['userview']?"1":"0").($r&$right_saved['usernew']?"1":"0").($r&$right_saved['userrpy']?"1":"0").($r&$right_saved['usermodify']?"1":"0").($r&$right_saved['uservote']?"1":"0").($r&$right_saved['usermsg']?"1":"0").($r&$right_saved['usershow']?"1":"0")." , $row->inum/$row->dnum , $row->rnum/$row->drnu</td>".
			"<td width=30><font class=darkfont12>#$i</font>&nbsp;</td>".
			"<td width=50>[<a class=goldlink href=\"javascript:addtomng($row->id)\">加管</a>]<td>".
			"</tr>\n";
		}
		echo "</table>";
	} else echo "<table width=100% class=bd1><tr height=100><td align=center>--- 没有记录 ---</td></tr></table>";
	//echo "\n</td></tr></table>\n";
	mysql_free_result($rsrows);
}
?>