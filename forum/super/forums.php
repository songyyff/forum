<?php

e_e();

if(isset($_REQUEST['act'])||isset($_REQUEST['move']))include"s/fms.php";
if(isset($_REQUEST['BT']))include"s/fmst.php";

//写入页面内容

echo "<div class=subhead><b>论坛结构管理</b> ",date("Y-m-d H:i:s",time()),"<hr></div>";
$q="select id,pid,name,sfnu,inum,rnum,dnum,drnu,comm,sort,level,stat from tgup order by pid,sort asc";
$R=mysql_query($q) or die(f_e($q));
for($i=0;$r=mysql_fetch_object($R);$i++){
	$fmstr.=($i?",\n":"")."$r->pid,$r->sort,$r->id,\"$r->name\",\"($r->inum/$r->dnum)($r->rnum/$r->drnu)\",$r->level,'$r->stat'";
	echo "<textarea id=gc$r->id class=hfdiv>$r->comm</textarea>";
}
mysql_free_result($R);
echo "<script language=JavaScript>
flist=[$fmstr]
vtype=\"$vtype\"
T=",isset($_REQUEST['fid'])?(int)$_REQUEST['fid']:0,"
</script>";
?>
<?php
$q="select info2 from tdict where type=15 and key1=0";
$R=mysql_query($q) or die(f_e($q));
echo$MWF?"<div class=O style=border-bottom:0>$MWF</div>":"",($t=mysql_fetch_object($R)->info2)?"<div class=O style=border-bottom:0>您修改完论坛结构后要<input type=button value=生成搜索用论坛结构树 onclick=BT()>一次，否则搜索界面中论坛结构会保持不变。<br>论坛已有 <font color=red>$t</font> 次改动！</div>":"";
mysql_free_result($R);
?>
<div id=fmlistdiv class=fmlist></div>
<table><TR><TD>
<p><font color=red><?php echo $msg;?></font></p>
<form method="POST" enctype="multipart/form-data" action="?type=<?php echo $vtype;?>">
<table width=100% border=0 cellpadding=0 cellspacing=5>
<tr>
<TD width=100>论坛名</td>
<td><input type="text" id=fname name=fname class="incomm"><input type="hidden" id=fid name=fid>

<tr>
<TD>
<td>
<select id=stat name=stat><?php 
$q="select * from tdict where type=9 order by key1";
$R=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($R))echo "<option value=$r->info>$r->info2</option>";
mysql_free_result($R);
?></select> 状态 - <select id=level name=level><?php 
$q="select * from tdict where type=5 order by key1";
$R=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($R))echo "<option value=$r->key1>$r->info</option>";
mysql_free_result($R);
?></select> 等级


<tr>
<TD>说明</td>
<td><textarea id=fcom name=fcom rows=5></textarea>

<tr>
<TD>
<td><input type=radio name=act value=0<?php echo $_REQUEST['act']?"":" checked"; ?>>新建子论坛 &nbsp; <input type=radio name=act value=1<?php echo $_REQUEST['act']==1?" checked":""; ?>>修改论坛信息 &nbsp; <input type=radio name=act onclick="javascritp:alert('您确定要删除论坛吗？如果删除，论坛内所有数据将丢失(不可恢复!)。\n建议您可以把论坛失效(用户就不能访问这个论坛)，不要删除!')" value=2<?php echo $_REQUEST['act']==2?" checked":""; ?>><font color="Red">删除论坛</font>

<tr height=34><TD>
<td><table width="100%"><TR><TD><input type=submit value=" 提交(S) " default accesskey="S"><td align="right"><input type=reset value="重置"></table>

</table>
</form>

<td width="10">
<td>
<table>
<TR><TD><TD><input type="button" value="上" onclick="movesite(0)"><TD>
<TR><TD><input type="button" value="左" onclick="movesite(1)"><TD><TD><input type="button" value="右" onclick="movesite(3)">
<TR><TD><TD><input type="button" value="下" onclick="movesite(2)"><TD>
</table>
</table>
<script src=js/fms.js language=JavaScript></script>