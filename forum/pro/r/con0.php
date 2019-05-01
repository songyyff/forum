<?php e_e();

$Z=$_S['seitsize'];
echo"<p class=O>快速浏览</p>";

if($ur->nmnu){
$q="select m.*,b.*,u.name
from msg as m use index(msg)
left join msgs as b on m.mid=b.bid
left join tuser as u on m.fid=u.id
where m.uid=$uid and m.type=0 and m.rd=0 order by m.id desc limit ".($CP-1)*$Z.",$Z";
$R=mysql_query($q) or die(f_e($q));
echo "<table width=100% class=x cellpadding=1 cellspacing=0><tr><TD width=100 class=p5>未读消息</td><td id=ps1><td align=right><a class=whitelink href='msgs.php'>[ 消息箱 ]</a></table><p class=hfdiv id=ps2></p>

<table width=100% id=mrt class=b style='table-layout:fixed' cellpadding=5 cellspacing=0>
<tr><td style='border-top:0'>接收时间 标题 .发送人";
if(mysql_num_rows($R))for($i=0;$r=mysql_fetch_object($R);$i++){
echo "<tr class=tr><td><a id=fr class=goldlink href='?type=3&msgid=$r->id'>回复</a>",f_date($r->time)," <a class=goldlink href='javascript:;' onclick=getmsg(this,$r->id)>$r->til</a> .<a href='userinfo.php?userid=$r->fid'>$r->name</a>";
}else echo"<tr><td align=center>--- 没有消息 ---";
echo"</table>
<script language=JavaScript src='js/r/msg0.js'></script>
<script language=JavaScript src='js/r/conl.js'></script>
<script language=JavaScript>
Pinfo={p:$CP,R:$ur->nmnu,z:$Z,w:10,u:'?type=$VT&page='}
</script>
<script language=JavaScript src='../js/pg.js'></script>
";
mysql_free_result($R);
}
?>

<p id=o><tt id=fr><?php echo$ur->sbnu>$Z?$Z:$ur->sbnu,"/$ur->sbnu";if($ur->sbnu>$Z)echo"<td align=right><a class=whitelink href='myself.php'>[ 所有订阅 ]</a>";?></tt>我的订阅</p>
<style>#E i{float:right}p{margin:0}</style>
<table width=100% id=E style='table-layout:fixed' cellpadding=5 cellspacing=0>
<tr><td>订阅时间 ID.标题 发贴时间 [阅读权限](回复/访问数){附件数} [发贴人] .所属论坛 (贴数) - 快照 - 最后回帖 - 注释<?php

$M="<tr height=200><td align=center>--- 没有记录 ---";

if($ur->sbnu){

$q="select t.ctime as sbtime,t.comm,
i.*,
u.name as uname,u.rigt as ur,
".(($ism=$_S['seismng'])?"(select s.rigt from tspu as s use index(unind) where s.uid=$uid and s.gid=i.gid)as sr,":"")."
r.id as rid,r.content as rcon,r.rigt as rr,r.stat as rs,r.uid as ruid,r.ctime as rtime,
ru.name as rname,ru.rigt as rur,
g.stat as gs,g.rigt as gr,g.level,g.name as gname,g.tpnu+g.inum as gnum
from tsubs as t use index(sort)
left join titem as i use index(PRIMARY) on t.iid=i.id
left join tgup as g use index(PRIMARY) on i.gid=g.id
left join tuser as u use index(PRIMARY) on i.uid=u.id
left join trpl as r on i.lrid!=0 and i.lrid=r.id
left join tuser as ru on r.uid=ru.id
where t.uid=$uid order by t.ctime desc limit $Z";

$R=mysql_query($q) or die(f_e($q));

if(mysql_num_rows($R))for($i=1;$r=mysql_fetch_object($R);$i++){

echo"<tr",$i&1?"":" class=tr","><td><i>$i#</i>",f_date($r->sbtime)," $r->id.";

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
?str_replace("<","&lt;",substr($r->content,0,200)):"<del>无权快照</del>","   
";

echo
$gv&&$right_saved['userview']&$r->rigt
&&($r->rdnum<=$ur->rdnum||$uid==$r->ruid)
&&$r->rs=='E'
&&$right_saved['userview']&$r->rr&&$right_saved['usershow']&$r->rr&&$right_saved['supershow']&$r->rr
&&$right_saved['userstop']&$r->rur
||$s&&$r->lrid
?"<hr><a href=view.php?noteid=$r->id&page=".ceil($r->rnum/$rp=$_S['serpsize'])."#site".($r->rnum%$rp).">$r->rid</a>. ".str_replace("<","&lt;",substr($r->rcon,0,200))."    [<a class=goldlink href=userinfo.php?userid=$r->ruid>$r->rname</a>] ".f_date($r->rtime):"";

}else echo"<del>$r->title</del>";

echo$r->comm?"<hr>$r->comm":"";

}else echo$M;

mysql_free_result($R);

}else echo$M;

?>
</table>

<p class=O>快速浏览