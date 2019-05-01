function gettypesel(n){
	var s="";
	for(var i=0;i<itype.length/2;i++) s+="<OPTION value="+itype[i*2]+(itype[i*2]==irows[n][2]?" selected":"")+">"+itype[i*2+1]+"</OPTION>";
	return "<select class=mgtb1 name=ty"+irows[n][0]+" id=ty"+irows[n][0]+(irows[n][1]!='E'?" disabled":"")+">"+s+"</select>";
}
function getgpsel(n){
	var s="";
	for(var i=0;i<grps.length/2;i++) s+="<OPTION value="+grps[i*2]+(grps[i*2]==irows[n][5]?" selected":"")+">"+grps[i*2+1]+"</OPTION>";
	return "<select class=mgtb1 name=mvgp"+irows[n][0]+" id=mvgp"+irows[n][0]+" disabled>"+s+"</select>";
}
function getdecosel(n){
	var s="";
	for(var i=0;i<ideco.length/2;i++) s+="<OPTION value="+ideco[i*2]+(ideco[i*2]==irows[n][3]?" selected":"")+">"+ideco[i*2+1]+"</OPTION>";
	return "<select class=mgtb1 name=deco"+irows[n][0]+" id=deco"+irows[n][0]+">"+s+"</select>";
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
	c.innerHTML="<table width=100% border=0 cellpadding=0 cellspacing=0 class=bd1><tr><td class=pd1>"+
	"<table width=100% border=0 cellpadding=0 cellspacing=0>"+
		"<tr>"+
		"<td width=29>&nbsp;</td>"+
		"<td width=85>快照</td>"+
		"<td class=pdtb1p id=snaptd"+i+"></td>"+
		"<tr>"+
		"<td class=bdt1pdtb3p valign=top>&nbsp;<input type=checkbox id=iscomm"+i+" name=comms[] onclick=\"ckcomm(this.checked,"+i+")\" value="+n+"></td>"+
		"<td class=bdt1pdt5p valign=top>注释</td>"+
		"<td class=bdt1pdtb3p id=commtd"+i+"></td>"+
		"<tr>"+
		"<td class=bdt1pdtb3p valign=top>&nbsp;<input type=checkbox id=ismscomm"+i+" name=mscomms[] onclick=\"ckmscomm(this.checked,"+i+")\" value="+n+"></td>"+
		"<td class=bdt1pdt5p valign=top>管理员留言</td>"+
		(IE?"<td class=bdt1pdtb3p><div id=mscommtd"+i+"></div></td>":"<td  id=mscommtd"+i+" class=fxwin></td>")+
		"<tr>"+
		"<td valign=top class=bdt1pdtb3p>&nbsp;<input type=checkbox id=mngs"+i+" name=mngs[] onclick=\"ckm(this.checked,"+i+")\" value="+n+"></td>"+
		"<td class=bdt1pdt5p valign=top>管理</td>"+
		"<td id=mngp"+i+" class=bdt1pdtb3p></td>"+
	"</table></table>";
}
function buildmng(i){
	var r,c,k,n=irows[i][0];
	r=irows[i][4];
	c=" checked";
	G('mngp'+i).innerHTML="<table border=1 cellpadding=0 cellspacing=0>"+
"<tr height=22 align=center>"+
"	<TD class=bdlt1 colspan=2><a class=goldlink href=\"../pro/edit.php?actionid="+n+"&type=1\" target=ewin"+n+">编辑</a></TD>"+
"	<TD width=36 class=bdlt1>状态</TD>"+
"	<TD class=bdlt1>&nbsp;<select class=mgtb1 name=istat"+n+" id=istat"+n+(k=irows[i][2]==2?" disabled":"")+"><OPTION value=E"+(irows[i][1]=='E'?" selected":"")+">有效</OPTION><OPTION value=D"+(irows[i][1]=='D'?" selected":"")+">失效</OPTION></select>&nbsp;</TD>"+
"	<TD width=36 class=bdlt1 rowspan=2>权限<br>修改</TD>"+
"	<TD width=36 class=bdlt1>游客</TD>"+
"	<TD colspan=4 class=bdlt1>用户</TD>"+
"	<TD colspan=2 class=bdlt1>管理</TD>"+
"	<TD width=15 class=bdlt1><input type=checkbox value=1 id=setrpy"+n+" name=setrpy"+n+"></TD>"+
"	<TD width=90 class=bdtr1 align=left>重置回复位置</TD>"+
"</tr>"+
"<tr height=22 align=center>"+
"	<TD width=15 class=bdlt1><input type=checkbox id=del1"+n+" name=del1"+n+" value=1 onclick=\"ckdel(this.checked,"+i+")\"></td>"+
"	<td class=bdt1 width=30 align=left>删除</TD>"+
"	<TD class=bdlt1>类型</TD>"+
"	<TD class=bdlt1>&nbsp;"+gettypesel(i)+"&nbsp;</TD>"+
"	<TD class=bdlt1>浏览</TD>"+
"	<TD width=36 class=bdlt1>浏览</TD>"+
"	<TD width=36 class=bdlt1>显示</TD>"+
"	<TD width=36 class=bdlt1>修改</TD>"+
"	<TD width=36 class=bdlt1>回复</TD>"+
"	<TD width=36 class=bdlt1>显示</TD>"+
"	<TD width=36 class=bdlt1>回复</TD>"+
"	<TD class=bdlt1><input type=checkbox id=drpy1"+n+" name=drpy1"+n+" value=1 onclick=\"ckdr1(this.checked,"+i+")\"></TD>"+
"	<TD class=bdtr1 align=left>删除所有回复</TD>"+
"</tr>"+
"<tr height=22 align=center>"+
"	<TD class=bdlt1><input type=checkbox value=1 id=del2"+n+" name=del2"+n+" onclick=\"ckdel2(this.checked,"+i+")\" disabled></td>"+
"	<td class=bdt1 align=left id=ditd"+i+">确删</TD>"+
"	<TD class=bdlt1>等级</TD>"+
"	<TD class=bdlt1>&nbsp;"+getdecosel(i)+"&nbsp;</TD>"+
"	<TD class=bdlt1><input type=checkbox value=1 id=isright"+n+" name=isright"+n+" onclick=\"ckisright(this.checked,"+i+")\"><input type=hidden name=right"+n+" id=right"+n+"></TD>"+
"	<TD class=bdlt1 id=rtd0"+i+"></TD>"+
"	<TD class=bdlt1 id=rtd1"+i+"></TD>"+
"	<TD class=bdlt1 id=rtd2"+i+"></TD>"+
"	<TD class=bdlt1 id=rtd3"+i+"></TD>"+
"	<TD class=bdlt1 id=rtd4"+i+"></TD>"+
"	<TD class=bdlt1 id=rtd5"+i+"></TD>"+
"	<TD class=bdlt1 id=rtd6"+i+"></TD>"+
"	<TD class=bdlt1><input type=checkbox value=1 id=drpy2"+n+" name=drpy2"+n+" onclick=\"ckdr2(this.checked,"+i+")\" disabled></TD>"+
"	<TD class=bdtr1 align=left id=drtd"+i+">确认删除回复</TD>"+
"</tr>"+
"<tr height=22>"+
"	<TD class=bdlt1><input type=checkbox id=bmove"+n+" name=bmove"+n+" value=1 onclick=\"ckbm(this.checked,"+n+")\"></td>"+
"	<td class=bdt1 colspan=2>迁管理箱</TD>"+
"	<TD class=bdlt1 colspan=9>&nbsp;"+getboxsel(i)+"</TD>"+
"	<TD class=bdlt1><input type=checkbox value=1 id=lsm"+n+" name=lsm"+n+" onclick=\"ckls(this.checked,"+n+")\"></TD>"+
"	<TD class=bdtr1 align=left>管理后放弃</TD>"+
"</tr>"+
"<tr height=22>"+
"	<TD class=bdltb1><input type=checkbox id=gmove"+n+" name=gmove"+n+" value=1 onclick=\"ckgm(this.checked,"+n+")\""+k+"></td>"+
"	<td class=bdtb1 colspan=2>迁移论坛</TD>"+
"	<TD class=bd1 colspan=11>&nbsp;"+getgpsel(i)+"</TD>"+
"</tr>"+
"</table>";
G('right'+irows[i][0]).value=irows[i][4];
ckisright(G('isright'+irows[i][0]).checked,i);
}
function ckisright(s,i){
	var j,k;
	for(j=0;j<7;j++){
		k="["+(parseInt(G('right'+irows[i][0]).value)&1<<(j)?"V":"X")+"]";
		G('rtd'+j+i).innerHTML=s?"<a class=goldlink href=\"javascript:ckright("+i+","+j+")\">"+k+"</a>":k;
	}
	G('right'+irows[i][0]).disabled=!s;
}
function ckright(i,j){
	var obj=G('right'+irows[i][0]);
	obj.value=parseInt(obj.value)^(1<<j);
	G('rtd'+j+i).innerHTML="<a class=goldlink href=\"javascript:ckright("+i+","+j+")\">["+(parseInt(obj.value)&(1<<j)?"V":"X")+"]</a>";
}
function setmobj(i,s){
	var n=irows[i][0];
	var o,b,j,k=irows[i][2]==2?true:s;
	G('istat'+n).disabled=k;
	G('ty'+n).disabled=irows[i][1]=='E'?s:true;
	G('deco'+n).disabled=s;

	o=G('isright'+n);
	o.disabled=s;
	if(o.checked)ckisright(!s,i);

	G('setrpy'+n).disabled=s;
	o=G('drpy1'+n);
	o.disabled=s;
	j=G('drpy2'+n);
	if(o.checked)j.disabled=s;else j.disabled=true;

	o=G('bmove'+n);
	b=G('box'+n);
	j=G('lsm'+n);
	if(o.checked){b.disabled=s;j.disabled=true;}else{j.disabled=s;b.disabled=true;}
	if(j.checked)o.disabled=true;else o.disabled=s;

	o=G('gmove'+n);
	o.disabled=k;
	j=G('mvgp'+n);
	if(o.checked)j.disabled=s;else j.disabled=true;
}
function ckdel(s,i){
	var o=G('del2'+irows[i][0])
	o.disabled=!s;
	if(!s) {o.checked=s;ckdel2(s,i);}
}
function ckdel2(s,i){
	var l=G('ditd'+i);
	var t="确删";
	if(s) l.innerHTML="<font class=warningc>"+t+"</font>"; else l.innerHTML=t;
	setmobj(i,s);
}
function ckdr1(s,i){
	var o=G('drpy2'+irows[i][0])
	o.disabled=!s;
	if(!s) {o.checked=s;ckdr2(s,i);}
}
function ckdr2(s,i){
	var l=G('drtd'+i);
	var t="确认删除回复";
	if(s)l.innerHTML="<font class=warningc>"+t+"</font>"; else l.innerHTML=t;
	G('setrpy'+irows[i][0]).disabled=s;
}
function ckbm(s,n){
	G('box'+n).disabled=!s;
	G('lsm'+n).disabled=s;
}
function ckgm(s,n){G('mvgp'+n).disabled=!s;}
function ckls(s,n){G('bmove'+n).disabled=s;}
lastmngs=[]
for(i=0;i<irows.length;i++){
	o=G('cdiv'+i);
	o.removeChild(n=o.firstChild)
	o.removeChild(c=o.firstChild)
	o.removeChild(m=o.firstChild)
	lastmngs[i]=x=C('div')
	x.innerHTML=irows[i][7]?"本帖最后由管理员<a></a>在 "+irows[i][7]+" 管理":"&nbsp;"
	if(irows[i][7])x.replaceChild(o.removeChild(o.firstChild),x.childNodes[1])
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
	window.location.href="?type=1&boxid="+v;
}
function submitform(){
	if(G('searchdiv')) if(!iscansubmit()) return false;
	return true;
}
