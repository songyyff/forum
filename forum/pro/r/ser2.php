<?php e_e();


$fmlist="";$gi=0;$fmastr="";
function forumlist($r,$level){
global $fmlist,$gi,$fmastr,$right_saved,$_S;
//需要判权
$t=(int)$r->rigt;
$l=(int)$r->level;
if($r->stat=='E'&&($_S['seuserid']?($_S['seright']&$t&$right_saved['userview']&&$l<=$_S['selevel']):($l==1&&$t&$right_saved['guestview']))) {
	$fmlist.="<table width=100% border=1 cellpadding=0 cellspacing=0><tr>";
	for($i=1;$i<$level;$i++)$fmlist.="<td width=15></td>";
	$fmlist.="<td width=15><input type=checkbox id=forum$r->id name=forums[] value=$r->id></td><td>$r->name ($r->inum/$r->rnum)</td>";
	$fmlist.="</tr></table>";
	echo "$r->id,";
	$gi++;
	$fmastr.="\"$r->id\",";
if($r->sfnu){
	$q="select id,pid,name,sfnu,inum,rnum,rigt,level,stat from tgup where pid=$r->id order by sort asc";
	$R=mysql_query($q) or die(f_e($q));
	$level++;
	while($r=mysql_fetch_object($R)) forumlist($r,$level);
	mysql_free_result($R);
}
}//else $fmlist="<input type=checkbox  id=forum0 name=forums1 value=0 onclick=\"clickforum(this)\">所有论坛<br>";
}
echo "<script language=JavaScript>
var fms=[";
	$q="select id,pid,name,sfnu,inum,rnum,rigt,level,stat from tgup where pid=0 order by sort asc";
	$R=mysql_query($q) or die(f_e($q));
	while($r=mysql_fetch_object($R)) forumlist($r,1);
	mysql_free_result($R);
echo "0]
fms.pop()
</script>
";

if(isset($_REQUEST['norr']))include "../sub/rag/ser3.php"; ?>
<FORM id=mainform method="POST" action="search.php?type=2">
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="119">&nbsp;精确文字查询</td><td class="pdpage"><?php echo $pagestr; ?>&nbsp;</td>
<td width="100" align=right><a href="javascript:submitform()" class="whitelink">[ 提交 ]</a>&nbsp;</td>
</tr>
<table width="100%" class="bar3" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD>&nbsp;查询条件</td>
<td>&nbsp;</td><td width=29><a class=whitelink href="javascript:expandsearch()">[<span id=issearch>-</span>]</a></td>
</tr>
</table>
<div id=searchdiv style="overflow:hidden;">
<table width="100%" class="bd1" border=1 cellpadding=0 cellspacing=0><tr><TD class=pd1>
<table width="100%" class="darkbar" border=1 cellpadding=0 cellspacing=0>
<tr height=22>
<TD width="200">&nbsp;钩选目标论坛 (贴数/回复数)</td>
<td>[<a class=goldlink href="javascript:setforum(true);">选择所有</a>] [<a class=goldlink href="javascript:setforum(false);">论坛复位</a>]</td>
</tr>
</table>
<?php echo "<div id=forumlist class=fmlist>$fmlist</div>"; ?>
<table width="100%" class="bdb1" border=1 cellpadding=0 cellspacing=0>
	<tr height=23>
	<TD>&nbsp;<input type=radio name=norr value=0<?php echo $_REQUEST['norr']==0?" checked=true":"";?>>查询帖子<input type=radio name=norr value=1<?php echo $_REQUEST['norr']==1?" checked=true":"";?>>查询回复</td>
	</tr>
</table>
<table width="100%" class="bdb1" border=1 cellpadding=0 cellspacing=0>
	<tr height=23>
	<TD>&nbsp;<input type=radio name=torb value=0<?php echo $_REQUEST['torb']==0?" checked=true":"";?>>查询标题<input type=radio name=torb value=1<?php echo $_REQUEST['torb']==1?" checked=true":"";?>>查询内容</td>
	</tr>
</table>
<table width="100%" class="llbgc" border=1 cellpadding=0 cellspacing=0>
	<tr height=23>
	<TD width="160" style="padding-top:1px">&nbsp;&nbsp;&nbsp;&nbsp;查找字串</td>
	<td width=150 style="padding-top:1px"><input type=text id=serstr name=serstr value="<?php echo f_rpspc(trim($_REQUEST['serstr']));?>" onblur="checkserstr(this)"></td>
	<td>填写您想查询的单词</td>
	</tr>
	<tr><td></td><td width=160 id=serstrmsg></td><td></td></tr>
	<tr>
	<td>&nbsp;<input type=radio id=usertype name=usertype onclick="ckusertype(this)" value=0<?php echo $_REQUEST['usertype']==0?" checked=true":"";?>>用户名&nbsp;&nbsp;<input type=radio id=usertype1 name=usertype onclick="ckusertype(this)"  value=1<?php echo $_REQUEST['usertype']==1?" checked=true":"";?>>用户id</td>
	<td width="150"><input type=text id=seruser name=seruser value="<?php echo f_rpspc(trim($_REQUEST['seruser']));?>" onblur="checkuser(this)"></td>
	<td>不填(表示所有)或只能填一个</td>
	</tr>
	<tr><td></td><td width=160 id=usermsg></td><td></td></tr>
</table>
<table width="100%" class="bdt1" border=0 cellpadding=0 cellspacing=0>
	<tr height=23>
	<TD width="100">&nbsp;<input type=radio id=torp name=torp onclick="cktorp(this)" value=0<?php echo $_REQUEST['torp']?"":" checked=true"; ?>>时间范围</td>
	<td width=30><input type=radio id=ftottime name=ftottime onclick="ckftottime(this)" value=0<?php echo $_REQUEST['ftottime']==0?" checked=true":"";?>></td>
	<td width=30>&nbsp;从</td><td width="160" style="padding-top:1px"><input type=text id=fromtime name=fromtime value="<?php echo f_rpspc(trim($_REQUEST['fromtime'])); ?>" onblur="checkftime(this)"></td><td>格式为 <?php echo date("Y-m-d H:i:s",time()); ?></td>
	</tr>
	<tr><TD></TD><td></td><td></td><td width="160" id=fromtimemsg></td><td></td></tr>
	<tr>
	<TD></TD><TD></TD>
	<td>&nbsp;到</td><td width="160"><input type=text id=totime name=totime value="<?php echo f_rpspc(trim($_REQUEST['totime'])); ?>" onblur="checkttime(this)"></td>
	<td>格式同上,或填"现在"。</td>
	</tr>
	<tr><TD></TD><td></td><td></td><td width="160" id=totimemsg></td><td></td></tr>
	<tr height=23>
	<TD></TD>
	<td width=30><input type=radio id=ftottime1 name=ftottime onclick="ckftottime(this)" value=1<?php echo $_REQUEST['ftottime']==1?" checked=true":"";?>></td>
	<td class="bdt1">&nbsp;</td>
	<td width="160" class="bdt1" style="padding-top:1px"><input type=text id=sectonow name=sectonow value="<?php echo (int)$_REQUEST['sectonow']; ?>" onblur="checksec(this)"></td>
	<td class="bdt1">秒以内(一天的秒数为：24小时X60分钟X60秒=86400秒)</td>
	</tr>
	<tr><TD></TD><td></td><td></td><td width="160" id=secmsg></td><td></td></tr>
</table>
<table width="100%" border=1 cellpadding=0 cellspacing=0>
	<td height=23>
	<TD width="100">&nbsp;<input type=radio id=torp1 name=torp onclick="cktorp(this)" value=1<?php echo $_REQUEST['torp']?" checked=true":"";?>>按附件</td>
	<TD width="60" class="bdt1">&nbsp;</td>
	<td class="bdt1" style="padding-top:1px" width="160"><input type=text id=packnum name=packnum value="<?php echo (int)$_REQUEST['packnum']; ?>" onblur="checkadd(this)"></td><td class="bdt1">个附件以上</td>
	</tr>
	<td><TD width="100"></td><TD width="60"></td><td id=addmsg colspan="2"></td><td></td></tr>
</table>
</TD></tr></table>
</div>
<SCRIPT language="JavaScript" src="../js/js.js"></script>
<SCRIPT language="JavaScript" src="../js/rag/ser3.js"></SCRIPT>
<?php if(isset($_REQUEST['norr']))include "s/ser33.php"; ?>
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="119">&nbsp;精确文字查询</td><td class="pdpage"><?php echo $pagestr; ?>&nbsp;</TD>
<td width="100" align="right"><a href="javascript:submitform()" class="whitelink">[ 提交 ]</a>&nbsp;</td>
</tr>
</table>