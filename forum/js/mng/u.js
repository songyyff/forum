/*
u.php 脚本
*/

function getlevelsel(n){
	var s="";
	for(var i=0;i<ulevels.length/2;i++) s+="<OPTION value="+ulevels[i*2]+(ulevels[i*2]==irows[n][2]?" selected":"")+">"+ulevels[i*2+1]+"</OPTION>";
	return "<select class=mgtb1 name=level"+irows[n][0]+" id=level"+irows[n][0]+" disabled>"+s+"</select>";
}

function getboxsel(n){
	var s="";
	for(var i=0;i<boxs.length/3;i++) s+="<OPTION value="+boxs[i*3]+(boxs[i*3]==irows[n][6]?" selected":"")+">("+boxs[i*3+1]+") "+boxs[i*3+2]+"</OPTION>";
	return "<select class=mgtb1 name=box"+irows[n][0]+" id=box"+irows[n][0]+" disabled>"+s+"</select>";
}

var ww=screen.width-20-30-200-29-85-5;

function builddiv(i){
var c,n=irows[i][0];
c=G('cdiv'+i)
c.style.visibility="visible";
c.innerHTML="<table width=100% border=0 cellpadding=0 cellspacing=0 class=bd1><tr><td class=pd1>\
<table width=100% border=0 cellpadding=0 cellspacing=0>\
<tr>\
<td width=29>&nbsp;</td>\
<td width=85>快照</td>\
<td class=pdtb1p id=snaptd"+i+"></td>\
</tr>\
<tr>\
<td class=bdt1pdtb3p>&nbsp;<input type=checkbox id=iscomm"+i+" name=comms[] onclick=\"ckcomm(this.checked,"+i+")\" value="+n+"></td>\
<td class=bdt1pdtb3p>注释</td>\
<td class=bdt1pdtb3p id=commtd"+i+"></td>\
</tr>\
<tr>\
<td class=bdt1pdtb3p valign=top>&nbsp;<input type=checkbox id=ismscomm"+i+" name=mscomms[] onclick=\"ckmscomm(this.checked,"+i+")\" value="+n+"></td>\
<td class=bdt1pdt5p valign=top>管理员评说</td>"+
(IE?"<td class=bdt1pdtb3p><div id=mscommtd"+i+"></div></td>":"<td  id=mscommtd"+i+" class=fxwin></td>")+
"</tr>\
<tr>\
<td valign=top class=bdt1pdtb3p>&nbsp;<input type=checkbox id=mngs"+i+" name=mngs[] onclick=\"ckm(this.checked,"+i+")\" value="+n+"></td>\
<td class=bdt1pdt5p valign=top>管理</td>\
<td id=mngp"+i+" class=bdt1pdtb3p></td>\
</tr>\
</table></td></tr></table>";
}
function buildmng(i){
	var r,c,n=irows[i][0];
	r=irows[i][4];
	c=" checked";
	G('mngp'+i).innerHTML="<table border=1 cellpadding=0 cellspacing=0>"+
"<tr height=22 align=center>"+
"	<TD width=72 class=bdlt1>联系</TD>"+
"<TD width=15 rowspan=3 class=bdltb1><input type=checkbox value=1 id=isbs"+n+" name=isbs"+n+" onclick=\"ckisbs(this.checked,"+n+")\"></TD>"+
"	<TD colspan=2 class=bdlt1>其他</TD>"+
"	<TD colspan=7 class=bdltr1>最大</TD>"+
"</tr>"+
"<tr height=22 align=center>"+
"	<TD class=bdlt1><a class=goldlink href=\"../pro/msgs.php?type=3&userid="+n+"\" target=ewin"+n+">消息</a></TD>"+
"	<TD width=41 class=bdlt1>状态</TD>"+
"	<TD class=bdlt1>&nbsp;<select class=mgtb1 name=ustat"+n+" id=ustat"+n+" disabled><OPTION value=E"+(irows[i][1]=='E'?" selected":"")+">有效</OPTION><OPTION value=D"+(irows[i][1]=='D'?" selected":"")+">失效</OPTION></select>&nbsp;</TD>"+
"	<TD width=58 class=bdlt1>消息</TD>"+
"	<TD width=55 class=bdlt1>收到数</TD>"+
"	<TD width=68 class=bdlt1><INPUT type=text class=innum id=mmr"+n+" NAME=mmr"+n+" onfocus=\"infcs("+n+",0)\" onblur=\"cekinnum("+n+",this,2)\" disabled value="+irows[i][12]+"></TD>"+
"	<TD width=55 class=bdlt1>发送数</TD>"+
"	<TD width=68 class=bdlt1><INPUT type=text class=innum id=mms"+n+" NAME=mms"+n+" onfocus=\"infcs("+n+",1)\" onblur=\"cekinnum("+n+",this,3)\" disabled value="+irows[i][13]+"></TD>"+
"	<TD width=55 class=bdlt1>删除数</TD>"+
"	<TD width=69 class=bdltr1><INPUT type=text class=innum id=mmd"+n+" NAME=mmd"+n+" onfocus=\"infcs("+n+",2)\" onblur=\"cekinnum("+n+",this,4)\" disabled value="+irows[i][14]+"></TD>"+
"</tr>"+
"<tr height=22 align=center>"+
"	<TD class=bdltb1><a class=goldlink href=\"mailto:"+irows[i][17]+"\">邮件</a></TD>"+
"	<TD class=bdltb1>等级</TD>"+
"	<TD class=bdltb1>&nbsp;"+getlevelsel(i)+"&nbsp;</TD>"+
"	<TD class=bdltb1>其他</TD>"+
"	<TD class=bdltb1>订阅数</TD>"+
"	<TD class=bdltb1><INPUT type=text class=innum id=msb"+n+" NAME=msb"+n+" onfocus=\"infcs("+n+",3)\" onblur=\"cekinnum("+n+",this,5)\" disabled value="+irows[i][15]+"></TD>"+
"	<TD class=bdltb1>朋友数</TD>"+
"	<TD class=bdltb1><INPUT type=text class=innum id=mf"+n+" NAME=mf"+n+" onfocus=\"infcs("+n+",4)\" onblur=\"cekmf("+n+",this)\" disabled value="+irows[i][16]+"></TD>"+
"	<TD colspan=2 class=bd1>&nbsp;</TD>"+
"</tr>"+
"</table>"+
"<table border=1 cellpadding=0 cellspacing=0>"+
"<tr height=22 align=center>"+
"	<TD colspan=4 class=bdlt1>增加</TD>"+
"	<TD class=bdltr1 align=left>&nbsp;原因</TD>"+
"</tr>"+
"<tr height=22>"+
"<TD width=15 rowspan=3 class=bdltb1><input type=checkbox value=1 id=isinc"+n+" name=isinc"+n+" onclick=\"ckisinc(this.checked,"+n+")\"></TD>"+
" <TD width=51 class=bdlt1 align=center>阅读权</TD>"+
"	<TD width=62 align=right class=bdlt1>"+irows[i][5]+"&nbsp;</TD>"+
"	<TD class=bdlt1>&nbsp;<INPUT type=text class=innum id=rdn"+n+" NAME=rdn"+n+" onfocus=\"infcs("+n+",5)\" onblur=\"cekrdn("+i+",this)\" disabled>&nbsp;</TD>"+
"	<TD class=bdltr1>&nbsp;<INPUT type=text class=incomms id=rdnc"+n+" NAME=rdnc"+n+" disabled>&nbsp;</TD>"+
"</tr>"+
"<tr height=22>"+
" <TD class=bdlt1 align=center>金钱数</TD>"+
"	<TD align=right class=bdlt1>"+irows[i][10]+"&nbsp;</TD>"+
"	<TD class=bdlt1>&nbsp;<INPUT type=text class=innum id=mny"+n+" NAME=mny"+n+" onfocus=\"infcs("+n+",6)\" onblur=\"cekmny("+i+",this)\" disabled></TD>"+
"	<TD class=bdltr1>&nbsp;<INPUT type=text class=incomms id=mnyc"+n+" NAME=mnyc"+n+" disabled></TD>"+
"</tr>"+
"<tr height=22>"+
" <TD class=bdltb1 align=center>积分值</TD>"+
"	<TD align=right class=bdltb1>"+irows[i][11]+"&nbsp;</TD>"+
"	<TD class=bdltb1>&nbsp;<INPUT type=text class=innum id=pit"+n+" NAME=pit"+n+" onfocus=\"infcs("+n+",7)\" onblur=\"cekpit("+i+",this)\" disabled></TD>"+
"	<TD class=bd1>&nbsp;<INPUT type=text class=incomms id=pitc"+n+" NAME=pitc"+n+" disabled></TD>"+
"</tr>"+
"</table>"+
"<table border=1 cellpadding=0 cellspacing=0>"+
"<tr height=22 align=center>"+
"<TD width=15 rowspan=2 class=bdltb1><input type=checkbox value=1 id=isright"+n+" name=isright"+n+" onclick=\"ckisright(this.checked,"+n+")\"><input type=hidden class=innum name=right"+n+" id=right"+n+"></TD>"+
" <TD width=51 rowspan=2 class=bdltb1>设权限</TD>"+
"	<TD width=62 class=bdlt1>浏览</TD>"+
"	<TD width=62 class=bdlt1>发贴</TD>"+
"	<TD width=62 class=bdlt1>回复</TD>"+
"	<TD width=62 class=bdlt1>修改</TD>"+
"	<TD width=62 class=bdlt1>投票</TD>"+
"	<TD width=62 class=bdlt1>短信</TD>"+
"	<TD width=62 class=bdlt1>未禁言</TD>"+
"	<TD width=124 class=bdltr1>是否管理员</TD>"+
"</tr>"+
"<tr height=22 align=center>"+
"	<TD class=bdltb1 id=rtd0"+n+"></TD>"+
"	<TD class=bdltb1 id=rtd1"+n+"></TD>"+
"	<TD class=bdltb1 id=rtd2"+n+"></TD>"+
"	<TD class=bdltb1 id=rtd3"+n+"></TD>"+
"	<TD class=bdltb1 id=rtd4"+n+"></TD>"+
"	<TD class=bdltb1 id=rtd5"+n+"></TD>"+
"	<TD class=bdltb1 id=rtd6"+n+"></TD>"+
"	<TD class=bd1 id=rtd7"+n+">"+(irows[i][18]?"<font class=warningc>是[ "+irows[i][18]+" ]</font>":"否")+"</TD>"+
"</tr>"+
"</table>"+
"<table border=1 cellpadding=0 cellspacing=0>"+
"<tr height=22>"+
"<TD width=15 class=bdlt1><input type=checkbox value=1 id=isrmv"+n+" name=isrmv"+n+" onclick=\"ckisrmv(this.checked,"+n+")\"></TD>"+
" <TD width=51 class=bdlt1 align=center>很谨慎</TD>"+
" <TD width=15 class=bdlt1><input type=checkbox id=del"+n+" name=del"+n+" value=1 onclick=\"ckdel(this.checked,"+n+",true)\" disabled></TD>"+
"	<TD width=60 class=bdt1 id=deltd"+n+">删除用户</TD>"+
"	<TD width=15 class=bdlt1><input type=checkbox id=di"+n+" name=di"+n+" value=1 onclick=\"cksets(this.checked,"+n+",1)\" disabled></TD>"+
"	<TD width=60 class=bdt1 id=setstd1>删除帖子</TD>"+
"	<TD width=15 class=bdlt1><input type=checkbox id=dr"+n+" name=dr"+n+" value=1 onclick=\"cksets(this.checked,"+n+",2)\" disabled></TD>"+
"	<TD width=60 class=bdt1 id=setstd2>删除回复</TD>"+
"	<TD width=15 class=bdlt1><input type=checkbox id=sp"+n+" name=sp"+n+" value=1 onclick=\"cksets(this.checked,"+n+",3)\" disabled></TD>"+
"	<TD width=60 class=bdt1 id=setstd3>重置密码</TD>"+
"	<TD width=15 class=bdlt1><input type=checkbox id=spc"+n+" name=spc"+n+" value=1 onclick=\"cksets(this.checked,"+n+",4)\" disabled></TD>"+
"	<TD width=60 class=bdt1 id=setstd4>重置头像</TD>"+
"	<TD width=15 class=bdlt1><input type=checkbox value=1 id=ss"+n+" name=ss"+n+" onclick=\"cksets(this.checked,"+n+",5)\" disabled></TD>"+
"	<TD width=60 class=bdt1 id=setstd5>重置签名</TD>"+
"	<TD width=15 class=bdlt1><input type=checkbox value=1 id=si"+n+" name=si"+n+" onclick=\"cksets(this.checked,"+n+",6)\" disabled></TD>"+
"	<TD width=59 class=bdtr1 id=setstd6>重置简介</TD>"+
"</tr>"+
"<tr height=22>"+
"	<TD class=bdlt1><input type=checkbox value=1 id=src"+n+" name=src"+n+"></TD>"+
"	<TD class=bdt1 colspan=3>数据重计算</TD>"+
"	<TD class=bdlt1><input type=checkbox value=1 id=ismb"+n+" name=ismb"+n+" onclick=\"ckismb(this.checked,"+n+")\"></TD>"+
"	<TD class=bdt1>移管理箱</TD>"+
"	<TD colspan=6 class=bdlt1>&nbsp;"+getboxsel(i)+"</TD>"+
"	<TD class=bdlt1><input type=checkbox value=1 id=lsm"+n+" name=lsm"+n+" onclick=\"cklsm(this.checked,"+n+")\"></TD>"+
"	<TD class=bdtr1 colspan=3>管理后放弃</TD>"+
"</tr>"+
"</table>"+
"<table border=1 cellpadding=0 cellspacing=0>"+
"<tr height=22>"+
"	<TD width=72 align=center class=bdltb1>消息</TD>"+
"	<TD width=565 class=bd1 id=ermsg"+n+">&nbsp;</TD>"+
"</tr>"+
"</table>"; 

G('right'+n).value=irows[i][4];
ckisright(G('isright'+n).checked,n);
}
incekmsgs=new Array();
incekmsgs[0]="必须是100 - 2000的数值."; 
incekmsgs[1]="必须是10 - 200数值.";
incekmsgs[2]="最大消息收到数,";
incekmsgs[3]="最大消息发送数,";
incekmsgs[4]="最大消息删除数,";
incekmsgs[5]="最大帖子订阅数,";
incekmsgs[6]="<font class=warningc>&nbsp;";
function cekinnum(n,t,i){
	t.value=trim(t.value);
	if(!isnummm(t.value,2000,100)){	
		t.style.backgroundColor=WarningColor;
		return false;
	} 
	t.style.backgroundColor=G('right'+n).style.backgroundColor;
	return true;
}
function cekmf(n,t){
	t.value=trim(t.value);
	if(!isnummm(t.value,200,10)){
		t.style.backgroundColor=WarningColor;
		return false;
	}
	t.style.backgroundColor=G('right'+n).style.backgroundColor;
	return true;
}
function cekrdn(i,t){
	t.value=trim(t.value);
	if(!isnummm(t.value,20,-20)){
		t.style.backgroundColor=WarningColor;
		return false;
	}
	t.style.backgroundColor=G('right'+irows[i][0]).style.backgroundColor;
	return true;
}
function cekmny(i,t){
	t.value=trim(t.value);
	if(!isnummm(t.value,100,-100)){
		t.style.backgroundColor=WarningColor;
		return false;
	}
	t.style.backgroundColor=G('right'+irows[i][0]).style.backgroundColor;
	return true;
}
function cekpit(i,t){
	t.value=trim(t.value);
	var v=irows[i][11];
	v=v?-1*(v>100?100:v):0;
	if(!isnummm(t.value,100,v)){
		t.style.backgroundColor=WarningColor;
		return false;
	}
	t.style.backgroundColor=G('right'+irows[i][0]).style.backgroundColor;
	return true;
}
function ckisright(s,n){
	var j,k;
	for(j=0;j<7;j++){
		k="["+(parseInt(G('right'+n).value)&1<<(j)?"V":"X")+"]";
		G('rtd'+j+n).innerHTML=s?"<a class=goldlink href=\"javascript:ckright("+n+","+j+")\">"+k+"</a>":k;
	}
	G('right'+n).disabled=!s;
}
function ckright(n,j){
	var obj=G('right'+n);
	obj.value=parseInt(obj.value)^(1<<j);
	G('rtd'+j+n).innerHTML="<a class=goldlink href=\"javascript:ckright("+n+","+j+")\">["+(parseInt(obj.value)&(1<<j)?"V":"X")+"]</a>";
}
inmsgs=new Array();
inmsgs[0]="最大消息收到数是一个100 - 2000的数值,默认 600";
inmsgs[1]="最大消息已经发送数是一个100 - 2000的数值,默认 500";
inmsgs[2]="最大消息已删除数是一个100 - 2000的数值,默认 400";
inmsgs[3]="最大订阅帖子数是一个100 - 2000的数值,默认 500";
inmsgs[4]="最大朋友数是一个10 - 200的数值,默认 50";
inmsgs[5]="阅读权增加或减少值每次最大为20(负数表示减少),当用户被减至负值自动置零";
inmsgs[6]="金钱增加或减少值每次最大为100(负数表示减少),当用户被减至负值自动置零";
inmsgs[7]="积分增加或减少值每次最大为100(负数表示减少),当用户被减至负值自动置零";
function infcs(n,i){
	G('ermsg'+n).innerHTML="<font color=blue>&nbsp;"+inmsgs[i]+"</font>";
}
mbs=new Array('ustat','level','mmr','mms','mmd','msb','mf');
minc=new Array('rdn','rdnc','mny','mnyc','pit','pitc');
mrmv=new Array(
'del',"删除用户",
'di',"删除帖子",
'dr',"删除回复",
'sp',"重置密码",
'spc',"重置头像",
'ss',"重置签名",
'si',"重置简介"
);
function ckisbs(s,n){
	var i,t;
	BColor=G('right'+n).style.backgroundColor;
	for(i=0;i<mbs.length;i++){
		t=G(mbs[i]+n);
		t.disabled=!s;
		if(t.style.backgroundColor!=BColor)t.style.backgroundColor=BColor;
	}
}
function ckisinc(s,n){
	var i,t;
	BColor=G('right'+n).style.backgroundColor;
	for(i=0;i<minc.length;i++){
		t=G(minc[i]+n);
		t.disabled=!s;
		if(t.style.backgroundColor!=BColor)t.style.backgroundColor=BColor;
	}
}
function setmrmv(s,n){
	var i,k;
	for(i=1;i<mrmv.length/2;i++){
		k=G(mrmv[i*2]+n);
		k.disabled=!s;
		if(k.checked)cksets(s,n,i);
	}
}
function cksets(s,n,i){
	var l=G('setstd'+i),t=mrmv[i*2+1];
	l.innerHTML=s?"<font class=warningc>"+t+"</font>":t;
	if(i=4&&s)G("ermsg"+n).innerHTML="<font color=blue>&nbsp;用户密码丢失时，可将密码设置为 555555"
}
function ckisrmv(s,n){
	setmrmv(s,n);
	var k=G(mrmv[0]+n);
	k.disabled=!s;
	if(!s&&k.checked){k.checked=s;ckdel(s,n,0);}
}
function ckismb(s,n){
	G('box'+n).disabled=!s;
	G('lsm'+n).disabled=s;
}
function cklsm(s,n){G('ismb'+n).disabled=s;}
function ckdel(s,n,w){
	var l=G('deltd'+n),t="删除用户",k=G('lsm'+n);
	l.innerHTML=s?"<font class=warningc>"+t+"</font>":t;
	l=G('isbs'+n);
	l.disabled=s;
	if(l.checked)ckisbs(!s,n);
	l=G('isinc'+n);
	l.disabled=s;
	if(l.checked)ckisinc(!s,n);
	l=G('isright'+n);
	l.disabled=s;
	if(l.checked)ckisright(!s,n);
	if(w)setmrmv(!s,n);
	G('src'+n).disabled=s;
	l=G('ismb'+n);
	if(l.checked){l.disabled=s;G('box'+n).disabled=s;}
	else if(k.checked)k.disabled=s;
	else {l.disabled=s;k.disabled=s;}
}
lastmngs=[]
for(i=0;i<irows.length;i++){
	o=G('cdiv'+i);
	o.removeChild(n=o.firstChild)
	o.removeChild(c=o.firstChild)
	o.removeChild(m=o.firstChild)
	lastmngs[i]=x=C('div')
	x.innerHTML=irows[i][9]?"本帖最后由管理员<a></a>在 "+irows[i][9]+" 管理":"&nbsp;"
	if(irows[i][9])x.replaceChild(o.removeChild(o.firstChild),x.childNodes[1])
	builddiv(i);
	A(G('snaptd'+i),n)
	if(!n.firstChild)n.innerHTML="&nbsp;"
	A(G('commtd'+i),c)
	if(!c.firstChild)c.innerHTML="&nbsp;"
	A(o=G('mscommtd'+i),m)
	if(!m.firstChild)m.innerHTML="&nbsp;"
	o.style.width=o.childNodes[0].style.width=ww
	A(G('mngp'+i),lastmngs[i])
}

