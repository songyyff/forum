
/*
ser0.php
*/

I={T:G("U1"),Y:G("U2"),U:G("U"),F:G("T1"),G:G("T2"),P:G("AN"),S:G("id"),Z:G('TT')}

E=[]
Kf=K=P=r=0
sd=typeof(SF)=='object'

function Kd(o){if(IE)o=this;K+=o.checked?1:-1}

function But(){
I[0]=p=0;
B=G('forumlist')
B.style.padding=3
function A(t){B.appendChild(t)}
l=fms.length-1;
for(i=0;i<l;i+=4){
c=C("input")
E[P++]=c
c.type="checkbox"
c.name="forums[]"
c.value=fms[i+1]
if(!(c.disabled=!fms[i+3])){if(IE)c.onclick=Kd;else c.setAttribute('onclick',"Kd(this)");Kf++}
if(I[p]!=fms[i])
if(fms[i]==fms[i-3])I[++p]=fms[i]
else for(k=p;k>=0;k--)if(I[k]==fms[i]){p=k;break}
c.style.marginLeft=15*p
A(c)
if(sd&&SF[r]==fms[i+1]){c.checked=true;K++;r++}
A(document.createTextNode(fms[i+2]))
A(C('br'))
}
}But()

function IR(i){I.Z.innerHTML=i?"帖子":"回复"}

function check(){
var o=s=0
do{
with(I){

S.value=S.value.replace(/[\s,]+/g,",")
if(/[^\d,]/.test(S.value)){s="编号是一个数字。";o=S;break}

U.value=trim(U.value)
if(T.checked){
if(!isusername(U.value)){s="用户名含有非法字符,只能是英文字母、数字和汉字。";o=U;break}
}else{
if(/\D/.test(U.value)){s="用户id是个数字";o=U;break}
}

F.value=trim(F.value)
G.value=trim(G.value)
if(F.value.length&&!isdatetime(F.value)){s="\"从\" 时间格式不对";o=F;break}
if(G.value.length&&!isdatetime(G.value)){s="\"到\" 时间格式不对";o=G;break}

P.value=trim(P.value)
if(/\D/.test(P.value)){s="只能是非负整数";o=P}

}
}while(0)

if(!K)s="您没有选择任何目标论坛，无法查询"

if(s){if(o)o.focus();alert(s)}

return !s
}

function expandsearch(){
var o=G("searchdiv"),isobj=G("issearch");
if(o.style.height==""){
	isobj.innerHTML="+";
	o.style.height="1px";
}else{
	isobj.innerHTML="-";
	o.style.height="";
}
}if(sd)expandsearch()

function setforum(c){K=c?Kf:0;for(i=0,l=E.length;i<l;i++)if(!E[i].disabled)E[i].checked=c;}

function gotopage(t,p){
if(check()){
o=G("mainform")
o.action="?type="+t+"&page="+p
o.submit();
}
}

function submitform(){if(check())G("mainform").submit()}