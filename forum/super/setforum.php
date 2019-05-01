<?php

e_e();

if(isset($_R[name])){
$x=Array(name,comment,phone,fax,address,postno,email,techmail,servicemail,QQ,http,footmode,mailfoot);
for($i=0,$l=count($x);$i<$l;$i++){
$q="update tdict set info=\"".f_rpspc($_R[$x[$i]])."\",ctime=now() where type=13 and ikey=\"$x[$i]\"";
mysql_query($q) or die(f_e($q));
}
$q="update tdict set info=\"".f_slquot($_R[mailrealfoot])."\" where type=13 and ikey=\"mailrealfoot\"";
mysql_query($q) or die(f_e($q));

include"wmailf.php";
}

echo "<div class=subhead align=right><b>设置论坛资料</b> ",date("Y-m-d H:i:s",time()),"<hr></div><font color=red>$msg</font>";

//论坛软件信息
$q="select ikey,info from tdict where type=13 order by key1";
$rs=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($rs))$z[$r->ikey]=$r->info;
mysql_free_result($rs);
echo "<form method=post onsubmit=\"return checkdata(this)\"action=\"?type=$vtype\"><table id=start1 cellspacing=0 cellpadding=5 width=100%><tr class=bar2><td width=170>论坛信息</td><td>这些资料会在论坛界面和向论坛用户发送邮件中使用，请您正确填写!</td></tr><tr><td>软件版本</td><td>$z[version]</td></tr><tr><td>安装时间</td><td>$z[datetime]</td></tr><tr><td>论坛名称</td><td><input type=text name=name value=\"$z[name]\"></td></tr><tr><td>论坛说明</td><td><textarea name=comment rows=4>$z[comment]</textarea></td></tr><tr><td>办公电话</td><td><input type=text name=phone value=\"$z[phone]\"></td></tr><tr><td>传真</td><td><input type=text name=fax value=\"$z[fax]\"></td></tr><tr><td>办公地址</td><td><input type=text name=address value=\"$z[address]\"></td></tr><tr><td>邮编</td><td><input type=text name=postno value=\"$z[postno]\"></td></tr><tr><td>Email</td><td><input type=text name=email value=\"$z[email]\"></td></tr><tr><td>技术支持邮件</td><td><input type=text name=techmail value=\"$z[techmail]\"></td></tr><tr><td>客户服务邮件</td><td><input type=text name=servicemail value=\"$z[servicemail]\"></td></tr><tr><td>联系QQ</td><td><input type=text name=QQ value=\"$z[QQ]\"></td></tr><tr><td>网址</td><td><input type=text name=http value=\"$z[http]\"></td></tr><tr><td></td><td><input type=radio name=footmode onclick=setfoot(this) value=0",$z[footmode]?"":" checked",">设置邮件页脚(HTML) &nbsp; <input type=radio name=footmode onclick=setfoot(this) value=1",$z[footmode]?" checked":"",">设置邮件页脚(文本)</td></tr><tr><td>邮件页脚</td><td><textarea name=mailfoot rows=4>$z[mailfoot]</textarea><br><input type=button onclick=viewfoot() value=邮件页脚预览></td></tr><tr><td></td><td></td></tr><tr height=43><td><textarea name=mailrealfoot class=hid></textarea></td><td><input type=submit value=\"  提交(S)  \"> &nbsp; <input type=reset value=\"重置\"></td></tr></table></form><br>";

//论坛数据库信息
$q="select * from tdict where type=11 order by key1";
$rs=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($rs))$x[$r->ikey]=$r->info;
mysql_free_result($rs);
echo "<table cellspacing=0 cellpadding=5 width=100%>
	<tr class=bar2><td width=170>论坛数据库信息</td><td></td></tr>
	<tr><td>数据库版本</td><td>$x[version]</td></tr>
	<tr><td>安装时间</td><td>$x[datetime]</td></tr>
</table>";
?>
<script src="../js/js.js" language=javascript></script>
<script src="../js/tag.js" language=javascript></script>
<script language=javascript>
function G(d){return document.getElementById(d);}
function resize(){
var o=G('start1').childNodes[0],i,a=[3,4,7,13,15];
for(i=0;i<a.length;i++)o.childNodes[a[i]].childNodes[1].childNodes[0].style.width=screen.width-500;
}
resize();
var isHTML=<?php echo !$z[footmode];?>;
function setfoot(e){
isHTML=e.value;
var o=G('start1').childNodes[0],i,k,is=new Array();
for(i=0,k=o.childNodes[3];i<11;i++,k=k.nextSibling)is[is.length]=trim(k.childNodes[1].childNodes[0].value);
o.childNodes[15].childNodes[1].childNodes[0].value=e.value==1?
is[0]+"\n"+
(is[2]?"办公电话："+is[2]+"  ":"")+(is[3]?"传真："+is[3]:"")+
(is[4]?"\n地址："+is[4]+
"\n邮编："+is[5]:"")+
(is[6]?"\n邮件地址："+is[6]:"")+
(is[7]?"\n技术支持："+is[7]:"")+
(is[8]?"\n客户服务："+is[8]:"")+
(is[9]?"\n联系QQ：  "+is[9]:"")+
(is[10]?"\n网站地址："+is[10]:"")
:
is[0]+"\n"+
(is[2]?"办公电话："+is[2]+"  ":"")+(is[3]?"传真："+is[3]:"")+
(is[4]?"\n地址："+is[4]+
"\n邮编："+is[5]:"")+
(is[6]?"\n邮件地址：[email]"+is[6]+"[/email]":"")+
(is[7]?"\n技术支持：[email]"+is[7]+"[/email]":"")+
(is[8]?"\n客户服务：[email]"+is[8]+"[/email]":"")+
(is[9]?"\n联系QQ：  "+is[9]:"")+
(is[10]?"\n网站地址：[url]"+is[10]+"[/url]":"")
is[0]+"论坛"+
""+is[0]+"论坛 "+(k&1?is[10]:"<a href=\""+is[10]+"\">"+is[10]+"</a>");
viewfoot();
}
function viewfoot(){
var o=G('start1').childNodes[0],
s=rpspc(o.childNodes[15].childNodes[1].childNodes[0].value);
o.childNodes[16].childNodes[1].innerHTML="<pre class=bd1pd1>"+(isHTML?gethtml(s):s)+"</pre>";
}
function gethtml(s){
var k=getemailtagcls(screen.width-550);
k.syb=k.sye="";
return k.emailtagtostr(s);
}
function checkdata(f){
var t=true,
i,k,
os=new Array(),
o=G('start1').childNodes[0];
for(i=0,k=o.childNodes[3];i<11;i++,k=k.nextSibling)os[os.length]=k.childNodes[1].childNodes[0];
s=rpspc(o.childNodes[15].childNodes[1].childNodes[0].value);
o.lastChild.childNodes[0].childNodes[0].value=isHTML?gethtml(s):s;
return t;
}
</script>