<?php
e_e();
$q="select t1.*,t2.name as user from titem as t1 force index(gl) left join tuser as t2 on t1.uid=t2.id where t1.gid=$gid and t1.stat='E' and t1.type=2 order by t1.ltime desc";
$R=mysql_query($q) or die(f_e($q));
if($U=mysql_num_rows($R)){
echo "<tr class=bar2 id=tis><td>&nbsp;<td><b>置顶帖子 $U</b> 帖<td>发帖人<td>回复/访问<td>最后回复";
$T[]=0;
showi($T);
}
mysql_free_result($R);
?>