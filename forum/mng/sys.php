<?php e_e(); 

if(isset($_REQUEST['selboxtype']))include"syssub.php";
?>
<form id=mainform enctype="multipart/form-data" method="POST" onsubmit="return submitform()">
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="108">&nbsp;管理维护</TD><td>&nbsp;</td>
<td width="100" align="right" class="pdtb1p"><input type=submit value=" 提交 ">&nbsp;</td>
</tr>
</table>
<table width="100%" class="bar3" border=1 cellpadding=0 cellspacing=0><tr height=23><TD width=100>&nbsp;管理箱维护</td><td>&nbsp;</td></tr></table>
<table width="100%" class=bd1 border=1 cellpadding=0 cellspacing=0><tr><TD class=pd1>
<table width="100%" border=1 cellpadding=0 cellspacing=0>
<tr height=22 class=darkbar  align=center><td class=bdb1 width=50>类型</td><td class=bdb1 width=40>改名</td><td class=bdb1 align=left>箱子名称</td><td width=100 class=bdb1 align=center>元素量</td><td class=bdb1 width=60>重算数量</td><td class=bdb1 width=60>删除</td></tr>
<?php 
$q="select * from tmng where uid=$uid and type>4 and type<8";
$result=mysql_query($q) or die(f_e($q));
$len=mysql_num_rows($result);
for($i=0;$i<$len;$i++){
	$row=mysql_fetch_object($result);
	$vid=$row->num<<4|$row->type;
	echo "<tr height=22 class=".($i&1?"dark":"light")."bar align=center>".
	"<td>".($row->type==7?"用户":($row->type==5?"帖子":"<font class=warningc>回复</font>"))."</td>".
	"<td><input type=checkbox id=rn$vid name=rename[] value=$vid onclick=\"ckren(this)\"></td>".
	"<td align=left id=ntd$vid>".($row->num==2?"<font class=\"warningc\">$row->comm</font>":$row->comm)."</td>".
	"<td>$row->box</td>".
	"<td><input type=checkbox id=rc$vid name=recnt[] value=$vid></td>".
	"<td>".($row->box||$row->num==2?"&nbsp;":"<input type=checkbox name=del[] value=$vid onclick=\"ckdel(this)\">")."</td></tr>\n";
}
mysql_free_result($result);
?>
</table>
<table width="100%" class=bdt1 border=1 cellpadding=0 cellspacing=0>
<tr height=32 class=darkbar>
<td width=90>&nbsp;新管理箱</td>
<td width=50>
<select name=selboxtype>
<?php
$sels=array("帖子","回复","用户");
for($i=0;$i<3;$i++)echo "<OPTION value=$i".($_REQUEST['selboxtype']==$i?$d:"").">".$sels[$i]."</OPTION>";
?>
</select>
</td>
<td><input type="text" name=newbox></td>
</tr>
</table>
</TD></tr></table>
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr>
<TD width="108">&nbsp;管理维护</td>
<TD>&nbsp;</td>
<td width="100" align="right" class="pdtb1p"><input type=submit value=" 提交 ">&nbsp;</td>
</tr>
</table>
</FORM>
<script language="JavaScript" src="../js/mng/sys.js"></script>