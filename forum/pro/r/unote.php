<?php

e_e();

if(1>$cpage=(int)$_REQUEST['page'])$cpage=1;
if(($cpage>$T=ceil($U->inum/$ps=$_SESSION['seitsize']))&&$T)$cpage=$T;

echo "
<script language=javascript>
Pinfo={p:$cpage,R:$U->inum,z:$ps,w:10,u:\"?type=$VT&userid=$U->id&page=\"}
</script>";

?>

<!--div style='padding:2px 5px;border:1px solid blue'><a href=# style="float:right;padding:2px 4px;border:1px solid blue">1/2/3</a> <div style='padding:3 0'><?php echo $U->name;?> 的帖子</div>
</div-->
<table width=100% class=tb cellpadding=1 cellspacing=0><tr><td id=p5 width=153><?php echo $U->name;?> 的帖子<td id=ps1>
</table>
<!--table cellpadding=3 cellspacing=0 id=c><tr><td>1/2/3<td>1<td>2<td>3<td>4<td>5</table-->
<!--td><select><option>abc<option>ced></select-->
<!--table width="100%" class="bar2b" cellpadding=0 cellspacing=0>
<tr><TD width=153 style='padding:5px'><a href=# style='float:right;padding:2px;border:1px solid blue'>1/2/3</a>
</table-->
<table width="100%" id=E style='table-layout:fixed' cellpadding=10 cellspacing=0>
<tr class=O><td style="border-top:0">发表时间 标题 [阅读权限] (访问/回复数) {附件数} .所属论坛 (贴数)<hr>内容快照<hr>最后回复 [回复人] 回复时间
<?php

if($uid=$_SESSION['seuserid']){
$q="select level,rdnum,rigt from tuser where id=$uid";
$R=mysql_query($q) or die(f_e($q));
if($M=mysql_fetch_object($R))
mysql_free_result($R);
}else{class X{var $level=1,$rdnum=0;}$M=new X;}

$q="select i.*,
g.name as gname,g.inum as ginum,g.level as gl,g.stat as gs,g.rigt as gr,
u.rigt as ur,
r.stat as rs,r.rigt as rr,r.content as rc,r.ctime as rtime,
ru.rigt as rur,
s.rigt as sr
from titem as i
left join tgup as g on i.gid=g.id
left join tuser as u on i.uid=u.id
left join trpl as r on r.id=i.lrid and r.iid=i.id
left join tuser as ru on ru.id=r.uid
left join tspu as s use index(unind) on s.uid=$uid and s.gid=i.gid
where i.uid=$U->id order by i.ctime desc limit ".$T=($cpage-1)*$ps.",$ps";
$R=mysql_query($q) or die(f_e($q));
$T+=1;

if($len=mysql_num_rows($R))for($i=0; $i<$len; $i++){

$r=mysql_fetch_object($R);

echo "<tr",$i&1?" class=tr":"","><td><b id=fr>#",$T+$i,"</b>";

if(
($e=$right_saved['superview']&$r->sr)||
$r->gs=='E'&&$r->stat=='E'&&(int)$M->level>=$r->gl
&&$right_saved['userview']&$r->gr
&&($uid?$right_saved['userview']&$M->rigt:$right_saved['guestview']&$r->gr)
){
echo f_date($r->ctime)," <a class=goldlink href=view.php?noteid=$r->id>$r->title</a>",
$r->rdnum?" [$r->rdnum]":"",
" ($r->vnum/$r->rnum)",
$r->adnu?" &#123;$r->adnu&#125;":"",
" .<a href='list.php?groupid=$r->gid'>$r->gname</a> ($r->ginum)<hr>";

if(
($M->rdnum>=$r->rdnum||$uid==$r->uid)
&&$right_saved['userview']&$r->rigt
&&($uid?1:$right_saved['guestview']&$r->rigt)
||$e
){

//快照
echo
$right_saved['userstop']&$r->ur
&&$right_saved['usershow']&$r->rigt&&$right_saved['supershow']&$r->rigt
||$e
?str_replace("<","&lt;",substr($r->content,0,200)):"<del>权限不足，无法内容快照</del>","   ";

//回复
if($r->luid)
echo"<hr><font class=darkfont>",
$r->rs=='E'
&&$right_saved['userview']&$r->rr&&$right_saved['userstop']&$r->rur
&&$right_saved['usershow']&$r->rr&&$right_saved['supershow']&$r->rr
&&($uid?1:$right_saved['guestview']&$r->rr)
||$e
?str_replace("<","&lt;",substr($r->rc,0,200))."   ":"<del>无权查看回复</del>"," [<a class=goldlink href=?userid=$r->luid>$r->luser</a>] ".f_date($r->rtime)."</font>";

}else echo"<del>无权显示内容快照和最后回复</del>";

}else echo"<del>无权查看</del>";

}else echo "<tr height=100><td align=center>--- 没有记录 ---";

mysql_free_result($R);

?>
</table>
<table width=100% class=tb cellpadding=1 cellspacing=0><tr><td class=p5 width=153><?php echo $U->name;?> 的帖子<td id=ps2>
</table>

<script src=../js/pg.js language=javascript></script>