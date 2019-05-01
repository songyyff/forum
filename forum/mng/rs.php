<?php e_e();
function f_mtime(){list($u,$s)=explode(" ",microtime()); return ((float)$u+(float)$s);}
if($ins=isset($_REQUEST['stype'])){
	include "rs/rs_s.php";
	$starttime=f_mtime();
	$rsrows=mysql_query($query) or die(f_e($query));
	$endtime=f_mtime();
	$lens=mysql_num_rows($rsrows);
}
$fmlist="<table width=100% border=1 cellpadding=0 cellspacing=0>";
$fms="var fms=new Array(";
$i=0;
$query="select t1.*,t2.name,t2.inum,t2.dnum from tspu as t1 force index(unind),tgup as t2  where t1.uid=".$_SESSION['seuserid']." and t1.gid=t2.id";
$result=mysql_query($query) or die(f_e($query));
while($row=mysql_fetch_object($result)) {
	$fmlist.="\n<tr><td width=15><input type=checkbox id=forum$row->gid name=forums[] value=$row->gid></td><td>$row->name ($row->inum/$row->dnum)</td></tr>";
	$fms.=($i?",":"")."\"$row->gid\"";
	$i++;
}
$fms.=");\n";
mysql_free_result($result);
$fmlist.="</table>";
if($ins){
	include "../func/pgnum.php";
	f_getpagestr($cpage,$lens<$ps?($cpage-1)*$ps+($lens?$lens:1):($cpage+3)*$ps,$ps,10,"?type=$vartype",0,50,isset($_REQUEST['stype']));
}
?>
<FORM id=mainform method="POST">
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="119">&nbsp;回复搜索</td><?php echo $ins?$v_pgstr:"<td>&nbsp;</td>"; ?>
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
<table width=100% border=1 cellpadding=0 cellspacing=0>
	<tr height=22 class=bar3>
	<TD width="160">&nbsp;回复</TD>
	<TD>目标论坛 (有效/无效 贴数) [<a class=goldlink href="javascript:setforum(true);">全选</a>] [<a class=goldlink href="javascript:setforum(false);">复位</a>]</TD>
	</tr><tr>
	<TD class="bdltb1" align=center>状态&nbsp;<select id=items name=istat>
<?php
$q="select * from tdict force index(typekey) where type=";
$result=mysql_query($q."6") or die(f_e($q."6"));
while($row=mysql_fetch_object($result)) echo "<OPTION value=\"$row->info2\"".($row->info2==$_REQUEST['istat']?" selected":"").">$row->info</OPTION>\n";
mysql_free_result($result);
?>
	</select></td>
	<td><div id=forumlist class=fmlist><?php echo $fmlist; ?></div></td>
	</tr>
</table>
<table width="100%" class=bdb1 border=1 cellpadding=0 cellspacing=0>
	<tr>
	<td width="160">&nbsp;</td>
	<td colspan="2">
	<input type=radio id=stri name=stype onclick="ckstype(this)" value=0<?php if($_REQUEST['stype']==0) echo $c;?>>回复编号 <input type=radio id=stii name=stype onclick="ckstype(this)" value=4<?php if($_REQUEST['stype']==4) echo $c;?>>帖子编号 <input type=radio id=stui name=stype onclick="ckstype(this)" value=1<?php if($_REQUEST['stype']==1) echo $c;?>>用户编号 <input type=radio id=stu name=stype onclick="ckstype(this)" value=2<?php if($_REQUEST['stype']==2) echo $c;?>>用户名 <input type=radio id=stup name=stype onclick="ckstype(this)" value=3<?php if($_REQUEST['stype']==3) echo $c;?>>用户名片段</td>
	</tr>
	<tr>
	<td>&nbsp; &nbsp; 查询标记</td>
	<td width=160><input type=text id=sertag maxlength=1000 name=sertag value="<?php echo f_rpspc($_REQUEST['sertag']);?>" onblur="checktag(this)"></td>
	<td id=sertitle>回复id可以同时填写多个，中间以逗号","隔开。</td>
	</tr>
	<tr><td></td><td colspan=2 id=tagmsg></td></tr>
<table width="100%" class="llbgc" border=1 cellpadding=0 cellspacing=0>
	<tr height=23>
	<td width=160>&nbsp;</td>
	<td width=160 colspan=2 style="padding-top:1px"><input type=radio id=serht name=torb value=0<?php echo $_REQUEST['torb']==0?$c:"";?>>查询标题&nbsp;<input type=radio id=serhb name=torb value=1<?php echo $_REQUEST['torb']==1?$c:"";?>>查询内容</td>
	</tr>
	<tr height=23>
	<TD width=160 style="padding-top:1px">&nbsp; &nbsp; 查找字串</td>
	<td width=160 style="padding-top:1px"><input type=text maxlength=200 id=serstr name=serstr value="<?php echo f_rpspc($_REQUEST['serstr']);?>" onblur="checkserstr(this)"></td>
	<td>填写您想查询的单词</td>
	</tr>
	<tr><td></td><td width=160 id=serstrmsg></td><td></td></tr>
