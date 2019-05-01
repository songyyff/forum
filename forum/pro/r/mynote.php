<?php

e_e();

if($len=count($_REQUEST['closenote'])){ //有提交
$delstr="";
for($i=0;$i<$len;$i++)$delstr.=($i?",":"")."\"".(int)$_REQUEST['closenote'][$i]."\"";
$q="update titem set rigt=rigt^".$right_saved['usershow']." where id in ($delstr) and uid=$ur->id;";
mysql_query($q) or die(f_e($q));
}
if(isset($_REQUEST['rule']))$_SESSION['usemng']=!$_SESSION['usemng'];

if(($CP>$T=ceil(($A=$ur->inum+$ur->dnum)/$ps=$_SESSION['seitsize']))&&$T)$CP=$T;
echo "
<script language=javascript>
Pinfo={p:$CP,R:$A,z:$ps,w:10,u:\"?type=$VT&page=\"}
</script>";

?>
<table width=100% class=tb cellpadding=1 cellspacing=0><tr><TD width=100 id=p5>我的帖子<td id=ps1><td width=100 align=right><a href=javascript:submitform() class=whitelink>[ 提交 ]</a></table>

<table width=100% id=E style=table-layout:fixed cellpadding=10 cellspacing=0>
<tr><TD style=border-top:0><?php if($ur->gmnu)echo" <input type=checkbox name=rule> 使用",$_SESSION['usemng']?"普通用户":"管理员","模式查看<hr>";?>开/关 发表时间 ID.标题 [阅读权限](回复/访问数){附件数} .所属论坛 (贴数) - 快照[状态] - 最后回复

<?php

$q="select i.*,
r.content as rcon,r.rigt as rr,r.stat as rs,r.ctime as rtime,r.uid as ruid,
ru.name as ru,ru.rigt as rur,
g.name as gname,g.inum as ginum,g.stat as gs,g.level,g.rigt as gr,
s.rigt as sr
from titem as i force index(self)
left join tgup as g on i.gid=g.id
left join trpl as r on i.lrid!=0 and i.lrid=r.id
left join tuser as ru on r.uid=ru.id
left join tspu as s on s.uid=$ur->id and s.gid=i.gid
where i.uid=$ur->id order by i.ctime desc limit ".($CP-1)*$_SESSION['seitsize'].",".$_SESSION['seitsize'];

$R=mysql_query($q) or die(f_e($q));
if($l=mysql_num_rows($R))for($i=1;$r=mysql_fetch_object($R);$i++){

$s=$right_saved['superview']&$r->sr&&$_SESSION['usemng'];

echo"<tr",$i&1?" class=tr":"","><td><i id=fr>$i#</i><input type=checkbox name=closenote[] value=$r->id> ",f_date($r->ctime)," $r->id.";

if($r->gs=='E'&&$r->level<=$ur->level||$s)
echo
($t=$r->stat=='E'&&$right_saved['userview']&$r->gr&$ur->rigt||$s)
?"":"<del>",
"<a class=goldlink href=view.php?noteid=$r->id target=_blank>$r->title</a>",
$t?"":"</del>",
" ",
$r->rdnum?"[$r->rdnum]":"",
"($r->rnum/$r->vnum)",
$r->adnu?"&#123;$r->adnu&#125;":""
;
else echo"<del>无权查看</del>";

echo
$r->gs=='E'&&$r->level<=$ur->level||$s
?" .<a class=goldlink href=list.php?groupid=$r->gid target=_blank>$r->gname</a> ($r->ginum)":"<del>无权查看</del>";

echo"<hr>",

$r->gs=='E'&&$r->level<=$ur->level||$s
?(
$r->stat=='E'
&&$right_saved['userview']&$r->gr&$r->rigt&$ur->rigt
&&$right_saved['userstop']&$ur->rigt
&&$right_saved['usershow']&$r->rigt&&$right_saved['supershow']&$r->rigt
||$s
?str_replace("<","&lt;",substr($r->content,0,300))."   ":
"<del>".str_replace("<","&lt;",substr($r->content,0,300))."   </del>".($right_saved['usershow']&$r->rigt?"":"[关闭]")

):"<del>无权快照</del>",

" <a href=edit.php?actionid=$r->id&type=1 target=_blank>编辑</a>",

$r->ruid?"<hr>".(
$r->gs=='E'&&$r->stat=='E'&&$r->rs=='E'&&$r->level<=$ur->level
&&($right_saved['userview']&$r->gr&$r->rigt&$r->rr&$ur->rigt
&&$right_saved['usershow']&$r->rr&&$right_saved['supershow']&$r->rr
&&$right_saved['userstop']&$r->rur||$r->ruid==$uid)
||$s
?"<font class=darkfont>".str_replace("<","&lt;",substr($r->rcon,0,200))."    [<a class=goldlink href=userinfo.php?userid=$r->ruid target=_blank>$r->luser</a>] ".f_date($r->rtime)."</font>":"<del>无权查看</del>"
):"";

}else echo"<tr height=100><td align=center>--- 没有记录 ---";

mysql_free_result($R);

?>

</table>
<table width=100% class=tb cellpadding=1 cellspacing=0><tr><TD width=100 id=p5>我的帖子<td id=ps2><td width=100 align=right><a href=javascript:submitform() class=whitelink>[ 提交 ]</a></table>

<script src='../js/pg.js' language=javascript></script>
<script language="JavaScript" src="js/r/mynt.js"></script>