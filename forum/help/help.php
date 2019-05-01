<?php include "../func/mustfunc.php";

//判权
if($uid=$_S['seuserid']){
$ism=$_S[seismng];
$q="select id,rigt,level from tuser where id=$uid";
$R=mysql_query($q) or die(f_e($q));
if(!$ur=mysql_fetch_object($R))f_toerror(nouser);
mysql_free_result($R);
}
if(isset($_R['helpid'])&&$_R['helpid']>=0)$phelpid=(int)$_R['helpid'];else $phelpid=4;
do{
$q = "select * from thelp where id=$phelpid";
$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);
mysql_free_result($R);
}while($r&&$r->id!=($phelpid=(int)$r->link));
if($r){
	$helptitle="帮助错误";
	switch($tt=$r->type){
	case 0: if($uid){
		$helpmsg="<p>&nbsp;<p>这是游客帮助，您可以退出后再访问。";
	}break;
	case 1: if(!$uid){
		$helpmsg="<p>&nbsp;<p>这是注册用户帮助，您必须先登陆后再访问；如果您还未注册，请注册用户。";
		$eid=1;
	}break;
	case 2: if(!$_S['seismng']){
		$helpmsg="<p>&nbsp;<p>这是管理员帮助，您必须是论坛管理员并登陆后再访问；如果您还未注册，请注册用户。";
		$eid=1;
	}break;
	case 3:
	nohelp();
	}
}else{
	nohelp();
	$tt=0;
}
function nohelp(){
global $helptitle,$helpmsg;
	$helptitle="帮助编号 $phelpid";
	$helpmsg="<p>&nbsp;<p>对不起，没有此帮助。 T_T";
}
?>

<html>

<head>
<title>帮助</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../theme/<?php echo $_S['sestyle']; ?>/def.css">
<script language="JavaScript">
function node(di,li,ti){
this.id=di;
this.l=li;
this.t=ti;
this.c=new Array();
}
ism=<?php echo$ism?"true":"false","
wm=$tt";?>

</script>
<STYLE>
p{text-indent:20px;margin:5px;line-height:22px;}
</STYLE>
</head>

<body>
<?php include"../hefo/head.php"; ?>

<div class=gud><a href=../index.php><b>论坛</b></a>>>帮助</div>

<table width=100% cellpadding=0 cellspacing=0>
<tr><TD width=200 valign=top style="padding:2px;padding-left:0px;">
<?php include$uid?"um.php":"gm.php"; ?>
<td valign=top style="padding-top:2px;padding-bottom:2px;">

<div class=O><?php echo $helpmsg?$helptitle:$r->title; ?></div>

<table width=100% cellpadding=0 cellspacing=0>
<tr height=400><TD class=blrp5 valign=top>
<?php 
echo$helpmsg?$helpmsg:$r->body;
if($r->id==4)include"gl.php";
?>
</table>

<div class=O><?php echo$helpmsg?$helptitle:$r->title; ?></div>

</td></tr></table>

<?php include"../hefo/foot.php";?>

</body>
</html>