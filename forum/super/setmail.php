<?php

e_e();

echo "<div class=subhead><b>论坛邮件发送系统参数设置</b> ",date("Y-m-d H:i:s",time()),"<hr></div>";
if(isset($_REQUEST['host'])){
//向数据库提交数据
$n=Array(host,port,needpass,acount,acountpass,rename,remailadd,charset,lang);
if(!$_REQUEST['needpass'])$_REQUEST['needpass']=0;
for($i=0;$i<9;$i++)if(isset($_REQUEST[$n[$i]])){
$q="update tdict set info2=\"".f_slquot($_REQUEST[$n[$i]])."\",ctime=now() where type=12 and key1=$i";
mysql_query($q) or die(f_e($q));
}
include"s/wmailv.php";
}
$z=Array();$i=0;
$q="select * from tdict where type=12 order by key1";
$rs=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($rs))$z[$i++]=f_rpspc($r->info2);
mysql_free_result($rs);

if($_REQUEST['testmail']){
	include "../mail/sendmail.php";
	include "../w/mailfootvar.php";
	$msg=sendmail($_REQUEST['testmail'],$_REQUEST['testmail'],
"发送邮件设置测试!(此邮件不需要回复)",
"恭喜！

　　您收到了这封邮件，证明您的邮件发送参数设置成功了！

　　祝您愉快！
　　".date("Y-m-d H:i:s",time())."
$w_mailfoot",
$_REQUEST['remailadd'],$_REQUEST['rename'],$w_mailmode);
}
?> <br>&nbsp; 论坛用户忘记密码时，可以在论坛帮助中通过用户邮件获取密码。要让论坛可以向用户发送邮件，就需要正确设置下列邮件参数。<br><br>
<form method="POST" action="?type=<?php $i=0;echo $vtype,"\">
<table width=100% border=0 cellpadding=5 cellspacing=0 class=bdtb1>
<tr><TD width=170>发送邮件服务器地址(SMTP)<td width=100><input type=text name=host value=\"",$z[$i++],"\"><td>可以是域名或ip地址，如：smtp.163.com 或 xxx.xxx.xxx.xxx 格式<br>服务器可以是网络smtp服务器，但这些服务器都对免费用户的邮件发送数量有所限制。最好使用本地邮件发送服务器。通常租用空间都提供免费邮件功能，用户可以在服务指南或手册中查到邮件服务器地址。
<tr><TD>发送邮件服务器(SMTP)端口<td width=100><input type=text name=port class=input30 value=\"",$z[$i++],"\"><td>通常是 25
<tr><TD>SMTP服务器需要身份验证<td><input type=checkbox value=1 onclick=\"isauth(this)\" name=needpass",($x=$z[$i++])?" checked":"","><td>有些SMTP服务器发送邮件时需要身份验证（绝大多数的免费邮件服务都需要，比如：163，新浪等服务商）,就是发送邮件时需要提供用户的邮件帐号和密码。<br>有些SMTP服务商不需要帐号密码只能向自己发送邮件，只有提供帐号密码后才能向其它邮件服务器发送邮件。<br>有些SMTP服务商不需要帐号密码就拥有完全邮件功能。<tr><TD>SMTP邮件帐号</td><td><input type=text name=acount value=\"",$z[$i++],"\"",$x?"":" disabled","><td>此帐号一般和pop3服务帐号同名，很多租用空间提供的smtp服务需要提供完整的邮件地址名称，如 xxx@xxx.com<tr><TD>SMTP邮件帐号密码<td><input type=password name=acountpass value=\"",$z[$i++],"\"",$x?"":" disabled","><td>
<tr><TD>发送人</td><td><input type=text name=rename value=\"",$z[$i++],"\"><td>管理员名称
<tr><TD>发送人邮件地址<td><input type=text name=remailadd value=\"",$z[$i++],"\"><td>发送邮件地址，通常是SMTP服务的邮箱地址，如：XXXX@mailserver.com<br>如果此邮件地址与SMTP服务器帐号不等，很多SMTP服务器将拒绝发送邮件，或者邮件无法递交到目标邮件地址
<tr><TD>字符集</td><td><input type=text name=charset value=\"",$z[$i++],"\"><td>发送邮件使用的字符集。这个版本都使用utf-8字符集。
<tr><TD>发送邮件返回状态语言<td>
	<select name=lang>
		<option value=gb",$z[$i]=="gb"?" selected":"",">中文</option>
		<option value=en",$z[$i]=="en"?" selected":"",">English</option>
	</select>
<td>发送邮件后无论成功失败都会返回状态信息，可以设置这些信息为中文还是英文</td>
<tr><TD class=bdtb1>测试邮件地址<td class=bdtb1><input type=text name=testmail value=\"",f_rpspc($_REQUEST['testmail']),"\"><td class=bdtb1>检测邮件发送设置是否可以正确发送邮件,填写后向此邮件地址发送测试邮件，不填就不发送测试邮件",$_REQUEST['testmail']?"<br><font color=red>发送邮件测试结果：</font> ".($msg?$msg:"邮件发送成功!"):"";?>
<tr height=66><TD>
<td><input type=submit value=" 提交(S) " default accesskey="S">   <input type=reset value="重置"><td>

</table>
</form>
<script language=javascript>
function isauth(i){
	var x=i.parentNode.parentNode.nextSibling;
	x.childNodes[1].childNodes[0].disabled=!i.checked;
	x.nextSibling.childNodes[1].childNodes[0].disabled=!i.checked;
}
</script>