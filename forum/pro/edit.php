<?php

include"../func/mustfunc.php";

if(!$uid=$_S['seuserid'])f_toerror(nologin);
$vtype=(int)$_R['type'];
$sid=(int)$_R['actionid'];
if($vtype<0||$vtype>3||!$sid)f_toerror(urlerror);
$M=$_S['seismng'];

include"r/er$vtype.php";
if($i)f_toerror($i);

if(isset($_R['con']))include"s/es$vtype.php";

?>

<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<title>编辑内容</title>
<?php
echo"<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/def.css>
<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/edit.css>
<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/code.css>
";
?>
<script language=javascript src=../js/js.js></script>
</head>

<body>

<?php include"../hefo/head.php";?>

<div class=gud><a href=.><b>论坛</b></a>><?php
echo $r->pid?">.":"",
"><b><a href=list.php?groupid=",
$vtype?$r->gid:$r->id,
">$r->name</a></b>",
$vtype?"><a href=view.php?noteid=".($vtype==3?preg_replace (array ("/p/","/s/"),array ("&page=","#site"), $_R[extra]):$r->id).">".($r->title?$r->title:"...")."</a>":"";
?></div>

<div class=hb1p1><b><?php echo$vtype&1?"修改":"发表",$vtype>1?"回复":"帖子";?></b></div>
<FORM id=MF style=padding:20px>

<?php if($msg)echo"<div><b>提交结果：<br>$msg</b><hr></div>";?>

<div id=attri>| 选项 <input type=checkbox name=canshow value=1<?php $g=$vtype?$vtype&1?$r->rigt:$r->rrgt:$r->irgt;$c=" checked";echo $right_saved['usershow']&$g?$c:""; ?>>显示内容
<?php echo $vtype<2?" <input type=checkbox name=canrpl value=1".($right_saved['userrpy']&$g?$c:"").">接受回复":""; ?>
 <input type=checkbox name=cangview value=1<?php echo $right_saved['guestview']&$g?$c:""; ?>>游客访问
<?php if($vtype<2)echo" | 阅读权限 <INPUT class=input30 NAME=readnum value=",$vtype&1?$r->rdnum:$g>>16,">";?>
</div>
<?php if($vtype<2)echo'<INPUT NAME=til id=til value="',$msg?@f_rpspc($T):@f_rpspc($r->title),'">';?>
<div class=p5 id=mIcons></div>

<textarea id=con name=con></textarea><input type=hidden id=href name=href><input type=hidden id=Icode name=Icode>
<pre id=EW><?php echo$msg?$S:$vtype&1?$r->content:"";?></pre>
<div id=Info>状态</div>
<OBJECT ID=dlgHelper CLASSID="clsid:3050f819-98b5-11cf-bb82-00aa00bdce0b" style=width:0;height:1></OBJECT>
<div id=Aview><img></div>
<div id=DBG></div>

<input type=hidden name=hiddenextra value="<?php echo f_rpspc($_R['extra']); ?>">

<?php
if($vtype==1&&$r->suvn){
$q="select * from suvy use index(s) where iid=$sid order by id";
$rs=mysql_query($q) or die(f_e( $q));
if(mysql_num_rows($rs)){
echo "
<script language=javascript>
var suvdbs=[";
$q="select * from suvi force index(s) where sid in(select id from suvy force index(s) where iid=$sid) order by sid,sort";
$is=mysql_query($q) or die(f_e( $q));
$g=0;
while($w=mysql_fetch_object($rs)){
echo"[$w->id,$w->num,$w->inu,$w->imax,$w->min,$w->max,$w->peri,$w->data,\"$w->time\",\"$w->des\",$w->numi,";
while($g||$g=mysql_fetch_object($is)){
if($g->sid==$w->id){echo"
$g->id,\"$g->item\",\"$g->time\",$g->num,";$g=0;}else break;
}
echo"0],
";
}
echo "$r->alts];
</script>
";
mysql_free_result($is);
mysql_free_result($rs);
}
}
?>
<input type=button  onclick=orderform() VALUE="      提交      ">
</FORM>
<SCRIPT language=JavaScript src=js/gc.js></SCRIPT>
<script language="JavaScript">
<?php
if($msg&&ctype_digit($T=&$_R[tID]))echo"tID=$T";
echo"
codeT=\"",$msg?$C:$r->lan,"\"
sID=$sid
vT=$vtype
tTheme='$_S[sestyle]'

hrefS=[",$msg?$H:$r->href,"]
atts=[
";

if($vtype&1||$msg){
$q="select * from trsc where ".($vtype==1?"i":"r")."id=".($msg?(int)$T." uid=$uid":$sid)." order by id";
$R=mysql_query($q) or die(f_e( $q ));
while($w=mysql_fetch_object($R))echo"$w->id,\"$w->name\",0,\"$w->type\",$w->size,\"$w->time\",
";
mysql_free_result($R);
}
echo"0]
";
?>
</script>
<script src=e/edit.js language=javascript></script>

<?php include"../hefo/foot.php";?>
</body>
</html>