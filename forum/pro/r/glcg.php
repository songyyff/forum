<?php

e_e();

//显示子论坛
$q="select * from tgup where pid=$G->id".($right_saved['superview']&$G->sr?"":" and stat='E' and level<=".($uid?$G->ul:1))." order by sort";
$R=mysql_query($q) or die(f_e());
if($leg=mysql_num_rows($R)){
echo "<tr class=bar2><td>&nbsp;</td><td colspan=4><b>$leg</b> 个子论坛";
for($i=0;$i<$leg;$i++){
$r=mysql_fetch_object($R);
echo "<tr",$i&1?" class=tr":"","><td><img width=50 src='../icons/f/$r->id.gif'>
<td colspan=4><a href=\"list.php?groupid=$r->id\" class=goldlink><b>$r->name</b></a> 版主:";
$q="select s.uid,u.name from tspu as s left join tuser as u on(s.uid=u.id ) where gid=$r->id order by s.level asc";
$R1=mysql_query($q) or die(f_e($q));
while ($v=mysql_fetch_object($R1))echo " <a href=\"userinfo.php?userid=$v->uid\">$v->name</a>";
mysql_free_result($R1);
echo " 创建时间 ",substr($r->ctime,0,10)," <span id=smallspan>等级 $r->level 顶 $r->tpnu / 贴 $r->inum / 回复数 $r->rnum / 访问人数 $r->vnum</span>
<pre>$r->comm
";
}
}
mysql_free_result($R);
?>