<SCRIPT language="JavaScript" src="../js/js.js"></script>
<SCRIPT language="JavaScript" src="../js/chkin.js"></script>

<FORM id=mainform enctype="multipart/form-data" METHOD=post ACTION="userreg.php">
<div class=hb1p1 align=right>必须填写</div>

<table width=770 align=center cellpadding=2 cellspacing=0>
<?php
function &rpq(&$s){return str_replace('"',"&#34;",$s);}
$U=isset($_R['username']);
if($MSG)echo"<TR class=warningc><TD WIDTH=140>注册错误<TD>$MSG";
?>
<TR><TD WIDTH=140>用户名<TD><INPUT TYPE=text id=username NAME=username maxlength=20 value="<?php echo$U?rpq($_R['username']):"";?>" onchange=G('isregbtn').disabled=false  onblur=checkname(this)> <input id=isregbtn type="button" value=是否已注册 onclick=checkifreg(this) disabled> <tt id=cnI></tt>
<?php echo$Uexist?"<tr><TD><TD>用户已被注册,请更换注册名 ToT":"";?>
<TR><TD>用户密码<TD><INPUT id=userpass type=password NAME=userpass maxlength=50 onblur=checkpass(this)> (至少6位,最多50位)
<TR><TD>重复密码<TD><INPUT id=ruserpass type=password NAME=ruserpass maxlength=50 onblur=checkrpass(this)>
<TR><TD>性别<TD><INPUT type=radio NAME=sex value=1 checked>男 <INPUT type=radio NAME=sex value=0>女
<TR><TD>电子邮件<TD><INPUT TYPE=text id=email NAME=email maxlength=100 value="<?php echo $U?rpq($_R['email']):""; ?>" onblur=checkemail(this)> 必须填写，用于取回密码。</TD>
</table>

<div class=hb1p1 align=right>详细信息</div>

<table width=770 align=center cellpadding=2 cellspacing=0>
<TR><TD width=140>生日<TD><INPUT type=text id=birthday NAME=birthday onblur=checkbirthday(this) onfocus=this.select() value="<?php echo$U?rpq($_R['birthday']):"1955-01-01"; ?>">
<TR><TD>联系电话</TD><TD><INPUT type=text id=phone NAME=phone maxlength=20 value="<?php echo$U?rpq($_R['phone']):""; ?>" onblur=checkphone(this)>
<TR><TD>QQ号</TD><TD><INPUT type=text id=QQ NAME=QQ maxlength=20 value="<?php echo$U?$_R['QQ']:""; ?>" onblur=checkqq(this)> 
<TR><TD>个人主页地址</TD><TD><INPUT type=text id=homepage NAME=homepage maxlength=500 value="<?php echo$U?rpq($_R['homepage']):""; ?>" onblur=checkhomepage(this)>

<tr class=bar2><td><td>

<TR><TD>头像</TD><TD><INPUT type=radio NAME=facetype checked value=0 onclick=selectsysface()>使用系统头像 <INPUT type=radio NAME=facetype value=1 onclick=selfupface()>自己上传
<tr><TD><td><span id=uh_plain></span>

<tr class=bar2><td><td>

<TR><TD><a href=javascript:; onclick=selT(0) id=tabS class=selt>签名</a> / <a href=javascript:; onclick=selT(1) id=tabI>个人介绍</a><TD><div class=p5 id=mIcons></div><pre id=mySign class=EW contenteditable><?php echo$iS;?></pre>
<pre id=myInfo class=hfdiv contenteditable><?php echo$iI;?></pre>
<div id=Info>状态</div></div>

<tr class=bar2><td><td>

<tr><TD>最新帖子时限</TD><td><INPUT type=text id=newtime class=input30 NAME=newtime value=<?php echo$U?(int)$_R['newtime']:26; ?> onblur=checknewtime(this)> 小时(1-300)
<tr><TD>回复页面尺寸</TD><td><INPUT type=text id=replaysize class=input30 NAME=replaysize value=<?php echo$U?(int)$_R['replaysize']:20; ?> onblur=checkreplaysize(this)> 行回复(20-60)
<tr><TD>论坛帖子页面尺寸</TD><td><INPUT type=text id=itemsize class=input30 NAME=itemsize value=<?php echo$U?(int)$_R['itemsize']:30; ?> onblur=checkitemsize(this)> 行帖子(20-60)

<tr class=bar2><td><td>

<tr height=40><td><TD style='padding:20 0'><INPUT TYPE=button onclick=submitform() VALUE="    注册    " default><input type=hidden name=regstep value=1>

</table>

</FORM>

<script language=javascript>uh_head=""</script>
<script src=../w/uh.js language=javascript></script>
<script src=../mjs/uh.js language=javascript></script>
<script src=js/r/rgu.js language=JavaScript></script>
<script src=e/myinfo.js language=javascript></script>