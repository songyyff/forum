<?php e_e();
function f_mtime(){list($u,$s)=explode(" ",microtime()); return ((float)$u+(float)$s);}
if($ins=isset($_REQUEST['stype'])){
	include "us/us_s.php";
	$starttime=f_mtime();
	$rsrows=mysql_query($query) or die(f_e($query));
	$endtime=f_mtime();
	$lens=mysql_num_rows($rsrows);
}
?>
<FORM id=mainform method="POST">
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="119">&nbsp;用户搜索</td><?php echo $lens?"<td class=pdpgnone><font class=msgpagenum>$lens</font>":"<td>&nbsp;";?></td>
<td width="100" align=right><a href="javascript:submitform()" class="whitelink">[ 提交 ]</a>&nbsp;</td>
</tr>
<table width="100%" class="bar3" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD>&nbsp;查找条件</td>
<td>&nbsp;</td>
<td width=150 align=right><?php echo $ins?"查询用时 ".substr($endtime-$starttime,0,8)." 秒":""; ?>&nbsp;</td>
<td width=29><a id=issearch class=whitelink href="javascript:expandsearch()">[-]</a></td>
</tr>
</table>
<div id=searchdiv style="overflow:hidden;">
<table width="100%" class="bd1" border=1 cellpadding=0 cellspacing=0><tr><TD class=pd1>
<table width="100%" class=bdb1 border=1 cellpadding=0 cellspacing=0>
	<tr>
	<td width="160">&nbsp;</td>
	<td colspan="2">
	<input type=radio id=stui name=stype onclick="ckstype(this)" value=0<?php if($_REQUEST['stype']==0) echo $c;?>>用户编号 <input type=radio id=stu name=stype onclick="ckstype(this)" value=1<?php if($_REQUEST['stype']==1) echo $c;?>>用户名 <input type=radio id=stup name=stype onclick="ckstype(this)" value=2<?php if($_REQUEST['stype']==2) echo $c;?>>用户名片段</td>
	</tr>
	<tr>
	<td>&nbsp; &nbsp; 查询标记</td>
	<td width=160><input type=text id=sertag name=sertag maxlength=1000 value="<?php echo f_rpspc(trim($_REQUEST['sertag']));?>" onblur="checktag(this)"></td>
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
	echo "<OPTION value=\"$row->info2\"".($row->info2==$_REQUEST['state']?$d:"").">$row->info</OPTION>\n";
	$states.="$row->info2.$row->info ";
}
mysql_free_result($result);
?>
	</select>
	</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>&nbsp; &nbsp; 性别</td>
	<td width=160 class=pdtb1p><select id=sex name=sex>
		<OPTION value=0<?php echo $_REQUEST['sex']?"":$d;?>>所有</OPTION>
		<OPTION value=2<?php echo $_REQUEST['sex']==2?$d:"";?>>男</OPTION>
		<OPTION value=1<?php echo $_REQUEST['sex']==1?$d:"";?>>女</OPTION>
		</select></td>
	<td></td>
	</tr>
	<tr>
	<td width=160>&nbsp; &nbsp; 等级</td>
	<td width=160 class=pdtb1p><select id=level name=level><OPTION value=0>所有</OPTION>
<?php
//$q="select * from tdict force index(typekey) where type=";
$result=mysql_query($q."5 order by key1") or die(f_e($q."5"));
while($row=mysql_fetch_object($result)){
	echo "<OPTION value=\"$row->key1\"".($row->key1==$_REQUEST['level']?$d:"").">$row->info</OPTION>\n";
	$levels.="$row->key1.$row->info "; 
}
mysql_free_result($result);
?>
	</select>
	</td>
	<td>&nbsp;</td>
	</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
	<tr height=23>
	<TD width=130 rowspan=4>&nbsp; &nbsp; 注册时间</td>
	<td width=30>&nbsp;从</td><td width="160" style="padding-top:1px"><input type=text id=fromtime name=fromtime maxlength=19 value="<?php echo f_rpspc($_REQUEST['fromtime']); ?>" onblur="checkftime(this)"></td><td>格式为 <?php echo date("Y-m-d H:i:s",time()); ?></td>
	</tr>
	<tr><td></td><td width="160" id=fromtimemsg></td><td></td></tr>
	<tr>
	<td>&nbsp;到</td><td width="160"><input type=text id=totime name=totime maxlength=19 value="<?php echo f_rpspc($_REQUEST['totime']); ?>" onblur="checkttime(this)"></td>
	<td>格式同上,或不填表示到现在。</td>
	</tr>
	<tr><td></td><td width="160" id=totimemsg></td><td></td></tr>
</table>
<table width=100% class=bdt1 border=1 cellpadding=0 cellspacing=0>
<tr height=23>
	<TD width=160 rowspan=2>&nbsp;<input type=checkbox id=ext3 name=isright onclick="ckrigt(this)" value=1<?php echo $_REQUEST['isright']?$c:"";?>>权限<input type=hidden id=right name=right value=<?php echo $_REQUEST['right']?f_rpspc($_REQUEST['right']):"1111111"; ?>></td>
	<TD><input type=radio id=rtequ name=rtype value=0<?php echo !$_REQUEST['rtype']?$c:"";?>>取权相等 <input type=radio id=rtand name=rtype value=1<?php echo $_REQUEST['rtype']?$c:"";?>>取具有任一选择权限 <input type=checkbox id=rnot name=rnot value=1<?php echo $_REQUEST['rnot']?$c:"";?>>取反</td>
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
<?php if(isset($_REQUEST['stype']))include "us/s.php"; ?>
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="119">&nbsp;用户搜索</td><?php echo $lens?"<td class=pdpgnone><font class=msgpagenum>$lens</font>":"<td>&nbsp;";?></td>
<td width="100" align="right"><a href="javascript:submitform()" class="whitelink">[ 提交 ]</a>&nbsp;</td>
</tr>
</table>
<script language="JavaScript">irows=<?php echo $lens?$lens:0;?></script>
<script language="JavaScript" src="../js/mng/us.js"></script>
<?php if(isset($_REQUEST['stype']))echo "<script language=JavaScript>expandsearch()</script>";?>
