
<script src=js/r/msg0.js language=javascript></script>

<?php e_e();
$Z=$_S[seitsize];
echo "
<script language=javascript>
PGI={R:$msgcount,M:$limt,p:$CP,T:$VT,z:$Z,w:10}
</script>

<table width=100% class=tb cellpadding=5 cellspacing=0>
<tr><TD width=100>$tstr<td class=p1 id=ps1><td align=right><a class=whitelink href='javascript:deletemsg()'>[ 确定 ]</a></table>

<table width=100% id=mrt class=b style='table-layout:fixed;border-top:0;border-bottom:0' cellpadding=5 cellspacing=0>
<tr class=bar3 id=io>
<th width=22>删<th width=110>时间<th>标题 ",$T=$VT?$VT==1?"接收":"接收/发送":"发送","人<th width=40>&nbsp;";

$q="select m.*,b.*,u.name as fname
from msg as m 
left join msgs as b on m.mid=b.bid
left join tuser as u on u.id=m.fid
where uid=$su->id and type=$VT order by b.time desc limit ".(($CP-1)*$Z).",$Z";

$R=mysql_query($q) or die(f_e($q));
if($L=mysql_num_rows($R))for($i=0;$i<$L;$i++){
$r=mysql_fetch_object($R);
echo "<tr",$r->fid?"":" class=tr","><TD><input type=checkbox value=$r->id><TD>",f_date($r->time),"<td><a class=goldlink href='javascript:;' onclick=getmsg(this,$r->id)>",$r->rd?$r->til:"<b>$r->til</b>","</a> ",$r->fid?"<a href=\"userinfo.php?userid=$r->fid\">$r->fname</a>":$r->tos,"<td><a class=goldlink href=\"?type=3&",$r->type?"userid=$r->fid&msgid=$r->id\">转发":"msgid=$r->id\">回复","</a>";

}else echo "<tr height=100><td align=center colspan=5>--- 没有记录 ---";
mysql_free_result($R);

echo "</table>

<table width=100% class=tb cellpadding=5 cellspacing=0><tr><TD width=100>$tstr<td class=p1 id=ps2><td align=right><a class=whitelink href='javascript:deletemsg()'>[ 确定 ]</a></table>";

?>

<script language=javascript src="js/r/mpg.js"></script>
<script language=javascript src="js/r/msgs.js"></script>