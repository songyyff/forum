<?php e_e();
if(isset($_R['delfrid'])||isset($_R['altfrid']))include"s/myfd.php"; 

echo"<script language=javascript>
PGI={R:$ur->fnum,M:$ur->maxf,p:$CP,T:$VT,z:$_S[seitsize],w:10}
</script>
";
?>

<table width=100% class=tb cellpadding=1 cellspacing=0><tr><TD width=100 class=p5>我的好友<td id=ps1><td width=80 align=right><a href="javascript:submitform()" class=whitelink>[ 提交 ]</a></table>

<table width=100% id=mrt style='table-layout:fixed;empty-cells:show;' cellpadding=5 cellspacing=0><thead><Th width=30 align=center>删<Th width=110>加入时间<th width=100>好友<th>说明<th width=40>修改<th width=40>在线<th width=50>发消息<tbody><?php

$q="select t1.ctime as adtime,t1.comm,t2.ltime,t2.name,t2.id from tfrid as t1 use index(uid) left join tuser as t2 on t1.fid=t2.id where t1.uid=".$_S['seuserid']." and t1.type=0 order by t2.ltime desc limit ".($CP-1)*$_S['seitsize'].",".$_S['seitsize'];

$R=mysql_query($q) or die(f_e($q));

if($l=mysql_num_rows($R))for($i=0;$i<$l;$i++){

$row=mysql_fetch_object($R);

echo"<tr class=",$i&1?"":"tr","><td><input type=checkbox name=delfrid[] onclick=\"clickdel(this)\" value=$row->id><td>",f_date($row->adtime),"<td><a class=goldlink href=\"userinfo.php?userid=$row->id\">$row->name</a><td>",$row->comm?$row->comm:"&nbsp;","<td><input type=checkbox name=altfrid[] onclick=\"clickalter(this)\" value=$row->id><td>",f_isonline($row->ltime)?"":"<img src='../images/on.gif'>","<td><a class=goldlink href=\"msgs.php?type=3&userid=$row->id\"><i>三[]</i></a>";

}else echo"<tr height=100><td align=center colspan=7>--- 您还没朋友,要加油喔! ---";

mysql_free_result($R);

?></table>

<table width=100% class=tb cellpadding=1 cellspacing=0><tr><TD width=100 class=p5>我的好友<td id=ps2><td width=80 align=right><a href="javascript:submitform()" class=whitelink>[ 提交 ]</a></table>

<script language=javascript src="js/r/mpg.js"></script>
<script language=JavaScript>currentpage=<?php echo$CP;?></script>
<script language=JavaScript src="../js/js.js"></script>
<script language=JavaScript src="js/r/myfd.js"></script>