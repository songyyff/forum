<?php e_e();
$hso=$grow->srigt&$right_saved['superother'];
if($hso){
if(($_R['imi']||$_R['imr']))include "g/s1.php";
if($_R['ims'])include "g/s2.php";
}
?>
<form id=mainform enctype="multipart/form-data" method="POST" onsubmit="return submitform()">
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="108">&nbsp;论坛管理</td>
<TD class=pdtb1p>
<?php
$query="select t1.gid,t2.name from tspu as t1 force index(unind) left join tgup as t2 on t1.gid=t2.id where t1.uid=".$_S['seuserid'];
$result=mysql_query($query) or die(f_e($query));
if($len=mysql_num_rows($result)){
	echo "<select id=glist name=gid onchange=\"selgrp(this.value)\">\n";
	for($i=0;$i<$len;$i++){
		$row=mysql_fetch_object($result);
		if(!$row->gid) $row->name="根论坛";
		echo "<option value=$row->gid".($grow->gid==$row->gid?$d:"").">".substr($row->name,0,50)."</option>";
	}
	echo "</select>";
}
mysql_free_result($result);
?></td>
<td></td>
<td width="100" align="right" class="pdtb1p"><input type=submit value=" 提交 ">&nbsp;</td>
</tr>
</table>
<table width="100%" class="bar3" border=1 cellpadding=0 cellspacing=0><tr height=23><TD width="30">&nbsp;<input id="ismngi" name=imi type=checkbox<?php $s1=$hso?" ":$s; echo $s1; ?> onclick="mngi(!this.checked)"></TD><td  width="100">论坛管理</td><td>&nbsp;</td></tr></table>
<table width="100%" class=bd1 border=1 cellpadding=0 cellspacing=0><tr><TD class=pd1>
<table width="100%" border=1 cellpadding=0 cellspacing=0>
<tr height=22>
<TD width="100" class=pd3>论坛名</TD>
<td class=pd3><input type="text" name=gname id=gname<?php echo "$s1 value=\"$grow->name"; ?>"></td>
</tr>
<tr>
<TD width="100" class=pd3>说明</TD>
<td class=pd3><textarea id=gcomm name=gcomm<?php echo "$s1>$grow->comm"; ?></textarea></td>
</tr>
<tr height=22>
<TD width="100" class=pd3>置顶帖子数量</TD>
<td class=pd3><input type="text" name=gmxtp id=gmxtp<?php echo "$s1 value=\"$grow->mxtp"; ?>"> 论坛最大置顶帖子数量 ( 20 / 0 - 50 )</td>
</tr>
<tr height=22>
<TD width="100" class=pd3>论坛图标</TD>
<td class=pd3>
<table border=1 cellpadding=0 cellspacing=0>
<TR><TD><img width=50 src="<?php echo "../icons/f/",$grow->id?$grow->id:0,".gif";?>" /></TD>
<td class="pd1"><input type="file" name=gicon id=gicon<?php echo $s1; ?>><br>论坛图标的规格为 50 x 50 gif 格式</td></TR>
</table>
</td></tr>
<TR><TD></TD><td id=iconmsg><?php echo $iconmsg; ?></td></TR>
</table>
</TD></tr></table>
<table width="100%" class="bar3" border=1 cellpadding=0 cellspacing=0>
<tr height=23><TD width="30">&nbsp;<input id="ismngr" name=imr type=checkbox<?php echo $s1; ?> onclick="mngr(!this.checked)"></TD><td  width="100">论坛权限管理</td><td>&nbsp;</td></tr>
</table>
<table width="100%" class=bd1 border=1 cellpadding=0 cellspacing=0><tr><TD class=pd1>
<table border=1 cellpadding=0 cellspacing=0>
<tr height=22 align=center><TD class=bdlt1 colspan="2">论坛</TD><TD width="50" class=bdlt1>游客</TD><TD colspan=4 class=bdltr1>用户</TD></tr>
<tr height=22 align=center><TD width="80" class=bdlt1>状态</TD><TD width="80" class=bdlt1>等级</TD><TD class=bdlt1>浏览</TD><TD width="50" class=bdlt1>浏览</TD><TD width="50" class=bdlt1>发贴</TD><TD width="50" class=bdlt1>回复</TD><TD width="50" class=bdltr1>修改</TD></tr>
<tr height=22 align=center>
<TD class=bdltb1>
<select name=gstat id=gstat<?php echo $s1; ?> disabled>
<OPTION value="1"<?php if($grow->stat=='E') echo $d; ?>>有效</option>
<OPTION value="0"<?php if($grow->stat=='D') echo $d; ?>>失效</option>
</select></TD>
<TD class=bdltb1>
<SELECT name=glevel id=glevel<?php echo $s1; ?> disabled>
<?php
$query="select * from tdict force index(typekey) where type=5 order by key1 asc";
$result=mysql_query($query) or die(f_e($query));
while($row=mysql_fetch_object($result)) echo "<OPTION value=$row->key1".($row->key1==$grow->level?$d:"").">$row->info</OPTION>";
mysql_free_result($result);
?>
</SELECT></TD>
<TD class=bdltb1><input type="checkbox" name=gview id=gview value=1<?php if($grow->rigt&$right_saved['guestview']) echo "$c$s1"; ?>></TD>
<TD class=bdltb1><input type="checkbox" id=uview name=uview value=1<?php if($grow->rigt&$right_saved['userview']) echo "$c$s1"; ?>></TD>
<TD class=bdltb1><input type="checkbox" name=unew id=unew value=1<?php if($grow->rigt&$right_saved['usernew']) echo "$c$s1"; ?>></TD>
<TD class=bdltb1><input type="checkbox" name=urpy id=urpy value=1<?php if($grow->rigt&$right_saved['userrpy']) echo "$c$s1"; ?>></TD>
<TD class=bd1><input type="checkbox" id=umodify name=umodify value=1<?php if($grow->rigt&$right_saved['usermodify']) echo "$c$s1"; ?>></TD>
</tr>
</table>
<?php
if($ml=count($msgr)){
echo "<font color=red><b>错误</b></font> ：<br>";
for($mi=0;$mi<$ml;$mi++)echo "&nbsp; ".($mi+1).".".$msgr[$mi]."<br>";
}
?>
</td></tr></table>
<table width="100%" class="bar3" border=1 cellpadding=0 cellspacing=0>
<tr height=23><TD width="30">&nbsp;<input id="ismngsu" name=ims type=checkbox<?php echo $s1; ?> onclick="mngsu(!this.checked)"></TD><td  width="100">管理员管理</td><td>&nbsp;</td></tr>
</table>
<table width="100%" class=bd1 border=1 cellpadding=0 cellspacing=0><tr><TD class=pd1>
<table width="100%" border=1 cellpadding=0 cellspacing=0>
<tr height=23 align=center><TD colspan=2>&nbsp;</td><td class=bdl1 colspan=6>论坛管理权</td><td  colspan=2 class=bdl1>用户管理权</td><td class=bdl1>&nbsp;</td><td>&nbsp;</td></tr>
<tr height=23 align=center><TD width=30>删</TD><td  width=150 align=left>管理员</td><td class=bdl1 width=40>浏览</td><td  width=40>发贴</td><td  width=40>修改</td><td  width=40>隐藏</td><td  width=40>删除</td><td  width=40>人事</td><td class=bdl1 width=40>修改</td><td  width=40>删除</td><td class=bdl1 width=40>改</td><td align=left>&nbsp;成为管理时间</td></tr>
<?php
$query="select t1.*,t2.name,t2.srgt from tspu as t1 force index(gid), tuser as t2 where t1.gid=$grow->gid and t1.uid=t2.id order by t1.uid";
$result=mysql_query($query) or die(f_e($query));
$i=0;
if(mysql_num_rows($result)){
	$psus=array();
	while($row=mysql_fetch_object($result)){
		if($row->uid==$_S['seuserid']) $row->name.="(自己)";else array_push($psus,$row->uid);
		showsu($row,$i,$row->uid==$_S['seuserid']?false:$hso);
		$i++;
	}
	if($hso){
		$nrow->rigt=0x7fffffff^$right_saved['superother'];
		$nrow->srgt=0x7ffffff;
		$nrow->uid=0;
		showsu($nrow,$i,1);
	}
} else echo "<tr height=23><TD colspan=10 class=bd1pd1>--- 此论坛尚无其他管理员 ---</TD></tr>";
echo "</table>";
mysql_free_result($result);
function showsu($row,$i,$d){
global $right_saved,$c,$s,$nsmsg;
$r=(int)$row->rigt;
$id=$row->uid;
$t="<TD class=bdt1><input type=checkbox id=";
echo "<tr height=23 class=".($i&1?"light":"dark")."bar align=center><TD width=30 align=center class=bdt1>".
($id?"<input type=checkbox id=sudel$id name=delsu[] value=$id".($d?"":$s)." onclick=\"cksudel(this)\">":"&nbsp;").
"</TD>".
"<td width=150 align=left class=bdt1".($id?">".$row->name:" style=\"padding-top:2px;padding-bottom:2px;\"><input type=text id=newsu name=newsu".($d?"":$s).">")."</td>".
$t."suv$id name=suv$id value=1".($r&$right_saved['superview']?$c:"").($d?"":$s)."></TD>".
$t."sun$id name=sun$id value=1".($r&$right_saved['supernew']?$c:"").($d?"":$s)."></TD>".
$t."sum$id name=sum$id value=1".($r&$right_saved['supermodify']?$c:"").($d?"":$s)."></TD>".
$t."suh$id name=suh$id value=1".($r&$right_saved['superhidden']?$c:"").($d?"":$s)."></TD>".
$t."sud$id name=sud$id value=1".($r&$right_saved['superdel']?$c:"").($d?"":$s)."></TD>".
$t."suo$id name=suo$id value=1".($r&$right_saved['superother']?$c:"").($d?"":$s)."></TD>".
$t."sumu$id name=sumu$id value=1".($right_saved['supermodify']&$row->srgt?$c:"").($d?"":$s)."></TD>".
$t."sudu$id name=sudu$id value=1".($right_saved['superdel']&$row->srgt?$c:"").($d?"":$s)."></TD>".
"<TD class=bdt1>".($id?"<input type=checkbox id=suum$id name=suum[] value=$id".($d?"":$s)." onclick=\"cksum(this)\">":"&nbsp;")."</TD>".
"<td align=left class=bdt1>&nbsp;".($id?$row->ctime:"填写用户的数字编号")."</td></tr>\n".
(!$id?"<tr class=".($i&1?"light":"dark")."bar><td></td><td colspan=11 id=nsmsg>$nsmsg<td><tr>":"");
}
?>
</TD></tr></table>
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr>
<TD width="108">&nbsp;论坛管理</td>
<TD><?php echo $grow->name; ?>&nbsp;</td>
<td width="100" align="right" class="pdtb1p"><input type=submit value=" 提交 ">&nbsp;</td>
</tr>
</table>
</FORM>
<script language="JavaScript">
var superus=new Array(<?php
if(!$hso) echo "0";elseif(($len=count($psus))>1)for($i=0;$i<$len;$i++)echo ($i?",":"").$psus[$i];else if($len)echo "\"".$psus[0]."\"";
echo ");";
?>
</script>
<script language="JavaScript" src="../js/mng/g.js"></script>
