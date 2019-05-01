<SCRIPT language="JavaScript" src="../js/js.js"></script>
<SCRIPT language="JavaScript" src="../js/chkin.js"></script>

<div class=hb1p1 align=right>快速注册</div>
<FORM id=mainform enctype="multipart/form-data" METHOD=post ACTION="userreg.php">
<div class=bdlr1 STYLE="PADDING:5">
<table width=80% align=center cellpadding=2 cellspacing=0>
<TR><TD WIDTH=140>用户名*</TD><TD><INPUT TYPE=text id=username NAME=username value="<?php echo $userexist?f_rpspc($_POST['username']):""; ?>" onchange="G('isregbtn').disabled=false;"  onblur="checkname(this);" ACCESSKEY=N> <input id=isregbtn type="button" value="是否已注册" onclick="checkifreg(this)" disabled></TD></TR>
<?php echo $userexist==1?"<tr><TD></TD><TD>用户已被注册,请更换注册名 ToT</TD></tr>":""; ?>
<TR><TD>用户密码*</TD><TD><INPUT id="userpass" type="password" NAME=userpass onblur="checkpass(this)" ACCESSKEY=P> (至少6位)</td></TR>
<TR><TD>重复密码*</TD><TD><INPUT id="ruserpass" type="password" NAME=ruserpass onblur="checkrpass(this);" ACCESSKEY=R></TD></TR>
<TR><TD>性别*</TD><TD><INPUT type="radio" NAME=sex value=1 checked>男 &nbsp;<INPUT type="radio" NAME=sex value=0>女</TD></TR>
<TR><TD>电子邮件*</TD><TD><INPUT TYPE=text id=email NAME=email value="<?php echo $userexist?f_rpspc($_POST['email']):""; ?>" onblur="checkemail(this);">&nbsp;必须填写，用于取回密码。</TD></TR>
</table>
</DIV>

<div class=hb1p1 align=right><a href="javascript:expenddetail()" class=goldlink>详细信息</a></div>

<div id=detailinfo>
<div class=bdlr1 STYLE="PADDING:5"> 
<table width=80% align=center cellpadding=2 cellspacing=0>
<TR class="bar2"><TD width=140>主要信息</TD><td></td></TR>
<TR><TD>生日</TD><TD><INPUT type="text" id=birthday NAME=birthday onblur="checkbirthday(this);" onfocus="this.select()" value="<?php echo $userexist?f_rpspc($_POST['birthday']):"1955-01-01"; ?>"></td></TR>
<TR><TD>联系电话</TD><TD><INPUT type="text" id=phone NAME=phone value="<?php echo $userexist?f_rpspc($_POST['phone']):""; ?>" onblur="checkphone(this);"></td></TR>
<TR><TD>QQ号</TD><TD><INPUT type="text" id=QQ NAME=QQ value="<?php echo $userexist?(int)$_POST['QQ']:""; ?>" onblur="checkqq(this);"></td> </TR>
<TR><TD>MSN号</TD><TD><INPUT type="text" id=msn NAME=msn value="<?php echo $userexist?f_rpspc($_POST['msn']):""; ?>" onblur="checkmsn(this);"></td></TR>
<TR><TD>雅虎通号<br>Yahoo messenger</TD><TD><INPUT type="text" id=yahoo NAME=yahoo value="<?php echo $userexist?f_rpspc($_POST['yahoo']):""; ?>" onblur="checkyahoo(this);"></td></TR>
<TR><TD>淘宝旺旺号</TD><TD><INPUT type="text" id=ww NAME=ww value="<?php echo $userexist?f_rpspc($_POST['ww']):""; ?>" onblur="checkww(this);"></td></TR>
<TR><TD>个人主页地址</TD><TD><INPUT type="text" id=homepage NAME=homepage value="<?php echo $userexist?f_rpspc($_POST['homepage']):""; ?>" onblur="checkhomepage(this);"></td></TR>
<TR><TD>头像</TD><TD><INPUT type="radio" NAME=facetype checked value="0" onclick="selectsysface()">使用系统头像 &nbsp;<INPUT type="radio" NAME=facetype value="1" onclick="javascript:selfupface()">自己上传</td></TR>
<tr><TD></TD><td><span id=uh_plain></span></td></tr>
<TR><TD>签名</TD><TD><textarea id=signature NAME=signature onblur="checksignature(this);"><?php echo $userexist?f_rpspc($_POST['signature']):""; ?></textarea></td></TR>
<tr><td></td><td><font class="sf12">(最多1000字)支持[img]标签</font></td></tr>
<TR><TD>个人介绍</TD><TD><textarea id=selfinfo NAME=selfinfo onblur="checkselfinfo(this);"><?php echo $userexist?f_rpspc($_POST['selfinfo']):""; ?></textarea></td></TR>
<tr><td></td><td><font class="sf12">(最多2000字)支持[img]标签</font></td></tr>

<tr class=bar2><td>附加参数</td><td></td></tr>

<tr><TD>最新帖子时限</TD><td><INPUT type="text" id=newtime class=input30 NAME=newtime value="<?php echo $userexist?(int)$_POST['newtime']:"26"; ?>" onblur="checknewtime(this);"> 小时(1-300)</td></tr>
<tr><TD>回复页面尺寸</TD><td><INPUT type="text" id=replaysize class=input30 NAME=replaysize value="<?php echo $userexist?(int)$_POST['replaysize']:"20"; ?>" onblur="checkreplaysize(this);"> 行回复(20-60)</td></tr>
<tr><TD>论坛帖子页面尺寸</TD><td><INPUT type="text" id=itemsize class=input30 NAME=itemsize value="<?php echo $userexist?(int)$_POST['itemsize']:"30"; ?>" onblur="checkitemsize(this);"> 行帖子(20-60)</td></tr>
<tr class=bar2><TD colspan="4"></TD></tr>
</table>
</div>
</div>
<div class=bdlr1 STYLE="PADDING:5"> 
<table width=80% align=center>
<tr height=40><td width=140></td><TD><INPUT TYPE=button onclick="submitform();" VALUE="    注册    " ACCESSKEY=S><input type="hidden" name="regstep" value="1"></TD></TR>
</table>
</div>
<div class=bdlr1 STYLE="PADDING:5"></div>
</FORM>
<script language=javascript>uh_head=""</script>
<script src="../w/uh.js" language=javascript></script>
<script src="../mjs/uh.js" language=javascript></script>
<script language="JavaScript" src="../js/rag/rgu.js"></script>