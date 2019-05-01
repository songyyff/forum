<?php 

function f_mtime(){list($u,$s)=explode(" ",microtime()); return ((float)$u+(float)$s);}

e_e();

$Z=20;
$P=(int)$_R[page];
$P=$P<1?1:$P;

$q="select ".($b?"r.content as rcon,r.title as rtil,r.uid as ruid,r.ctime as rtime,r.rigt as rr,r.stat as rs,r.adnu as radnu,
ru.name as rname,ru.rigt as rur,":"").
"i.*,
g.name as gname,g.rigt as gr,g.inum as ginum,g.level,g.stat as gs,
u.name as uname,u.rigt as ur
from ".($b?"trpl as r
left join tuser as ru on r.uid=ru.id
left join titem as i on r.iid=i.id
":"titem as i")."
left join tgup as g on i.gid=g.id
left join tuser as u on i.uid=u.id
where match(".($b?"r":"i").".title,".($b?"r":"i").".content) against(\"$S\") limit ".($P-1)*$Z.",$Z";

$starttime=f_mtime();
$R=mysql_query($q) or die(f_e($q));
$endtime=f_mtime();
$l=mysql_num_rows($R);

echo"
<style>
p{margin:10 0px;width:500px}
p tt{font-size:90%;color:#666666}
</style>
<tr><td class=bt><tt id=fr>用时 ",substr($endtime-$starttime,0,8)," 秒</tt>查到 $l 条记录",
$l?"<tr><td>":"";

$i=($P-1)*$Z;
while($r=mysql_fetch_object($R)){

$i++;

echo"<p><I id=fr>#$i</I>";

if(
$r->gs=='E'&&$r->stat=='E'&&($b?$r->rs=='E':1)
&&(int)$r->level<=($uid?$ur->level:1)
&&$right_saved['userview']&$r->gr
&&($uid?$right_saved['userview']&$ur->rigt:$right_saved['guestview']&$r->gr)
){

if(
$rr=
$right_saved['userstop']&$r->rur
&&$right_saved['userview']&$r->rr&&$right_saved['usershow']&$r->rr&&$right_saved['supershow']&$r->rr
&&$right_saved['userview']&$r->rigt
&&($uid?$r->rdnum<=$ur->rdnum||$uid==$r->uid:!$r->rdnum)
&&($uid?1:$right_saved['guestview']&$r->rr&$r->rigt)
){

echo"<a class=itemlink href=view.php?noteid=$r->id&page=",ceil($r->pos/$Z),"#site",$r->pos%$Z," target=_blank>$r->rtil</a>",
$r->radnu?" &#123;$r->radnu&#125;":"",
" <font class=darkfont>[<a href=userinfo.php?userid=$r->ruid>$r->rname</a>]</font> .";

}elseif($b)echo"<del>无权查看</del> .";


echo"<a class=itemlink href=view.php?noteid=$r->id>$r->title</a> ",
$r->rdnum?"[$r->rdnum]":"",
"($r->rnum/$r->vnum)",
$r->adnu?"&#123;$r->adnu&#125;":"",
" [<a href=userinfo.php?userid=$r->uid>$r->uname</a>]
.<a href=list.php?groupid=$r->gid>$r->gname</a> ($r->ginum)
<br><tt>";

if($b){if($rr)echo str_replace("<","&lt;",substr($r->rcon,0,400)),"   ";}
else echo$right_saved['userstop']&$r->ur
&&$right_saved['userview']&$r->rigt
&&$right_saved['usershow']&$r->rigt&&$right_saved['supershow']&$r->rigt
&&($uid?$r->rdnum<=$ur->rdnum||$uid==$r->uid:!$r->rdnum)
&&($uid?1:$right_saved['guestview']&$r->rigt)
?str_replace("<","&lt;",substr($r->content,0,400)):"<del>无权查看</del>","   ";

echo"</tt><br>",$b?$r->rtime:$r->ctime;

}else echo"<del>无权查看b</del> ",$b?$r->rtime:$r->ctime;

}

if($l==$Z||$CP>1)echo"
<tr><td id=ps>
<script language=javascript>
var P=$P,E=",$l==$Z?1:0,"
</script>
<script language=javascript src=js/r/ser1.js></script>
";