<?php e_e();

echo "
<script language=javascript>
PGI={R:$msgcount,M:$limt,p:$CP,T:$VT,z:$_SESSION[seitsize],w:10}
</script>

<table width=100% class=tb cellpadding=5 cellspacing=0>
<tr><TD width=100>$tstr<td class=p1 id=ps1><td align=right><a class=whitelink href='javascript:deletemsg()'>[ 确定 ]</a></table>

<table width=100% id=mrt class=b style='table-layout:fixed;border-top:0;border-bottom:0' cellpadding=5 cellspacing=0>
<tr class=bar3>
<th width=22 align=center>删<th width=110>",$T=$VT?$VT==1?"发送":"接收/发送":"接收","时间<th>标题<th width=100>$T","人<th width=40>&nbsp;";

$q="select * from tmsg where uid=\"".$_SESSION['seuserid']."\" ".($VT < 2?"and type=\"$VT\" and del=0":"and del>0")." order by stime desc limit ".($CP-1)*$_SESSION['seitsize'].",".$_SESSION['seitsize'].";";

$R=mysql_query($q) or die(f_e($q));
if($L=mysql_num_rows($R))for($i=0;$i<$L;$i++){
$r=mysql_fetch_object($R);
echo "<tr",$VT<2?" class=tr":($r->type?"":" class=tr"),"><TD><input type=checkbox name=delmsg[] value=$r->id><TD>",f_date($r->stime),"<td><a class=goldlink href='javascript:;' onclick='return getmsg(this,$r->id)'>",$r->isrd=='u'?"<b>$r->title</b>":$r->title,"</a><td><a class=goldlink href=\"userinfo.php?userid=$r->fid\">$r->fname</a><td><a class=goldlink href=\"?type=3&",$r->type?"userid=$r->fid&msgid=$r->id\">再发":"msgid=$r->id\">回复","</a>";

//echo "<hr><tt style='float:right'> <a class=goldlink href=\"userinfo.php?userid=$r->fid\">$r->fname</a> <a class=goldlink href=\"?type=3&".($r->type?"userid=$r->fid&msgid=$r->id\">再发":"msgid=$r->id\">回复")."</a></tt><input type=checkbox name=delmsg[] value=$r->id> ",f_date($r->stime)," <a class=goldlink href='javascript:;' onclick='return getmsg(this,$r->id)'>",$r->isrd=='u'?"<b>$r->title</b>":$r->title,"</a>";

}else echo "<tr height=100><td align=center colspan=5>--- 没有记录 ---";
mysql_free_result($R);

echo "</table>

<table width=100% class=tb cellpadding=5 cellspacing=0><tr><TD width=100>$tstr<td class=p1 id=ps2><td align=right><a class=whitelink href='javascript:deletemsg()'>[ 确定 ]</a></table>";

?>

<script language=javascript src="js/r/mpg.js"></script>
<script language=javascript src="../js/tag.js"></script>
<script language=javascript src="../js/xhttp.js"></script>
<script language=javascript><?php echo "var pagetype=$VT,currentpage=$CP;";?></script>
<script language=javascript src="js/r/msgs.js"></script>