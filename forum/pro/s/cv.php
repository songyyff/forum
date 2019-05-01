<?php

include"../func/mustfunc.php";

if(!$iid=(int)$_REQUEST['noteid'])f_toerror("urlneedvar");

$q="select i.stat,i.rigt,i.rdnum,
g.stat as ge,g.rigt as gr,g.name as gn,g.level as gl,g.pid,
u.level,u.rigt as ur,u.rdnum as urd,
".(($ism=$_SESSION['seismng'])?"(select s.rigt from tspu as s use index(unind) where s.uid={$_SESSION['seuserid']} and i.gid=s.gid)as sr,":"").
"from titem as i left join (tgup as g,tuser as u)on(i.gid=g.id and i.uid=u.id) where i.id=$iid";
$R=mysql_query($q) or die(f_e($q));
if(!$X=mysql_fetch_object($R))f_toerror("havenoitem");//查询帖子不存在
mysql_free_result($R);

if($uid=$_SESSION['seuserid'])f_toerror("nologin");//未登录
if($X->us!='E')f_toerror("userdisabled");//用户无效

if(!($X->sr&$right_saved['superrpy'])){

if(!($X->ur&($ur=$right_saved['userrpy'])))f_toerror("nouserreplay");//无用户回复权
if($X->ul<$X->gl)f_toerror("grouplevelhigh");//用户等级没论坛等级高

if(!$X->gn)f_toerror("havenoforum");//查询论坛不存在
if($X->ge!='E')f_toerror("groupclosed");//论坛关闭了
if(!($X->gr&$ur))f_toerror("nogroupreplay");//论坛无回复权

if($X->stat!='E')f_toerror("itemclosed");//帖子无效状态
if(!($X->rigt&$ur))f_toerror("noitemreplay");//帖子没有回复权
if($X->rdnum>$X->urd&&$X->uid!=$uid)f_toerror("readrighthigh");//阅读权不够

}

if(strlen($_REQUEST['replaycontent'])){
include "../mng/lock.php";
if($lk=getlock("titem",$ir->id,5))$resultmsg=$lk==1?"系统繁忙，请稍后再试。T_T":"帖子已经被删除，您无法发表回复了。T_T";
else{//添加回复信息
$q="insert into trpl(stime,gid,pos,iid,uid,ctime,title,content) values (".f_mtime().",$gr->id,$ir->rnum+1,$ir->id,$uid,now(),\"".f_rpspc($_REQUEST['replaytitle'])."\",\"".f_rpspc($_REQUEST['replaycontent'])."\");";
//echo $q;
$rs=mysql_query($q) or die(f_e($q));
//更新帖子信息
$q="update titem set rnum=rnum+1,lrid=".mysql_insert_id().",ltitle=\"".f_rpspc(substr($_REQUEST['replaycontent'],0,200))."\",luid=$uid, luser=\"".$_SESSION['seusername']."\",ltime=now() where id=$ir->id";
$rs=mysql_query($q) or die(f_e($q));
//更新组信息
$q="update tgup set rnum=rnum+1 where id=$gr->id";
$rs=mysql_query($q) or die(f_e($q));
//更新用户信息
$q="update tuser set inte=inte+$pointperreplay,rnum=rnum+1 where id=$uid";
$rs=mysql_query($q) or die(f_e($q));
$ir->rnum++;
//jump to last page
$resultpage=(int)($ir->rnum/$_SESSION['serpsize']);
if($ir->rnum%$_SESSION['serpsize']) $resultpage++;
setunlock("titem",$ir->id);
if($resultpage==$_REQUEST['page']) $jumpsite="#site".($ir->rnum%$_SESSION['serpsize']);
else{ mysql_close($link);
header("Location: $v_hostpath"."view.php?noteid=$ir->id&page=$resultpage#site".($ir->rnum%$_SESSION['serpsize']));
exit;
}
}
}else $resultmsg="回复标题和内容都必须填写";//表单填写不完整
?>