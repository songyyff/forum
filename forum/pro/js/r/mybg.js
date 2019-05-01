
bgrows=G('bgcon');

function Tx(o,s){A(o,document.createTextNode(s))}
function Gt(i){var o;return (o=bgData.childNodes[i].firstChild)?o:C("i")}
for(i=bgS=0;o=bgData.childNodes[i];i+=5,bgS++){
bgrows.parentNode.appendChild(r=document.createElement("tr"))
r.c=r.insertCell
r.d=d=o.firstChild.data.split(",")

t=r.c(0);

A(t,Gt(i+2))

A(t,C("br"))
Tx(t,"颁奖人：")
A(t,o=C('a'))
o.href="userinfo.php?userid="+d[3]
A(o,Gt(i+1))

A(t,C("br"))
Tx(t,"授奖贺词：")
A(t,Gt(i+3))

A(t,C("br"))
Tx(t,"获奖感言：")
A(t,Gt(i+4))

t=r.c(0);
t.innerHTML="<img onmouseover=im(this) onmouseout=io(this) src=../icons/bg/"+d[4]+".gif>"
t.firstChild.d=d[4]

t=r.c(0);
t.innerHTML=d[1];

t=r.c(0);
t.innerHTML="<input type=checkbox name=altbg[] onclick=\"altbg(this,"+i+")\" value="+d[0]+">";
t.style.backgroundColor=d[2]&2?"red":d[2]&1?"blue":"";
}

function im(o){s=o.src
o.className='b'
o.src="../icons/bg/b/"+o.d+".gif"}
function io(o){o.src=s}

function bg_sort(o){
ifbg=o.checked;
p=o.parentNode.parentNode.lastChild;
if(o.checked){
for(i=1,s="";i<=bgS;i++)s+=" ,"+i
p.innerHTML="<textarea id=bgsort name=bgsort onblur=\"checkgbsort(this)\">"+s+"</textarea><div style=\"color:red\"></div><input type=checkbox name=resbgs value=1 onclick=\"ckredata(this)\">重排序列 (徽章编号顺序不正确时使用此功能，如编号不连续。)";
p.firstChild.style.width=screen.width-490;
}else p.innerHTML="说明";
}

function altbg(o,i){var r=o.parentNode.parentNode,p=r.lastChild
if(o.checked){if(!o.i){o.i=C("div")
o.i.innerHTML="<input type=text name=bgcom[] maxlength=500>\n<input type=checkbox "+(r.d[2]&1?" checked":"")+" onclick=\"setbgr(this)\"><input type=hidden name=bgright[] value="+(r.d[2]&1)+">隐藏徽章"
t=o.i.firstChild
t.style.width=screen.width-560
if((r=p.lastChild).tagName!="I")t.value=r.data}
A(p,o.i);o.i.firstChild.focus()
}else p.removeChild(o.i)}

function setbgr(o){o.nextSibling.value=o.checked?1:0}

function ckredata(o){
G('bgsort').disabled=o.checked
if(o.checked)o.previousSibling.innerHTML="";
}

function checkgbsort(o){
var i,t,m="",a,s;
do{
if(o.disabled)break
if(/[^,\s\d]/.test(s=o.value.replace(/[\s,]+/g," ,"))){m="序列内含有非法字符,只能是数字、逗号或空格";break}
if(s.charAt(s.length-1)==',')s=s.substr(0,s.length-2);
if(s.charAt()!=' ')s=" ,"+s;
o.value=s;
a=s.split(" ,");
//if(!a[a.length-1])a.pop();
if(a.length!=bgS){m="徽章号序列数量不正确，应该是 "+(bgS-1)+" 个，而目前是 "+(a.length-1)+" 个";break}
t=new Array(a.length);
for(i=1;i<a.length;i++)if(a[i]==0||a[i]>bgS-1||t[a[i]]){m="号码 "+a[i]+(t[a[i]]?" 重复！":" 非法！号码只能在 1 - "+(bgS-1)+" 范围内。");break}else t[a[i]]=1;
}while(0);
with(o.nextSibling){innerHTML=m;height=m?0:1}
if(m)o.focus()
return !m;
}