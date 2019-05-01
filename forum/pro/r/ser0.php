<?php

e_e();

if(isset($_R['RI']))include"s/ser0.php";

$q="select pid,id,gps,ups,name,stat,level,rigt,tpnu,inum,rnum,vnum from tgup use index(".($c=$uid?"u":"g")."ps)WHERE {$c}ps!=0";
$H=mysql_query($q) or die(f_e($q));
echo"
<script language=javascript>
",
$umstr?"SF=[$umstr]
":"",
"fms=[
";
while($r=mysql_fetch_object($H)){
if($uid&&$ur->level<$r->level)continue;
echo"$r->pid,$r->id,\"$r->name (",$r->tpnu+$r->inum,"/$r->rnum/$r->vnum) $r->level\",",
$right_saved['userview']&$r->rigt&&($uid?1:$right_saved['guestview']&$r->rigt),",
";
}
echo"0]
</script>
";
mysql_free_result($H);

?>

<FORM id=mainform method=POST action=?type=0>

<table width=100% class=tb cellpadding=5 cellspacing=0><tr><TD><a class=fr href="javascript:submitform()" class=whitelink>[ 提交 ]</a>快速查询</table>

<div id=X><a id=fr href=javascript:expandsearch() class=whitelink>[<span id=issearch>-</span>]</a>查询条件</div>

<div id=searchdiv style=overflow:hidden>

<div id=o><tt id=fr>[<a class=whitelink href=javascript:setforum(1)>勾选所有</a>] [<a class=whitelink href=javascript:setforum(0)>复位</a>]</tt>钩选目标论坛 (贴子/回复/访问数) 等级</div>

<div id=forumlist class=fmlist></div>

<div class=bp5 style=border-top:0><input type=radio name=RI onclick=IR(1) value=0<?php echo ($IR=$_R['RI'])?"":" checked";?>>查询帖子 <input type=radio name=RI onclick=IR(0) value=1<?php echo$IR?" checked":"";?>>查询回复
</div>

<table width=100% class=b style=border-top:0;border-bottom:0 cellpadding=5 cellspacing=0>

<tr><td width=150><input type=radio id=U1 name=UT value=0<?php echo ($t=$_R['UT'])?"":" checked";?>>用户名 <input type=radio id=U2 name=UT value=1<?php echo $t?" checked":"";?>>用户id<td width=150><input type=text id=U name=U value="<?php echo f_rpspc(trim($_R['U']));?>"><td>不填(表示所有)或只能填一个
	
<tr><TD><tt id=TT><?php echo$IR?"回复":"帖子";?></tt>编号<td><input type=text id=id name=id e value="<?php if($_R['id']!="")echo$_R['id'];?>"><td>显示大于此编号的帖子

<tr><TD><tt id=fr>从</tt>时间范围<td><input type=text id=T1 name=T1 value="<?php echo$_R['T1']; ?>"><td>格式为 <?php echo date("Y-m-d H:i:s"); ?>

<tr><td align=right>到<td><input type=text id=T2 name=T2 value="<?php echo$_R['T2']; ?>"><td>格式同上，或不填，表示当前时间。


<tr><TD>按附件<td><input type=text id=AN name=AN value=<?php if($_R['AN']!="")echo$_R['AN']; ?>><td>个附件

</table>

</div>

<SCRIPT language=JavaScript src="../js/js.js"></script>
<SCRIPT language=JavaScript src="js/r/ser0.js"></SCRIPT>
<?php if(isset($_R['RI']))include "s/ser00.php"; ?>

<table width=100% class=tb cellpadding=5 cellspacing=0><tr><TD><a class=fr href="javascript:submitform()" class=whitelink>[ 提交 ]</a>快速查询</table>