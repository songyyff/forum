<?php e_e(); ?>
<table width="100%" class="bar3" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD>&nbsp;查找条件</td>
<td width=29><a id=issearch class=whitelink href="javascript:expandsearch()">[-]</a></td>
</tr>
</table>
<div id=searchdiv style="overflow:hidden;">
<table width="100%" class="bd1" border=1 cellpadding=0 cellspacing=0><tr><TD class=pd1>
<table width="100%" class=bdb1 border=1 cellpadding=0 cellspacing=0>
	<tr>
	<td width="160">&nbsp;</td>
	<td colspan="2">
	<input type=radio id=stui name=stype onclick="ckstype(this)" value=0<?php if($_R['stype']==0) echo $c;?>>用户编号 <input type=radio id=stu name=stype onclick="ckstype(this)" value=1<?php if($_R['stype']==1) echo $c;?>>用户名 <input type=radio id=stup name=stype onclick="ckstype(this)" value=2<?php if($_R['stype']==2) echo $c;?>>用户名片段</td>
	</tr>
	<tr>
	<td>&nbsp; &nbsp; 查询标记</td>
	<td width=160><input type=text id=sertag name=sertag maxlength=1000 value="<?php echo f_rpspc($_R['sertag']);?>" onblur="checktag(this)"></td>
	<td id=sertitle>回复id可以同时填写多个，中间以逗号","隔开。</td>
	</tr>
	<tr><td></td><td colspan=2 id=tagmsg></td></tr>
</table>
<table width="100%" class=bdb1 border=1 cellpadding=0 cellspacing=0>
	<tr>
	<td width=160>&nbsp; &nbsp; 状态</td>
	<td width=160 class=pdtb1p><select id=state name=state><OPTION value=0>所有</OPTION>
<?php
$q="select * from tdict force index(typekey) where type=";
$result=mysql_query($q."6") or die(f_e($q."6"));
while($row=mysql_fetch_object($result)){
	echo "<OPTION value=\"$row->info2\"".($row->info2==$_R['state']?$d:"").">$row->info</OPTION>\n";
	$states.="$row->info2.$row->info ";
}
mysql_free_result($result);
?>
	</select>
	</td>
	<td rowspan=3>
<table width=100% border=1 cellpadding=0 cellspacing=0>
	<tr class=darkbar><td height=22>&nbsp;选择管理箱 [<a class=goldlink href="javascript:selschboxs(true)">全选</a>] [<a class=goldlink href="javascript:selschboxs(false)">复位</a>]</td></tr>
	<tr><td><div id=forumlist class=fmlist><?php 
$q1="select * from tmng use index(se) where uid=$uid and type=7";
$result=mysql_query($q1) or die(f_e($q1));
while($row=mysql_fetch_object($result)){
	echo "<input type=checkbox name=schboxs[] value=$row->num".($_R['schboxs']?(array_search($row->num,$_R['schboxs'])===false?"":$c):"").">$row->comm ($row->box)<br>";
}
mysql_free_result($result);
	?></div></td></tr>
</table>	
	</td>
	</tr>
	<tr>
	<td>&nbsp; &nbsp; 性别</td>
	<td width=160 class=pdtb1p><select id=sex name=sex>
		<OPTION value=0<?php echo $_R['sex']?"":$d;?>>所有</OPTION>
		<OPTION value=2<?php echo $_R['sex']==2?$d:"";?>>男</OPTION>
		<OPTION value=1<?php echo $_R['sex']==1?$d:"";?>>女</OPTION>
		</select></td>
	</tr>
	<tr>
	<td width=160>&nbsp; &nbsp; 等级</td>
	<td width=160 class=pdtb1p><select id=level name=level><OPTION value=0>所有</OPTION>
<?php
//$q="select * from tdict force index(typekey) where type=";
$result=mysql_query($q."5 order by key1") or die(f_e($q."5"));
while($row=mysql_fetch_object($result)){
	echo "<OPTION value=\"$row->key1\"".($row->key1==$_R['level']?$d:"").">$row->info</OPTION>\n";
	$levels.="$row->key1.$row->info "; 
}
mysql_free_result($result);
?>
	</select>
	</td>
	</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
	<tr height=23>
	<TD width=130 rowspan=4>&nbsp; &nbsp; 注册时间</td>
	<td width=30>&nbsp;从</td><td width="160" style="padding-top:1px"><input type=text id=fromtime name=fromtime maxlength=19 value="<?php echo f_rpspc(trim($_R['fromtime'])); ?>" onblur="checkftime(this)"></td><td>格式为 <?php echo date("Y-m-d H:i:s",time()); ?></td>
	</tr>
	<tr><td></td><td width="160" id=fromtimemsg></td><td></td></tr>
	<tr>
	<td>&nbsp;到</td><td width="160"><input type=text id=totime name=totime maxlength=19 value="<?php echo f_rpspc(trim($_R['totime'])); ?>" onblur="checkttime(this)"></td>
	<td>格式同上,或不填表示到现在。</td>
	</tr>
	<tr><td></td><td width="160" id=totimemsg></td><td></td></tr>
</table>
<table width=100% class=bdt1 border=1 cellpadding=0 cellspacing=0>
<tr height=23>
	<TD width=160 rowspan=2>&nbsp;<input type=checkbox id=ext3 name=isright onclick="ckrigt(this)" value=1<?php echo $_R['isright']?$c:"";?>>权限<input type=hidden id=right name=right value=<?php echo $_R['right']?f_rpspc($_R['right']):"1111111"; ?>></td>
	<TD><input type=radio id=rtequ name=rtype value=0<?php echo !$_R['rtype']?$c:"";?>>取权相等 <input type=radio id=rtand name=rtype value=1<?php echo $_R['rtype']?$c:"";?>>取具有任一选择权限 <input type=checkbox id=rnot name=rnot value=1<?php echo $_R['rnot']?$c:"";?>>取反</td>
</tr>
<tr>
	<td style="padding-top:1px" colspan=2>
<table border=1 cellpadding=0 cellspacing=0>
<tr height=22 align=center>
	<TD width=50 class=bdlt1>浏览</TD>
	<TD width=50 class=bdlt1>发帖</TD>
	<TD width=50 class=bdlt1>回复</TD>
	<TD width=50 class=bdlt1>修改</TD>
	<TD width=50 class=bdlt1>投票</TD>
	<TD width=50 class=bdlt1>短信</TD>
	<TD width=50 class=bdltr1>禁言</TD>
</tr>
<tr height=22 align=center>
	<TD id=ritd0 class=bdltb1></TD>
	<TD id=ritd1 class=bdltb1></TD>
	<TD id=ritd2 class=bdltb1></TD>
	<TD id=ritd3 class=bdltb1></TD>
	<TD id=ritd4 class=bdltb1></TD>
	<TD id=ritd5 class=bdltb1></TD>
	<TD id=ritd6 class=bd1></TD>
</tr>
</table>
	</td>
</tr>
</table>
</TD></tr></table>
</div>
<SCRIPT language="JavaScript" src="../js/js.js"></script>
<SCRIPT language="JavaScript" src="../js/mng/uss.js"></script>
<?php if(isset($_R['stype']))echo"<SCRIPT language=JavaScript>expandsearch()</script>";?>
