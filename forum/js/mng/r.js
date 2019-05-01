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
		"</tr>"+
		"<tr>"+
		"<td class=bdt1pdtb3p>&nbsp;<input type=checkbox id=iscomm"+i+" name=comms[] onclick=\"ckcomm(this.checked,"+i+")\" value="+n+"></td>"+
		"<td class=bdt1pdtb3p>注释</td>"+
		"<td class=bdt1pdtb3p id=commtd"+i+"></td>"+
		"</tr>"+
		"<tr>"+
		"<td class=bdt1pdtb3p valign=top>&nbsp;<input type=checkbox id=ismscomm"+i+" name=mscomms[] onclick=\"ckmscomm(this.checked,"+i+")\" value="+n+"></td>"+
		"<td class=bdt1pdt5p valign=top>管理员留言</td>"+
		(IE?"<td class=bdt1pdtb3p><div id=mscommtd"+i+"></div></td>":"<td  id=mscommtd"+i+" class=fxwin></td>")+
		"</tr>"+
		"<tr>"+
		"<td valign=top class=bdt1pdtb3p>&nbsp;<input type=checkbox id=mngs"+i+" name=mngs[] onclick=\"ckm(this.checked,"+i+")\" value="+n+"></td>"+
		"<td class=bdt1pdt5p valign=top>管理</td>"+
		"<td id=mngp"+i+" class=bdt1pdtb3p>"
}
function buildmng(i){
	var j,r,c,n=irows[i][0];
	r=irows[i][4];
	c=" checked";
	G('mngp'+i).innerHTML="<table border=1 cellpadding=0 cellspacing=0>"+
"<tr height=22 align=center>"+
"	<TD width=15 class=bdlt1><input type=checkbox id=del1"+n+" name=del1"+n+" value=1 onclick=\"ckdel(this.checked,"+i+")\"></td>"+
"	<td class=bdt1 width=69 align=left>删除</TD>"+
"	<TD width=60 class=bdlt1><a class=goldlink href=\"../pro/edit.php?actionid="+n+"&type=3&extra="+irows[i][3]+"p"+(Math.floor(irows[i][2]/v_rpsize)+((j=irows[i][2]%v_rpsize)>0?1:0))+"s"+j+"\" target=e"+n+">编辑</a></TD>"+
"	<TD width=60 class=bdlt1>游客</TD>"+
"	<TD colspan=3 class=bdlt1>用户</TD>"+
"	<TD width=60 class=bdltr1>管理</TD>"+
"</tr>"+
"<tr height=22 align=center>"+
"	<TD class=bdlt1><input type=checkbox value=1 id=del2"+n+" name=del2"+n+" onclick=\"ckdel2(this.checked,"+i+")\" disabled></td>"+
"	<td class=bdt1 align=left id=ditd"+i+">确认删除</TD>"+
"	<TD class=bdlt1>权限修改</TD>"+
"	<TD class=bdlt1>浏览</TD>"+
"	<TD width=60 class=bdlt1>浏览</TD>"+
"	<TD width=60 class=bdlt1>显示</TD>"+
"	<TD width=60 class=bdlt1>修改</TD>"+
"	<TD class=bdltr1>显示</TD>"+
"<tr height=22 align=center>"+
"	<TD class=bdlt1><input type=checkbox value=1 id=lsm"+n+" name=lsm"+n+" onclick=\"ckls(this.checked,"+n+")\"></TD>"+
"	<TD class=bdt1 align=left>管理后放弃</TD>"+
"	<TD class=bdlt1><input type=checkbox value=1 id=isright"+n+" name=isright"+n+" onclick=\"ckisright(this.checked,"+i+")\"><input type=hidden name=right"+n+" id=right"+n+"></TD>"+
"	<TD class=bdlt1 id=rtd0"+i+"></TD>"+
"	<TD class=bdlt1 id=rtd1"+i+"></TD>"+
"	<TD class=bdlt1 id=rtd2"+i+"></TD>"+
"	<TD class=bdlt1 id=rtd3"+i+"></TD>"+
"	<TD class=bdltr1 id=rtd4"+i+"></TD>"+
"<tr height=22>"+
"	<TD class=bdltb1><input type=checkbox id=bmove"+n+" name=bmove"+n+" value=1 onclick=\"ckbm(this.checked,"+n+")\"></td>"+
"	<td class=bdtb1>迁管理箱</TD>"+
"	<TD class=bdltb1 colspan=4>&nbsp;"+getboxsel(i)+"</TD>"+
"	<TD class=bdltb1 align=center>状态</TD>"+
"	<TD class=bd1>&nbsp;<select class=mgtb1 name=istat"+n+" id=istat"+n+"><OPTION value=E"+(irows[i][1]=='E'?" selected":"")+">有效</OPTION><OPTION value=D"+(irows[i][1]=='D'?" selected":"")+">失效</OPTION></select>&nbsp;"

G('right'+irows[i][0]).value=irows[i][4];
ckisright(G('isright'+irows[i][0]).checked,i);
}
function ckisright(s,i){
	var j,k;
	for(j=0;j<5;j++){
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
	var o,b,j;
	G('istat'+n).disabled=s;

	o=G('isright'+n);
	o.disabled=s;
	if(o.checked)ckisright(!s,i);

	o=G('bmove'+n);
	b=G('box'+n);
	j=G('lsm'+n);
	if(o.checked){b.disabled=s;j.disabled=true;}else{j.disabled=s;b.disabled=true;}
	if(j.checked)o.disabled=true;else o.disabled=s;
}
function ckdel(s,i){
	var o=G('del2'+irows[i][0])
	o.disabled=!s;
	if(!s){o.checked=s;ckdel2(s,i);}
}
function ckdel2(s,i){
	var l=G('ditd'+i),t="确认删除";
	if(s) l.innerHTML="<font class=warningc>"+t+"</font>"; else l.innerHTML=t;
	setmobj(i,s);
}
function ckbm(s,n){
	G('box'+n).disabled=!s;
	G('lsm'+n).disabled=s;
}
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
	window.location.href="?type=3&boxid="+v;
}
function submitform(){
	if(G('searchdiv')) if(!iscansubmit()) return false;
	return true;
}