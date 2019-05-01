<?php include"../func/mustfunc.php";

if(!$gid=(int)$_R['groupid'])f_toerror(urlneedvar);
$uid=$_S['seuserid'];

$q="select g.*,
u.rigt as ur,u.level as ul,u.stat as us
".($_S['seismng']?",(select rigt from tspu where uid=$uid and gid=$gid) as sr":"")."
from tgup as g 
left join tuser as u on u.id=$uid
where g.id=$gid";
$R=mysql_query($q) or die(f_e($q));
if(!$G=mysql_fetch_object($R))f_toerror("havenoforum");
mysql_free_result($R);

if($uid){

if($G->us!='E')f_toerror(userdisabled);

if(!($right_saved['superview']&$G->sr)){
if(!($right_saved['userview']&$G->ur))f_toerror(nouserview);
if($G->stat!='E')f_toerror("groupclosed");
if((int)$G->level>$G->ul)f_toerror("grouplevelhigh");
}
}elseif(!($right_saved['userview']&$G->rigt)||1<$G->level||$G->stat!='E')f_toerror("nologin");

//修改访问信息
$q="update tgup set vnum=vnum+1 where id=$gid";
$R=mysql_query($q) or die(f_e($q));

?>

<html>

<head>
<title><?php echo$G->name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel=stylesheet type=text/css href=../theme/<?php echo $_S['sestyle']; ?>/def.css>
<!--script language=JavaScript src=../js/js.js></script-->
</head>

<body>
<?php

include"../hefo/head.php";

function getgrouptreeinfo($g) {
global $grouptree;
$q="select * from tgup where id=$g";
$R=mysql_query($q) or die(f_e($q));
if($r=mysql_fetch_object($R)){
$grouptree="><a href=?groupid=$r->id><b>$r->name</b></a>".$grouptree;
mysql_free_result($R);
if($r->pid)getgrouptreeinfo($r->pid);
}
}

//提取组信息
$grouptree=">$G->name";
getgrouptreeinfo($G->pid);

echo "

<div class=gud><a href=index.php><b>论坛</b></a>>$grouptree</div>
<style>
#t th{padding:0px}
#t td{border-top:1px solid #aaaaaa;}
#t img{vertical-align:top;margin-right:1px;}
</style>
<table id=t width=100% style='table-layout:fixed' cellpadding=5 cellspacing=0>
<thead><th width=60><th><th width=100><th width=100><th width=100>";

//显示子论坛
if($G->sfnu)include "r/glcg.php";

if(1>$CPage=(int)$_R['page'])$CPage=1;
$pn=ceil($G->inum/$_S['seitsize']);
if($CPage>$pn&&$pn)$CPage=$pn;
if($CPage>60)$CPage=60;

function showi(&$I){
global $R;
$i=1;
while($r=mysql_fetch_object($R)){
$I[]=$r->rnum;
$I[]=$r->id;
echo "
<tr",($i^=1)?" class=tr":"","><td><img src='../images/",$r->suvn?"sp":"pa",".gif'><td><a href=\"view.php?noteid=$r->id\" class=itemlink target=_blank>",
strtotime($r->ctime)<(time()-$_S["senew"]*3600)?$r->title:"<b>$r->title</b>","</a> ",

$r->rdnum?" [阅$r->rdnum]":"",
//$r->adnu?" {附$r->adnu}":"",
$r->pici?" <img src='../images/p1.gif'>$r->pici":"",
$r->athi?" <img src='../images/f.gif'>$r->athi":"",
$r->adoi?" <img src='../images/m.gif'>$r->adoi":"",
$r->vdoi?" <img src='../images/v1.gif'>$r->vdoi":"",
"<td id=smallspan>",f_date($r->ctime),"<br># <a href=\"userinfo.php?userid=$r->uid\">$r->user</a><td>$r->rnum/$r->vnum<td id=smallspan>",f_date($r->ltime),"<br># <a href=\"userinfo.php?userid=$r->luid\">$r->luser";
}
}

if(($uid?$right_saved['userview']:$right_saved['guestview'])&$G->rigt){

//显示置顶帖子
if($CPage==1)include "r/gltopi.php";

//显示论坛帖子
if($in=$G->inum){

echo "<tr><td id=pg1 colspan=4>&nbsp;<td align=right><a class=goldlink href='edit.php?actionid=".(int)$_R['groupid']."&type=0'>发表新贴</a>";

//产生内容列表
$q="select t1.*,t2.name as user from titem as t1 use index(gl)
left join tuser as t2 on t1.uid=t2.id
where t1.gid=$gid and t1.stat='E' and t1.type!=2 order by t1.ltime desc limit ".($CPage-1)*$_S['seitsize'].",".$_S['seitsize'];
$R=mysql_query($q) or die(f_e($q));
echo"
<tr class=bar2 id=lis><td>&nbsp;<td><b>论坛帖子 $in</b> 帖<td>发帖人<td>回复/访问<td>最后回复";
$M[]=0;
showi($M);
mysql_free_result($R);
echo"
<tr><td id=pg2 colspan=4>&nbsp;<td align=right>",($z=$right_saved['usernew']&$G->ur&$G->rigt||$right_saved[supernew]&$G->sr)?"<!--[if !IE]>--><a href=javascript:; onclick=brief(this)>快速</a><!--<![endif]-->":"","<a class=goldlink href='edit.php?actionid=".(int)$_R['groupid']."&type=0'>发表新贴</a>";

}else echo "<tr><td colspan=5 class=d0>--- 论坛还未<a href=edit.php?actionid=$gid>发表</a>帖子 ---";

}else echo"<tr><td  colspan=5 class=d0>--- ",$uid?"论坛维护中":"游客无权浏览,请登陆!"," ---";

echo "</table>";

if($z)echo"
<div id=iF></div>
";
?>
<script language=javascript>
<?php
echo "tTheme='$_S[sestyle]';sID=$G->id;vT=0
gi={d:$G->id,p:$CPage,I:$G->inum,z:$_S[seitsize],Z:$_S[serpsize]},
Ti=[";
for($i=1,$U=count($T);$i<$U;$i++)echo "$T[$i],";
echo "0],
Is=[";
for($i=1,$U=count($M);$i<$U;$i++)echo "$M[$i],";
echo "0]
";
?>
</script>
<script language=JavaScript src="js/gl.js"></script>
<?php include "../hefo/foot.php";?>
</body>
</html>