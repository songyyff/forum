<?php
e_e();

$search = array ("/\"/",
"/\n/",
"/\r/",
); 
$replace = array ("\\\"",
"<br>",
"",
);
$C=array (0,'yellow',
'yellowgreen',
'lightslategray',
'#FFD306',
'#9F4D95',
'sandybrown',
'gold',
'darkkhaki',
'rosybrown',
'goldenrod',
'darkorange',
'darkgray',
'blueviolet',
'brown',
'burlywood',
'cadetblue');

$GN=$IN=$RN=$VN=0;
function buildtree($prow,$level){
global $ur,$handle,$linetree,$search,$replace,$C,$GN,$IN,$RN,$VN;
$q="select * from tgup where pid=$prow->id and stat='E' order by sort";
$rs=mysql_query($q) or die(f_e($q));
if($GN+=$len=mysql_num_rows($rs)){
$level++;
for($i=0;$i<$len;$i++){
$r=mysql_fetch_object($rs);
$IN+=$r->inum;$RN+=$r->rnum;$VN+=$r->vnum;
echo "<tr><td bgcolor=$C[$level] class=bdb1>$level</td><td valign=top class=bdb1><img width=46 src=../icons/f/$r->id.gif></td><td class=bdb1><a href=../pro/list.php?groupid=$r->id>$r->name</a> - $r->inum/$r->rnum/$r->vnum<br>".preg_replace($search, $replace, $r->comm)."<br>$r->ctime</td></tr>
";
//$linetree[$level]=$ri==$len-1;
if($r->sfnu&&$r->level<=($ur?$ur->level:1))buildtree($r,$level);
}
}
mysql_free_result($rs);
}
echo "<hr><table width=100% cellpadding=2 cellspacing=0><tr height=27><td width=50 class=bdb1>层级</td><td width=46 class=bdb1>图标</td><td class=bdb1>论坛说明</td></tr>";
$prow->id=0;
buildtree($prow,0);
echo "</table>
<p>您当前权限可访问的共有 $GN 个论坛， $IN 个帖子， $RN 个回复，$VN 人次访问。",
$uid?"":"<a href=../pro/userreg.php>注册</a> 成为我们的用户，可以访问更多的资源。";
?>