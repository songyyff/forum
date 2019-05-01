<?php e_e();

if(isset($_REQUEST['del'])||isset($_REQUEST['com']))include"s/mytk.php"; //有提交

echo"
<script language=javascript>
PGI={R:$ur->sbnu,M:$ur->maxsb,p:$CP,T:$VT,z:$_S[seitsize],w:10}
</script>
";

?>

<table width=100% class=tb cellpadding=1 cellspacing=0><tr><TD width=100 class=p5>我的订阅<td id=ps1><td width=80 align=right><a href=javascript:submitform() class=whitelink>[ 提交 ]</a></table>

<style>#E i{float:right}</style>

<table width=100% id=E style='table-layout:fixed'cellpadding=10 cellspacing=0>
<tr><td style=border-top:0>删 注 订阅时间 ID.标题 发贴时间 [阅读权限](回复/访问数){附件数} [发贴人] .所属论坛 (贴数) - 快照 - 最近回复 - 注释

<?php

$q="select t.ctime as sbtime,t.comm,
i.*,
u.name as uname,u.rigt as ur,
".(($ism=$_S['seismng'])?"(select s.rigt from tspu as s use index(unind) where s.uid=$ur->id and s.gid=i.gid)as sr,":"")."
r.content as rcon,r.rigt as rr,r.stat as rs,r.uid as ruid,r.ctime as rtime,
ru.name as rname,ru.rigt as rur,
g.stat as gs,g.rigt as gr,g.level,g.name as gname,g.tpnu+g.inum as gnum
from tsubs as t use index(sort)
left join titem as i use index(PRIMARY) on t.iid=i.id
left join tgup as g use index(PRIMARY) on i.gid=g.id
left join tuser as u use index(PRIMARY) on i.uid=u.id
left join trpl as r on i.lrid!=0 and i.lrid=r.id
left join tuser as ru on r.uid=ru.id
where t.uid=".$_S['seuserid']." order by t.ctime desc limit ".($CP-1)*$_S['seitsize'].",".$_S['seitsize'];

$R=mysql_query($q) or die(f_e($q));

if(mysql_num_rows($R))for($i=1;$r=mysql_fetch_object($R);$i++){

echo"<tr",$i&1?"":" class=tr","><td><i>$i#</i><input type=checkbox name=del[] onclick=del(this) value=$r->id><input type=checkbox name=com[] onclick=memo(this) value=$r->id> ",f_date($r->sbtime)," $r->id.";

if(

($s=$right_saved['superview']&$r->sr)||
$r->gs=='E'&&$ur->level>=$r->level
&&$right_saved['userview']&$ur->rigt

){

if(($gv=$right_saved['userview']&$r->gr&&$r->stat=='E')||$s)
echo"<a class=goldlink href='view.php?noteid=$r->id'>$r->title</a> ",
f_date($r->ctime)," ",
$r->rdnum?"[$r->rdnum]":"",
"($r->rnum/$r->vnum)",
$r->adnu?"&#123;$r->adnu&#125;":"",
" [<a class=goldlink href=userinfo.php?userid=$r->uid>$r->uname</a>]";
else echo"<del>$r->title</del>";
echo" .<a class=goldlink href='list.php?groupid=$r->gid'>$r->gname</a> ($r->gnum)<hr>";

echo
$gv&&$right_saved['userview']&$r->rigt
&&($r->rdnum<=$ur->rdnum||$uid==$r->uid)
&&$right_saved['usershow']&$r->rigt&&$right_saved['supershow']&$r->rigt&&$right_saved['userstop']&$r->ur
||$s
?str_replace("<","&lt;",substr($r->content,0,200)):"<del>无权快照$x</del>","   
";

echo
$gv&&$right_saved['userview']&$r->rigt
&&($r->rdnum<=$ur->rdnum||$uid==$r->uid)
&&$r->rs=='E'
&&$right_saved['userview']&$r->rr&&$right_saved['usershow']&$r->rr&&$right_saved['supershow']&$r->rr
&&$right_saved['userstop']&$r->rur
||$s&&$r->lrid
?"<hr><a href=view.php?noteid=$r->id&page=".ceil($r->rnum/$rp=$_S['serpsize'])."#site".($r->rnum%$rp).">$r->lrid</a>.".str_replace("<","&lt;",substr($r->rcon,0,200))."    [<a class=goldlink href=userinfo.php?userid=$r->ruid>$r->rname</a>] ".f_date($r->rtime):"";

}else echo"<del>$r->title</del>";

echo$r->comm?"<hr>$r->comm":"";

}else echo"<tr height=200><td align=center>--- 没有记录 ---";

mysql_free_result($R);

?>
</table>
<table width=100% class=tb cellpadding=1 cellspacing=0><tr><TD width=100 class=p5>我的订阅<td id=ps2><td width=80 align=right><a href=javascript:submitform() class=whitelink>[ 提交 ]</a></table>

<script language=javascript src=js/r/mpg.js></script>
<script language=JavaScript src=js/r/mytk.js></script>