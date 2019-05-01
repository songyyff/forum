<?php
include "../func/mustfunc.php";
?>
<html>
<head>
  <title>找回密码</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="../theme/<?php echo $_S['sestyle']; ?>/def.css">
</head>
<body leftmargin="0"  topmargin="0">
<table border=1 width="100%" cellpadding=0 cellspacing=0 class=bgc style="height:100%" >
<tr height=50><td align="center" class="bar2"><?php echo($x=(int)$_R[utype])?($x==1?"用户ID":"用户Email"):"用户",": ",f_rpspc($_R['uname']); ?>
<tr><td align="center">
<?php

if($x==1)$u=(int)$_R[uname];else{
$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$stmt=$mysqli->prepare($q="select id from tuser use index(".($x?"mail) where email=?":"name) where name=?"));

$stmt->bind_param('s',$q=$x?$_R[uname]:str_replace('<',"&lt;",$_R[uname]));
$stmt->execute();
$stmt->bind_result($u);
$stmt->fetch();
}

$q="select id,name,pass,pkey,email,getp,gptm from tuser where id=$u";
$rs = mysql_query($q) or die(f_e($q));
if($r=mysql_fetch_object($rs)) {

if(!trim($r->email))echo "用户[ $r->name ]填写的邮件地址有错误，无法发送邮件，您可向管理员申述要回密码。";
else{
	
$h=$r->getp&0xff;
$mt=$r->getp>>16;
$t=$mt>>8;
$mt=$mt&15;
if($t<$mt||$td=time()-strtotime($r->gptm)>$h*86400){

include "../func/login.php";
include "../mail/sendmail.php";
include "../w/mailfootvar.php";
if(!$MHost)echo"抱歉，论坛还未启用邮件发送功能。请您向管理员申述取回密码。";
else if($msg=sendmail($r->email,$r->name,
"论坛用户[ $r->name ]取回密码(此邮件不需要回复)", //邮件标题
"尊敬的 $r->name :

    您的论坛ID是：$r->id
    您的论坛账号是：$r->name
    您的密码是：".f_decode($r->pass,$r->pkey)."
    
    感谢您长期以来对本论坛的支持，请保存好您的帐号密码，欢迎您再次访问论坛。


    祝您愉快！
    ".date("Y-m-d H:i:s",time())."
$w_mailfoot",	//邮件内容
"","",$w_mailmode))echo "邮件发送失败：$msg ,如果多次邮件发送失败，请您向管理员报告并申述要回密码。";
else{
	$q="update tuser set getp=".($h|($t=$td?1:$t+1)<<24|$mt<<16).($td?",gptm=now()":"")." where id=$r->id";
	mysql_query($q) or die(f_e($q));
	echo "含有用户[ $r->name ]密码的邮件已成功发送，请您尽快查收。 ^_^<br><br>
您在 ",date("Y-m-d H:i:s",($td?time():strtotime($r->gptm))+$h*86400)," 以前还有 ",$mt-$t," 次获取密码的机会。";
}

}else{ //时间间隔非法
	echo "抱歉！您获取密码的有效次数已经用完。<br>下一次可以获取密码的时间为:<br><font color=red>",date("Y-m-d H:i:s",strtotime($r->gptm)+$h*86400),"</font>";
}

}


}else echo "此用户没找到，请检查您填写的用户",$x?($x==1?"ID":"Email"):"名称","是否正确。";
mysql_free_result($rs);
?>
</td></tr>
<tr height=40><td align="center" class="bar2"><input id=closebutton type="button" onclick="javascript:window.close();" value="关闭"></td></tr>
</table>
<script language="JavaScript">
function g(n){return document.getElementById(n);}
var waitingtime = 61;
g("closebutton").value = " (" + waitingtime + ") 关闭 ";
function wittingclose(){
	if(waitingtime-- > 0){
		g("closebutton").value = " (" + waitingtime + ") 关闭 ";
		setTimeout(wittingclose,1000);
	} else window.close();
}
wittingclose();
</script>
</body>
</html>
