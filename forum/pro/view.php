<?php include"../func/mustfunc.php";
if(!$iid=(int)$_R[noteid])f_toerror(urlneedvar);

if(1>$CPage=(int)$_R['page'])$CPage=1;

$ism=$_S[seismng];
$uid=$_S[seuserid];

function cSQL(){global$_host,$_port,$_super,$_pass,$_db,$mysqli;
$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());exit();}
$mysqli->query("set names utf8");
$mysqli->query("set group_concat_max_len=35536");
}
cSQL();
$R=$mysqli->query($q="call i($ism,$uid,$iid)");
$mysqli->close();

if(!$X=mysqli_fetch_object($R))f_toerror(havenoitem);//查询帖子不存在

if($uid){ //logined
if($X->zs!='E')f_toerror(userdisabled);//用户无效
if(!($right_saved['superview']&$X->sr)){
if(!(($uv=$right_saved['userview'])&$X->zr))f_toerror(nouserview);//无用户查看权
if($X->zl<$X->gl)f_toerror(grouplevelhigh);//用户等级没论坛等级高
if(!$X->gn)f_toerror(havenoforum);//查询论坛不存在
if($X->ge!='E')f_toerror(groupclosed);//论坛关闭了
if(!($uv&$X->gr))f_toerror(groupnoview);//论坛无浏览权
if($X->stat!='E')f_toerror(itemclosed);//帖子无效状态
if(!($uv&$X->rigt))f_toerror(noitemuserview);//帖子没有阅览权
if($X->rdnum>$X->zrd&&$X->uid!=$uid)f_toerror(readrighthigh);//阅读权不够
}

if(isset($_R['suv'])){
if(!($right_saved['uservote']&$X->zr))f_toerror(novoteright);//没有投票权
include"s/vv.php";//提交调查
}

}else//unlogined
//贴子的阅读权和forum的阅读全
if($X->ge!='E'||1<$X->gl||$X->stat!='E'||$X->rdnum||!($right_saved['guestview']&$X->rigt&$X->gr)||!($right_saved['userview']&$X->rigt&$X->gr))f_toerror(nologin);//未登陆 没权访问

mysql_query($q="update titem set vnum=vnum+1 where id=$iid") or die(f_e($q));
mysql_query($q="update tgup set vnum=vnum+1 where id=$X->gid") or die(f_e($q));

//function f_mtime(){list($u,$s)=explode(" ",microtime()); return ((float)$u+(float)$s);}
?>

<html>
	
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo"$X->title - $X->gn";?></title>
<?php echo"
<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/def.css>
<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/code.css>
",
$X->suvn?"<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/suv.css>":"";
?>
</head>
<body>
<?php include"../hefo/head.php";?>
<script src=js/vw.js language=javascript></script>
<?php

$e=0;

echo"<div class=gud><a href=index.php><b>论坛</b></a>>",$X->pid?">.":"","><b><a href=list.php?groupid=$X->gid>$X->gn</a></b>>",isshow($X,0),"</div>";

$mv=!($right_saved['superview']&$X->sr);
$M=array(0,"被管理员禁言","管理不显示","用户不显示","未对游客开放");

function isshow($r,$t){
global$e,$right_saved,$uid,$mv,$M;
$e=$right_saved['userstop']&$r->ur?
($right_saved['supershow']&$r->rigt?
($right_saved['usershow']&$r->rigt?($uid||$right_saved['guestview']&$r->rigt?0:4):3)
:2):1;
echo($r->lmng=$e&&$mv)?"<s>$M[$e]</s> ":($t?"":$r->title),
$r->cuid&&$t?"最后由 <a href=\"userinfo.php?userid=$r->cuid\">$r->cuser</a> 于 ".substr($r->lctm,2,14)." 修改":"";
}
function showbody($r,$i){
global$e,$right_saved,$mv;
echo "<tr><td id=lp><p><a name=site$i></a><a",$r->sex?"":" class=goldlink"," href=userinfo.php?userid=$r->uid>$r->name</a>",f_isonline($r->ltime)?"":" <img src=../images/on.gif style=vertical-align:top>","<div><img src=../faces/$r->face><td style='padding-left:5'><p id=tb><tt>&nbsp;",$i?"<b>$i#</b>":""," ",substr($r->ctime,2,14),"</tt>: ",isshow($r,1),"<pre id=spre><pre>",($X=$r->lmng&=$r->uid!=$uid)?"":$r->content,"</pre></pre>";
if(!$i&&$r->suvn&&(!$e||!$mv))include"r/vsuv.php";
echo "<pre id=spre>",$X?"":$r->sign;
}
//产生内容列表
echo "
<div class=hbp5 align=right>$X->vnum 人访问 <a class=goldlink href=javascript:; onclick=getsubs($X->id)>订阅本帖</a></div>
<table id=im width=100% cellpadding=0 cellspacing=0>";
showbody($X,0);
echo "
</table>
";

$N=0;
class icls{var $gid;}
$r=$R=new icls;

if($X->rnum) {

if($CPage>$t=ceil($X->rnum/($trs=$_S['serpsize'])))$CPage=$t;

cSQL();
$rs=$mysqli->query("call r($iid,$CPage,$trs)");
$mysqli->close();

if($N=mysqli_num_rows($rs)){
//显示翻页
echo "
<div id=pgs1></div>
";
//显示回复
$i=1;

echo "
<table id=rs width=100% cellspacing=0>";

while($r=$r->gid=mysqli_fetch_object($rs)){
showbody($r,$i++);
}

echo "
</table>
";

echo "
<div id=pgs2></div>
";
}
}
?>
<SCRIPT language=JavaScript src=js/gc.js></SCRIPT>
<script language=JavaScript>
<?php
echo "pageStyle=tTheme='$_S[sestyle]';sID=$X->id;vT=2;vR=",$vR=$right_saved['userrpy']&$X->zr&$X->gr&$X->rigt&&$right_saved['superrpy']&$X->rigt||$right_saved['superrpy']&$X->sr||$uid==$X->uid?1:0;
if(isset($_R['site'])) echo "jumpsite=".(int)$_R['site'];

echo"
pageInfo={I:$X->id,p:$CPage,R:$X->rnum,r:{$_S['serpsize']},w:10,M:",$X->sr?1:0,"}

info=[";

$X->gid=$R->gid;
$R->gid=$X;
while($R=$R->gid){
echo "
[[$R->id,$R->adnu,\"$R->ctime\",",$R->pos?$R->pos:0,$R->lmng?"":",'$R->lan'$R->href","],
 [$R->uid,0,$R->qq,$R->inte,$R->money,$R->inum,$R->rnum,$R->level,$R->rdnum,$R->ontime,'",substr($R->ltime,0,10),"','",substr($R->uct,0,10),"'],
 [$R->bg]",
 $R->ats&&!$R->lmng?",
 [$R->ats]":"",
 "
 ],";
}
echo "
0]
</script>
";
//装载提交表单
if($vR)echo"<div id=iF></div>
";

//装载页脚
include "../hefo/foot.php";
?>
<script language=javascript src=js/cv.js></script>
</body>
</html>