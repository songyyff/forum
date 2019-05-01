<SCRIPT language="JavaScript" src="../js/js.js"></script>
<SCRIPT language="JavaScript" src="../js/rag/lgi.js"></SCRIPT>
<table width="100%" class=bar1b border=1 cellpadding=0 cellspacing=0>
<tr height="23"><TD align="center" class="sf12" valign="middle"><b>用户登陆</b></TD></tr></table>
<FORM class=bdlr1 id=mainform METHOD=post ACTION="login.php">
<table width=70% cellpadding=5 cellspacing=0 align=center>
<tr><TD height=60></TD><TD id=resultinfo valign=bottom><?php echo $loginresult?"登陆失败用户名和密码不正确,请重新填写 ToT":"";?></TD></tr>
<TR><TD>用户名</TD><TD><INPUT TYPE=text id=username NAME=username onfocus="clearinfo()" value="<?php echo $loginresult?f_rpspc($_POST['username']):""; ?>" onblur="checkname(this)" ACCESSKEY=N>&nbsp;<a class=goldlink href="userreg.php">[ 我要注册 ]</a></TD></TR>
<TR><TD>密码</TD><TD><INPUT id="userpass" onfocus="clearinfo()" type="password" NAME=userpass onblur="checkpass(this)" ACCESSKEY=P>&nbsp;(至少6位) <a class=goldlink href="../help/help.php?helpid=8">[ 忘记密码 ]</a></td></TR>
<tr><TD>有效时间</TD><TD><input type="radio" onfocus="clearinfo()" name="loginexpire" value="year">一年&nbsp;&nbsp;<input type="radio" onfocus="clearinfo()" name="loginexpire" checked value="month">一个月&nbsp;&nbsp;<input type="radio" onfocus="clearinfo()" name="loginexpire" value="week">一星期&nbsp;&nbsp;<input type="radio" name="loginexpire" onfocus="clearinfo()" value="day">一天</TD></tr>
<tr height=80><td></td><TD valign=top><INPUT TYPE=button onclick="submitform()" VALUE="      登陆      " ACCESSKEY=S> &nbsp; <INPUT type="reset"  VALUE=" 重置 " ACCESSKEY=O></Td></TR>
</table>
</FORM>
