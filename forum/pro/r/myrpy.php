<?php e_e();

if($len=count($_REQUEST['closereplay'])){ //有提交
$delstr="";
for($i=0;$i<$len;$i++)$delstr.=($i?",":"")."\"".(int)$_REQUEST['closereplay'][$i]."\"";
$q="update trpl set rigt=rigt^".$right_saved['usershow']." where id in ($delstr) and uid=$ur->id;";
mysql_query($q) or die(f_e($q));
}
if(isset($_REQUEST['rule']))$_SESSION['usemng']=!$_SESSION['usemng'];

if(($CP>$T=ceil(($A=$ur->rnum+$ur->drnu)/$ps=$_SESSION['seitsize']))&&$T)$CP=$T;
echo "
<script language=javascript>
Pinfo={p:$CP,R:$A,z:$ps,w:10,u:\"?type=$VT&page=\"}
</script>
";

?>
<table width=100% class=tb cellpadding=1 cellspacing=0><tr><TD width=100 id=p5>我的回复<td id=ps1><td width=100 align=right><a href="javascript:submitform()" class=whitelink>[ 提交 ]</a></table>

<table width=100% id=E style='table-layout:fixed' cellpadding=10 cellspacing=0>
<tr><TD style='border-top:0'><?php if($ur->gmnu)echo" <input type=checkbox name=rule> 使用",$_SESSION['usemng']?"普通用户":"管理员","模式查看<hr>";?>开/关 发表时间 ID. {附件数} -从属帖子 [阅读权](回复/访问数){附件数} .所属论坛 (贴数) - 快照[状态]

<?php

$q="select r.*,
i.gid,i.title as itil,i.rnum,i.vnum,i.adnu as iadnu,i.rigt as ir,i.stat as si,i.rdnum,i.ctime as itime,
u.rigt as ur,u.name as uname,u.id as iuid,
s.rigt as sr,
g.name as gname,g.inum as ginum,g.stat as gs,g.rigt as gr,g.level
from trpl as r force index(ut)
left join titem as i on r.iid=i.id
left join tuser as u on i.uid=u.id
left join tgup as g on i.gid=g.id
left join tspu as s use index(unind) on s.uid=$ur->id and s.gid=g.id
where r.uid=$ur->id order by r.ctime desc limit ".($CP-1)*$_SESSION['seitsize'].",".$_SESSION['seitsize'];

$R=mysql_query($q) or die(f_e($q));

if(mysql_num_rows($R))for($i=1;$r=mysql_fetch_object($R);$i++){

$s=$right_saved['superview']&$r->sr&&$_SESSION['usemng'];

echo"<tr",$i&1?" class=tr":"","><td><i id=fr>$i#</i><input type=checkbox name=closereplay[] value=$r->id> ",f_date($r->ctime)," <a class=goldlink href=view.php?noteid=$r->iid&page=".ceil($r->pos/$_SESSION['serpsize'])."#site".($r->pos%$_SESSION['serpsize']-1)." target=_blank>$r->id</a>.",
$r->adnu?"&#123;$r->adnu&#125;":"",
" -",
($m=$r->gs=='E'&&$r->level<=$ur->level||$s)?
(($y=$r->si=='E'
&&$right_saved['userview']&$r->gr&$ur->rigt
&&$right_saved['userstop']&$r->ur
||$s)
?"":"<del>").
"<a class=goldlink href=view.php?noteid=$r->iid target=_blank>$r->itil</a>".
($y?"":"</del>")
:"<del>无权查看</del>",
" ",
$r->rdnum?"[$r->rdnum]":"",
"($r->rnum/$r->vnum)",
$r->iadnu?"&#123;$r->iadnu&#125;":"",
"[<a href=userinfo.php?userid=$r->iuid target=_blank>$r->uname</a>] .",
$m?"<a class=goldlink href='list.php?groupid=$r->gid'>$r->gname</a> ($r->ginum)":"<del>无权查看</del>",
"<hr>",
$m?(($t=$r->stat=='E'&&$r->si=='E'
&&($r->rdnum<=$ur->rdnum||$r->iuid==$ur->id)
&&$right_saved['userview']&$r->gr&$r->ir&$r->rigt&$ur->rigt
&&$right_saved['userstop']&$ur->rigt
&&$right_saved['usershow']&$r->rigt&&$right_saved['supershow']&$r->rigt
||$s)?"":"<del>").str_replace("<","&lt;",substr($r->content,0,200))."    ".($t?"":"</del>"):"<del>无权查看</del>",
$right_saved['usershow']&$r->rigt?"":"[关闭]",
" <a class=goldlink href=edit.php?actionid=$r->id&type=3&extra=$r->iid","p",ceil($r->pos/$_SESSION['serpsize']),"s",$r->pos%$_SESSION['serpsize'],">编辑</a>";

}else echo"<tr height=100><td align=center>--- 没有记录 ---";

mysql_free_result($R);
?>
</table>
<table width=100% class=tb cellpadding=1 cellspacing=0><tr><TD width=100 id=p5>我的回复<td id=ps2><td width=100 align=right><a href="javascript:submitform()" class=whitelink>[ 提交 ]</a></table>

<script src='../js/pg.js' language=javascript></script>
<script language=JavaScript src="js/r/myrpy.js"></script>