function ckcomm(s,i){
	var c=G('commtd'+i);
	if(s){
	if(!c.d){
	c.d=o=C('input')
	o.type="text"
	o.name="comm"+irows[i][0]
	o.className="incomm"
	}
	A(c,c.d)
	c.d.focus()
	}else	c.removeChild(c.d)
}
function ckmscomm(s,i){
	var c=G('mscommtd'+i);
	if(s){
	if(!c.d){
	c.d=o=C('textarea')
	o.name="mscomm"+irows[i][0]
	o.className="inmtxt"
	}
	A(c,c.d)
	c.d.focus()
	}else	c.removeChild(c.d)
}
function mymscomm(i){
	var d,o=G(i+'mscomm');
	d=new Date();
	o.value=rtrim(o.value);
	o.value+=(o.value==""?"":"\n")+getlast2(d.getFullYear())+"."+getlast2(d.getMonth()+1)+"."+getlast2(d.getDate())+" "+getlast2(d.getHours())+":"+getlast2(d.getMinutes())+" [user]"+mei[0]+","+mei[1]+"[/user] :\n";
	o.focus();
}
function getlast2(i){
	var s=(i+100).toString();
	return s.substr(s.length-2,2);
}
function ckm(s,i){
	o=G('mngp'+i)
	if(s){o.removeChild(o.firstChild);buildmng(i)}else{o.innerHTML="";A(o,lastmngs[i])}
}
function expmsg(){
	var o=G('expmsg'),b=G('rsmsg').style;
	if(b.height==''){
		o.innerHTML='[+]';
		b.height='1px';
	}else{
		o.innerHTML='[-]';
		b.height='';
	}
}
function exprows(){
	var l,k,j,i;
	l=G('eprs');k="[+]";j="";
	if(l.innerHTML==k)k="[-]";else j="1px";
	l.innerHTML=k;
	for(i=0;i<irows.length;i++) if(!(G('mngs'+i).checked||G('ismscomm'+i).checked||G('iscomm'+i).checked)){G('li'+i).innerHTML=k;G('cdiv'+i).style.height=j;}
}
function exprow(n){
	if(!(G('mngs'+n).checked||G('ismscomm'+n).checked||G('iscomm'+n).checked)){
		var o=G('li'+n);
		var c=G('cdiv'+n);
		if(o.innerHTML=="[+]"){
			o.innerHTML="[-]";
			c.style.height="";
		}else{
			o.innerHTML="[+]"
			c.style.height="1px";
		}
	}
}
function changebox(v){
	window.location.href="?type=5&boxid="+v;
}
function cekonsub(){
	var i,n,k,r=true;
	for(i=0;i<irows.length;i++){
		n=irows[i][0];
		k=G('isbs'+n);
		if(k){
			if(!k.disabled&&k.checked){
				r=r&&cekinnum(n,G('mmr'+n),2);
				r=r&&cekinnum(n,G('mms'+n),3);
				r=r&&cekinnum(n,G('mmd'+n),4);
				r=r&&cekinnum(n,G('msb'+n),5);
				r=r&&cekmf(n,G('mf'+n));
			}
			k=G('isinc'+n);
			if(!k.disabled&&k.checked){
				r=r&&cekrdn(i,G('rdn'+n));
				r=r&&cekmny(i,G('mny'+n));
				r=r&&cekpit(i,G('pit'+n));
			}
		}
	}
	return r;
}
function submitform(){
	var i,n,k,s=true;
	if(G('searchdiv')) if(!isserchsubmit()) return !s;
	if(!cekonsub()){alert("用户参数填写有错误，不能提交，请检查。");return !s;}
	//设置内容
	for(i=0;i<irows.length;i++){
		n=irows[i][0];
		k=G('isinc'+n);
		if(k&&k.checked&&!k.disabled){
			k=G('rdn'+n);
			if(parseInt(k.value)==0){k.disabled=s;G('rdnc'+n).disabled=s;}
			k=G('mny'+n);
			if(parseInt(k.value)==0){k.disabled=s;G('mnyc'+n).disabled=s;}
			k=G('pit'+n);
			if(parseInt(k.value)==0){k.disabled=s;G('pitc'+n).disabled=s;}
		}
	}
	return s;
}