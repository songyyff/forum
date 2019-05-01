<?php

e_e();

if(1>$cpage=(int)$_REQUEST['page'])$cpage=1;
if(($cpage>$T=ceil($U->rnum/$ps=$_SESSION['seitsize']))&&$T)$cpage=$T;

echo "
<script language=javascript>
Pinfo={p:$cpage,R:$U->rnum,z:$ps,w:10,u:'?type=$VT&userid=$U->id&page='}
</script>";
?>

<table width=100% class=tb cellpadding=1 cellspacing=0><tr><td class=p5 width=153><?php echo $U->name;?> 的回复<td id=ps1>
</table>

<table width=100% id=E style=table-layout:fixed cellpadding=10 cellspacing=0>
<tr class=O><TD style='border-top:0'>发表时间 编号 {附件数} -所属帖子 (回复/访问){附件数}[帖子发表人] .所属论坛 (贴数)<hr>内容快照
<?php

if($uid=$_SESSION['seuserid']){
$q="select level,rdnum,rigt from tuser where id=$uid";
$R=mysql_query($q) or die(f_e($q));
if($M=mysql_fetch_object($R))
mysql_free_result($R);
}else{class X{var $level=1,$rdnum=0;}$M=new X;}

$q="select r.*,
i.gid,i.uid as iuid,i.title as ttitle,i.rnum,i.vnum,i.adnu as tadnu,i.rdnum,i.stat as it,i.rigt as ir,
g.name as gname,g.inum as ginum,g.level as gl,g.stat as gs,g.rigt as gr,
u.name as iname,u.rigt as ur,
s.rigt as sr
from trpl as r
left join titem as i on r.iid=i.id
left join tgup as g on i.gid=g.id
left join tuser as u on r.uid=u.id
left join tspu as s use index(unind) on s.uid=$uid and s.gid=i.gid
where r.uid=$U->id order by r.ctime desc limit ".$T=($cpage-1)*$ps.",$ps";$R=mysql_query($q) or die(f_e($q));
$T+=1;
$z=$_SESSION['serpsize'];

if($len=mysql_num_rows($R))for($i=0; $i<$len; $i++){
$r=mysql_fetch_object($R);

echo"
<tr",$i&1?" class=tr":"","><TD><b id=fr>",$T+$i,"#</b>";

if(
($m=$right_saved['superview']&$r->sr)||
$r->it=='E'&&$r->gs=='E'&&$r->stat=='E'&&(int)$M->level>=$r->gl
&&$right_saved['userview']&$r->gr
&&($uid?$right_saved['userview']&$M->rigt:$right_saved['guestview']&$r->gr)
){

echo f_date($r->ctime);

if(

$e=
$right_saved['userstop']&$r->ur
&&$right_saved['userview']&$r->ir&$r->rigt&&$right_saved['usershow']&$r->rigt&&$right_saved['supershow']&$r->rigt
&&($ir->rdnum<=$M->rdnum||$uid==$ir->uid)
&&($uid?1:$right_saved['guestview']&$r->ir&$r->rigt)
||$m

)echo" <a class=goldlink href=view.php?noteid=$r->iid&page=",ceil($r->pos/$z),"#site",$r->pos%$z,">$r->id</a>",
$r->adnu?"&nbsp;&#123;$r->adnu&#125;":"";
else echo" <del>无权显示标题</del>";

echo " -<a href='view.php?noteid=$r->iid'>$r->ttitle</a> ($r->rnum/$r->vnum)",
$r->adnu?" &#123;$r->tadnu&#125;":"",
"[<a href='?userid=$r->iuid'>$r->iname</a>]
 .<a class=goldlink href='list.php?groupid=$r->gid'>$r->gname</a> ($r->ginum)<hr>",

//快照
$e?str_replace("<","&lt;",substr($r->content,0,200)):"<del>权限不足，无法快照内容</del>","   ";

}else echo "<del>您权限不够，无权查用户看内容。</del>";

}else echo"<tr height=100><td align=center>--- 没有记录 ---";
mysql_free_result($R);
?>

</table>

<table width=100% class=tb cellpadding=1 cellspacing=0><tr><td class=p5 width=153><?php echo $U->name;?> 的回复<td id=ps2>
</table>

<script src='../js/pg.js' language=javascript></script>