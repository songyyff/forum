sceditsurvey=0;

var suvedel=new Array(suvdbs.length);

function esuvinfo(i){
var b=suvdbs[i];
return "建立日期 "+b[8].substr(0,10)+"；有效期限 "+(b[6]?b[6]+" 天":"~")+"；投票后显示 "+(b[7]&1?"是":"否")+"；单/多选 "+(b[4]?"多，Min:"+b[4]+",Max:"+(b[5]?b[5]:"~")+"":"单")+"；投票"+b[1]+"人次 总"+b[2]+"票<br>"+b[9];
}

function ebuildsuv(){
editsurvey=!editsurvey;
if(editsurvey){
var s=new Array();
s[s.length]="<hr><ul type=1>";
for(i=0;i<suvdbs.length-1;i++){
b=suvdbs[i];
b[10]=b.length-12>>2;
s[s.length]="<li"+(i&1?"":" class=bar2")+" style=\"padding:5px;\">\
<span><input type=checkbox name=esuvt[] value="+b[0]+" onclick=\"esuv("+i+",this)\">修改</span>\
<div class=mtb3>"+esuvinfo(i)+"</div>\
<ul type=1>";
	for(k=11;k<b.length-1;k+=4){
	s[s.length]="<li><input type=checkbox name=esuvci[] value="+i+","+b[k]+" onclick=\"esuvi("+i+","+(k-11)/4+",this)\"> "+b[k+2]+" - "+b[k+3]+" 票 <div>"+b[k+1]+"</div></li>";
	}
s[s.length]="</ul><div align=right><span><a href=\"javascript:;\" onclick=\"esuvaddi("+i+",this)\">添加</a> 调查项目 <a href=\"javascript:;\" onclick=\"esuvdeli("+i+")\">删除</a> &nbsp; </span><input type=checkbox value="+b[0]+" name=delsuv[] onclick=\"edelsuv("+i+",this)\">删除调查</div></li>";
}
s[s.length]="</ul><input type=hidden id=altsuv value=0 name=altsuv>";
}
o=G('surveyedtd');
o.innerHTML=editsurvey?s.join(""):"";
esuvo=o.childNodes[1];
}
ebuildsuv();

function esuv(i,o){
var b=suvdbs[i];
o.parentNode.nextSibling.innerHTML=o.checked?"有效投票时间 <input type=text name=esuvpriod[] class=input30 value="+b[6]+"> (按天计算，0 表示无限制)<br>\
<textarea rows=3 name=esuvdesc[] style=\"margin-top:3px;width:"+o.parentNode.nextSibling.offsetWidth+"px;\">"+b[9]+"</textarea><br>\
<input type=checkbox name=esuvaftshow[] value="+b[0]+(b[7]&1?" checked":"")+">投票后显示投票结果<br>\
<input type=checkbox name=esuvmut[] onclick=\"esuvmut(this)\" value="+b[0]+((i=b[4])?" checked":"")+">多选投票\
 至少选择数量 <input class=input30 type=text name=eminsuv[] value="+b[4]+(i=(i?"":" disabled"))+"> 最多选择数量 <input class=input30 type=text name=emaxsuv[] value="+b[5]+i+"> "
:esuvinfo(i);
}

function esuvmut(o){
var i=o.nextSibling.nextSibling;
i.disabled=!o.checked;
i.focus();
i.nextSibling.nextSibling.disabled=!o.checked;
}

function esuvi(i,n,o){
var b=suvdbs[i];
with(o.nextSibling.nextSibling){
innerHTML=o.checked?"<input type=text name=esuvi[] style=\"margin:3px;width:"+(o.parentNode.offsetWidth-20)+"px;\" value=\""+b[n*4+12]+"\">"
:b[n*4+12];
if(o.checked)childNodes[0].focus();
}
}

function suvdelbox(){v=0;return confirm("调查处于编辑中，删除标记会消除所有编辑的改变!\n确定要标记删除吗？");}

function edelsuv(i,o){
var u,k=0,p=o.parentNode.parentNode.childNodes[0].childNodes[0];
v=1;
if(p.checked){
//	if(!suvdelbox())return;
	p.checked=false;
	esuv(i,p);
}
p.disabled=o.checked;
for(p=o.parentNode.previousSibling.childNodes[0];p;p=p.nextSibling){
	if((u=p.childNodes[0]).checked){
//		if(v&&!suvdelbox()){return;}
		u.checked=false;
		esuvi(i,k++,u);
	}
	u.disabled=o.checked;
}
o.previousSibling.style.visibility=o.checked?"hidden":"visible";
}

function esuvaddi(i,o){
var x;
o=o.parentNode.parentNode.previousSibling;
o.appendChild(x=document.createElement("Li"));
x.innerHTML="<input type=text name=esuvi"+suvdbs[i][0]+"[] onfocus=\"esuvifocus("+i+",this)\">";
with(x.firstChild){
style.margin=3;
style.width=x.offsetWidth-20;
focus();
}
}

function esuvifocus(i,o){suvedel[i]=o.parentNode;}

function esuvdeli(i){
var k=suvedel[i];
suvedel[i]=0;
if(k){
if(k.nextSibling)k.nextSibling.lastChild.focus();else if(t=k.previousSibling)t.firstChild.focus();
k.parentNode.removeChild(k);
}
}

function checkesuv(){
var s=[],q=0,c,d,n,m,r,i,x,p=esuvo.firstChild;
while(p){
	q++;
	if(!(i=p.firstChild.firstChild).disabled){
	//检测主要
	if(i.checked){
		i=p.childNodes[1];
		if(r=msnum(x=i.childNodes[1]))break;
		x=N(x,3);x.value=trim(x.value);
		n=N(x,5);
	}else n=0;
	//检测条目
	is=p.childNodes[2];
	i=is.firstChild;
	c=d=0;h=1;
	while(i){
		if((x=i.firstChild).type=="checkbox"){
			if(x.checked)with(i.lastChild.firstChild)if(!(value=trim(value)))d++;
		}else if(x.value=trim(x.value))h=0;else{x=i;i=i.nextSibling;is.removeChild(x);continue;}
		i=i.nextSibling;
	}
	if(!h)s[s.length]=p.firstChild.firstChild.value;
	//计算有效条目数量
	if((c=is.childNodes.length-d)<2||c>100){scTo(p);alert("一个调查的有效调查条目数量只能在 2 至 100 以内。\n\n[ "+q+" ] 号调查的有效条目数量是 "+c+" 个。");r=1;break;}
	if(n&&n.checked){
		if(r=msnum(n=N(n,2)))break;
		if(r=msnum(m=N(n,2)))break;
		if(!(i=parseInt(n.value))){scTo(p);alert("至少是 1 !");n.focus();r=1;break}
		if(i>=c){scTo(p);alert("至少选择数量应该小于调查表的有效调查条目数量 "+c+" 。");n.focus();r=1;break;}
		if((n=parseInt(m.value))&&(n<i||n>c)){scTo(p);alert("最多选择数量应该在至少选择数量 "+i+" 和 调查表有效调查条目数量 "+c+" 之间,或者为 0 。");m.focus();r=1;break;}
	}
	}
	p=p.nextSibling;
}

//if(!r&&s.length)
G('altsuv').value=s.join(",")+","+suvdbs[suvdbs.length-1];

return r;
}