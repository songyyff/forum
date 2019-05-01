<?php
//用户数据重计算
include "../mng/lock.php";
e_e();
if(!getlock("tuser",$uid,3)){

$q="update tuser set ".
"sbnu=(select count(*) from tsubs where uid=$uid),". //订阅数量

"fnum=(select count(*) from tfrid where uid=$uid),". //朋友数量

"inum=(select count(*) from titem where uid=$uid and stat='E'),". //有效帖子数量
"dnum=(select count(*) from titem where uid=$uid and stat!='E'),". //无效帖子

"rnum=(select count(*) from trpl where uid=$uid and stat='E'),".  //有效回复
"drnu=(select count(*) from trpl where uid=$uid and stat!='E'),".  //无效回复

"rmnu=(select count(*) from msg where uid=$uid and type=0),".  //接受消息数
"smnu=(select count(*) from msg where uid=$uid and type=1),".  //发送消息数
"dmnu=(select count(*) from msg where uid=$uid and type=2),".  //删除消息数
"nmnu=(select count(*) from msg where uid=$uid and type=0 and rd=0),".  //未读消息数

"gmnu=(select count(*) from tspu where uid=$uid)".  //管理论坛数量

" where id=$uid";
mysql_query($q) or die(f_e($q));
setunlock("tuser",$uid);
}else $resultmsg.="重算用户数据不成功。";