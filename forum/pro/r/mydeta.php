<?php e_e();

if(isset($_REQUEST['phone'])){$sub="mydt";include "s/mydtck.php";}

function &rpq(&$s){return str_replace('"',"&#34;",$s);}
?>
<SCRIPT language=JavaScript src="../js/js.js"></script>
<SCRIPT language=JavaScript src="../js/chkin.js"></script>

<div class=O><a href="javascript:submitform()" id=fr class=whitelink>[ 提交 ]</a>我的资料</div>
<?php if($MSG)echo"<div class=bp5 style=border-top:0><tt class=warningc><b>提交结果!</b></tt><br>$MSG</div>";?>
<table width=100% class=x cellpadding=1 cellspacing=0>
<tr><td width=180 class=p5>关键资料<td width=20><input type=checkbox id=isaltermain name=isaltermain value=1 onclick="altermain(this)"><td>修改
</table>

<table width=100% class=b cellpadding=5 cellspacing=0>
<td width=180>用户名<td><INPUT TYPE=text id=username NAME=username maxlength=20 value="<?php echo rpq($ur->name); ?>" onchange="javascript:G('isregbtn').disabled=false"  onblur=checkname(this)> <input id=isregbtn type="button" value=是否已存在 onclick=checkifreg(this) disabled> <tt id=cnI></tt>
<?php echo $userexist==1?"<tr><TD><TD>用户已被注册,请更换注册名 ToT":"";?>
<TR><TD>原来密码*<TD><INPUT id="oldpass" type="password" NAME=oldpass maxlength=50 onblur=checkoldpass(this)> (至少6位)
<TR><TD>新密码<TD><INPUT id="userpass" type="password" NAME=userpass maxlength=50 onblur=checknewpass(this)> (不填,或6 - 50位)
<TR><TD>重复新密码<TD><INPUT id="ruserpass" type="password" NAME=ruserpass maxlength=50 onblur=checknewrpass(this)>
</table>

<div id=o>联系方式</div>

<table width=100% class=b cellpadding=5 cellspacing=0>
<td width=180>联系电话<td><INPUT type=text id=phone NAME=phone maxlength=20 value="<?php echo$ur->phon; ?>" onblur="checkphone(this);">
<TR><TD>QQ号<TD><INPUT type=text id=QQ NAME=QQ maxlength=20 value="<?php echo$ur->qq; ?>">
<TR><TD>电子邮件*<TD><INPUT TYPE=text id=email NAME=email maxlength=100 value="<?php echo rpq($ur->email);?>"> 必须填写，用于取回密码。
<TR><TD>个人主页地址<TD><INPUT type=text id=mypage NAME=homepage maxlength=500 value="<?php echo  rpq($ur->http);?>">
</table>

<div id=o>详细资料</div>

<table width=100% class=b cellpadding=5 cellspacing=0>
<TR><TD width=180>性别*<TD><INPUT type=radio NAME=sex value=1<?php echo $ur->sex?" checked":"";?>>男 <INPUT type=radio NAME=sex value=0<?php echo $ur->sex?"":" checked";?>>女
<TR><TD>生日<TD><INPUT type=text id=birthday NAME=birthday onblur="checkbirthday(this);" onfocus="this.select()" value="<?php echo $ur->bhday; ?>">
<TR><TD>头像<TD><INPUT type=radio NAME=facetype checked value="2" onclick="dontalterface()">保留原头像 <INPUT type=radio NAME=facetype value="0" onclick="selectsysface()">使用系统头像 <INPUT type=radio NAME=facetype value="1" onclick="selfupface()">重新上传<div id=uh_plain></div>
<TR><TD><a href=javascript:; onclick=selT(0) id=tabS class=selt>签名</a> / <a href=javascript:; onclick=selT(1) id=tabI>个人介绍</a>
<TD><div class=p5 id=mIcons></div><pre id=mySign class=EW contenteditable><?php echo $ur->sign;?></pre>
<pre id=myInfo class=hfdiv contenteditable><?php echo $ur->info;?></pre>
<div id=Info>状态</div></div>
</table>

<?php if($ur->bgs)include"mybgs.php";?>

<div id=o>附加参数</div>

<table width=100% class=b cellpadding=5 cellspacing=0>
<tr><TD width=180>最新帖子时限<td><INPUT type=text class=input30 id=newtime NAME=newtime value="<?php echo $ur->newt; ?>"> (1-300)小时
<tr><TD>回复页面尺寸<td><INPUT type=text class=input30 id=replaysize NAME=replaysize value="<?php echo $ur->rsize; ?>"> (20-60)行回复
<tr><TD>论坛帖子页面尺寸<td><INPUT type=text class=input30 id=itemsize NAME=itemsize value="<?php echo $ur->isize; ?>"> (20-60)行帖子
</table>

<table width=100% class=bar3 cellpadding=1 cellspacing=0>
<tr><td width=180 class=p5>重算个人数据<td width=20><input type="checkbox" name=recount><td>重新统计您的朋友、订阅、消息、帖子、回复等数量。
</table>

<div class=O><a href="javascript:submitform()" id=fr class=whitelink>[ 提交 ]</a>我的资料</div>

<script language=JavaScript>uh_head="<?php echo$pic?"$pic\";G('head0').src=\"../faces/$pic":$ur->face;?>"</script>
<script src=../w/uh.js language=javascript></script>
<script src=../mjs/uh.js language=javascript></script>
<script src=e/myinfo.js language=javascript></script>
<script language=JavaScript src=js/r/mydt.js></script>