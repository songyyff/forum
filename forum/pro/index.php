<?php include"../func/mustfunc.php";?>

<html>

<head>
<title>论坛列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../theme/<?php echo $_S['sestyle']; ?>/def.css">
<script language="JavaScript" src="../js/js.js"></script>
</head>

<body>

<?php

include"../hefo/head.php"; 

echo"<div class=gud>论坛首页</div>";

$q="select rigt,level,gmnu from tuser where id=".($uid=$_S['seuserid'])." and stat='E'";
$R=mysql_query($q) or die(f_e($q));
if($r=mysql_fetch_object($R)){mysql_free_result($R);$ur=$r->rigt;$ul=$r->level;$umg=$r->gmnu;}else$ul=1;

$GL=array();
$q="select key1,info from tdict where type=5 and key1<=$ul order by key1";
$R=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($R))$GL[$r->key1]=$r->info;

$q="select *".($umg?",(select rigt from tspu use index(unind) where uid=$uid and gid=tgup.id) as sr":"")." from tgup where pid=0 and stat='E' and level<=$ul order by sort asc;";
$M=mysql_query($q) or die(f_e($q));

$q="select g.sort as msort,h.*
".($umg?",(select rigt from tspu as s use index(unind) where s.gid=h.id and s.uid=$uid) as sr":"")."
from tgup as g
left join tgup as h on h.pid=g.id and h.stat='E' and h.level<=$ul
where g.pid=0 and g.stat='E' and g.level<=$ul order by msort,h.sort asc;";
$R=mysql_query($q) or die(f_e($q));

echo"
<style>
#mrt td{vertical-align:top;color:#555555}
#mrt th{padding:0}
#mrt img{vertical-align:top;margin-right:1px;}
#mrt tt{float:right;}
</style>
<table id=mrt width=100% style='table-layout:fixed' cellpadding=5 cellspacing=0>
<tr><th width=60><th width=270><th>
";

$c=0;$rs=$_S['serpsize'];

while($r=mysql_fetch_object($M)){
show($r);
while(($c||$c=mysql_fetch_object($R))&&$c->pid==$r->id){
show($c);$c=0;
}

}
mysql_free_result($M);
mysql_free_result($R);

echo"</table>";

function show($r){
global $GL,$right_saved,$uid,$rs;
echo"<tr",$r->msort?"":" class=tr","><td><img width=50 src=../icons/f/$r->id.gif><br><td><pre><tt>lv{$GL[$r->level]}</tt><a class=goldlink href=list.php?groupid=$r->id>$r->name</a> ($r->tpnu/$r->inum/$r->rnum/$r->vnum)
$r->comm
<tt>",substr($r->ctime,2,8),"</tt>版主:";
$q="select *,(select name from tuser where id=tspu.uid) as username from tspu where gid=$r->id order by level asc;";
$R=mysql_query($q) or die(f_e($q));
while ($m=mysql_fetch_object($R))
echo " <a href=userinfo.php?userid=$m->uid>$m->username</a>";
mysql_free_result($R);
echo"<td>";

if($right_saved['userview']&$r->rigt)
if(!($uid||$right_saved['guestview']&$r->rigt))echo"<tt>您还未登陆,无法浏览此论坛.";
elseif($r->inum){
$q="select i.*,u.name,u.rigt as ur
from titem as i use index(gl)
left join tuser as u on u.id=i.uid
where i.gid=$r->id and i.stat='E' and type=1 order by ltime desc limit 7";
$R=mysql_query($q) or die(f_e($q));
while($i=mysql_fetch_object($R))
echo"
",$i->rnum?"<a id=fr href=view.php?noteid=$i->id&page=".ceil($i->rnum/$rs)."#site".$i->rnum%$rs.">".substr($i->ltime,2):"","<a href=view.php?noteid=$i->id>$i->title</a> ",substr($i->ctime,2)," ",$i->rdnum?"[$i->rdnum]":"","($i->rnum/$i->vnum)",
$i->pici?" <img src='../images/p1.gif'>$i->pici":"",
$i->athi?" <img src='../images/f.gif'>$i->athi":"",
$i->adoi?" <img src='../images/m.gif'>$i->adoi":"",
$i->vdoi?" <img src='../images/v1.gif'>$i->vdoi":"",
" [<a href=userinfo.php?userid=$i->uid>$i->name</a>] <br>";
mysql_free_result($R);
}else echo"<tt>坛内还未有帖子,正期待您的发表.";
else echo"<tt>论坛阅览当前被关闭了.";
}

?>

<script language="JavaScript" src="../js/pro/ie.js"></script>
<?php include "../hefo/foot.php"; ?>
</body>
</html>