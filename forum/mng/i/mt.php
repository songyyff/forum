<?php
e_e();
if($irow->stat!='E')$msgs.="<br>[ $id ] 非有效帖子不能置类型";
else{
$query="update tgup set tpnu=tpnu".($b=($ity==2)?"+":"-")."1,inum=inum".($b?"-":"+")."1 where id=$irow->gid".($b?" and tpnu<=mxtp":"");
mysql_query($query) or die(f_e($query));
if($b2=mysql_affected_rows()){
$query="update titem set type=$ity where id=$id";
mysql_query($query) or die(f_e($query));
}
$msgs.="<br>[ $id ] 类型".(!$b2&&$b?"置顶到达上限，无法":"")."改变";
}
?>