</table>
<table width="100%" class="bdt1" border=0 cellpadding=0 cellspacing=0>
	<tr height=23>
	<TD width="100">&nbsp;<input type=radio id=ext0 name=ext onclick="ckext(this)" value=0<?php if($_REQUEST['ext']==0) echo $c; ?>>时间范围</td>
	<td width=30><input type=radio id=ftottime name=ftottime onclick="ckftottime(this)" value=0<?php echo $_REQUEST['ftottime']==0?$c:"";?>></td>
	<td width=30>&nbsp;从</td><td width="160" style="padding-top:1px"><input type=text id=fromtime name=fromtime maxlength=19 value="<?php echo f_rpspc($_REQUEST['fromtime']); ?>" onblur="checkftime(this)"></td><td>格式为 <?php echo date("Y-m-d H:i:s",time()); ?></td>
	</tr>
	<tr><TD></TD><td></td><td></td><td width="160" id=fromtimemsg></td><td></td></tr>
	<tr>
	<TD></TD><TD></TD>
	<td>&nbsp;到</td><td width="160"><input type=text maxlength=19 id=totime name=totime value="<?php echo f_rpspc($_REQUEST['totime']); ?>" onblur="checkttime(this)"></td>
	<td>格式同上,或不填表示到现在。</td>
	</tr>
	<tr><TD></TD><td></td><td></td><td width="160" id=totimemsg></td><td></td></tr>
	<tr height=23>
	<TD></TD>
	<td width=30><input type=radio id=ftottime1 name=ftottime onclick="ckftottime(this)" value=1<?php echo $_REQUEST['ftottime']==1?$c:"";?>></td>
	<td class="bdt1">&nbsp;</td>
	<td width="160" class="bdt1" style="padding-top:1px"><input type=text id=sectonow maxlength=10 name=sectonow value="<?php echo (int)$_REQUEST['sectonow']; ?>" onblur="checksec(this)"></td>
	<td class="bdt1">秒以内(一天的秒数为：24小时X60分钟X60秒=86400秒)</td>
	</tr>
	<tr><TD></TD><td></td><td></td><td width="160" id=secmsg></td><td></td></tr>
</table>
<table width=100% border=1 cellpadding=0 cellspacing=0>
<tr height=23>
	<TD width=100>&nbsp;<input type=radio id=ext1 name=ext onclick="ckext(this)" value=1<?php echo $_REQUEST['ext']==1?$c:"";?>>按附件</td>
	<TD width=60 class="bdt1">&nbsp;</td>
	<td class="bdt1" style="padding-top:1px" width=160><input type=text id=packnum name=packnum maxlength=10 value="<?php echo (int)$_REQUEST['packnum']; ?>" onblur="checkpack(this)"></td><td class="bdt1">个附件以上</td>
</tr>
	<tr><TD width=100></td><TD width=60></td><td id=packmsg width=160></td><td></td></tr>
</table>
<table width=100% class=bdt1 border=1 cellpadding=0 cellspacing=0>
<tr height=23>
	<TD width=160 rowspan=2>&nbsp;<input type=checkbox id=ext3 name=isright onclick="ckrigt(this)" value=1<?php echo $_REQUEST['isright']?$c:"";?>>权限<input type=hidden id=right name=right value=<?php echo $_REQUEST['right']?f_rpspc($_REQUEST['right']):"11111"; ?>></td>
	<TD><input type=radio id=rtequ name=rtype value=0<?php echo !$_REQUEST['rtype']?$c:"";?>>取权相等 <input type=radio id=rtand name=rtype value=1<?php echo $_REQUEST['rtype']?$c:"";?>>取具有任一选择权限 <input type=checkbox id=rnot name=rnot value=1<?php echo $_REQUEST['rnot']?$c:"";?>>取反</td>
</tr>
<tr>
	<td style="padding-top:1px" colspan=2>
<table border=1 cellpadding=0 cellspacing=0>
<tr height=22 align=center>
	<TD width=50 class=bdlt1>游客</TD>
	<TD colspan=3 class=bdlt1>用户</TD>
	<TD class=bdltr1>管理</TD>
</tr>
<tr height=22 align=center>
	<TD class=bdlt1>浏览</TD>
	<TD width=50 class=bdlt1>浏览</TD>
	<TD width=50 class=bdlt1>显示</TD>
	<TD width=50 class=bdlt1>修改</TD>
	<TD width=50 class=bdltr1>显示</TD>
</tr>
<tr height=22 align=center>
	<TD id=ritd0 class=bdltb1></TD>
	<TD id=ritd1 class=bdltb1></TD>
	<TD id=ritd2 class=bdltb1></TD>
	<TD id=ritd3 class=bdltb1></TD>
	<TD id=ritd4 class=bd1></TD>
</tr>
</table>
	</td>
</tr>
</table>
</TD></tr></table>
</div>
<SCRIPT language="JavaScript" src="../js/js.js"></script>
<SCRIPT language="JavaScript">
<?php echo $fms; ?>
</SCRIPT>
<?php
if(isset($_REQUEST['stype']))include "rs/s.php";
?>
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="119">&nbsp;帖子搜索</td><?php echo $ins?$v_pgstr:"<td>&nbsp;</td>"; ?>
<td width="100" align="right"><a href="javascript:submitform()" class="whitelink">[ 提交 ]</a>&nbsp;</td>
</tr>
</table>
<script language="JavaScript">irows=<?php echo $lens?$lens:0;?>;</script>
<script language="JavaScript" src="../js/mng/rs.js"></script>
<script language="JavaScript">
<?php
 if(isset($_REQUEST['stype'])&&$len=count($_REQUEST['forums'])){
	echo "var subforums=new Array(";
	for($i=0;$i<$len;$i++) echo ($i?",":"")."\"".(int)$_REQUEST['forums'][$i]."\"";
	echo ");\n".
	"for(i=0;i<$len;i++) G(\"forum\"+subforums[i]).checked=\"true\";\n".
	"expandsearch();";
}
?>
</script>
