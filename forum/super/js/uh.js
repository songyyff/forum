/* 

userheads.php 脚本
2011.3

*/

IE=navigator.appName.indexOf("Microsoft")!=-1;

_uh.ini(); //建立最终效果

//分页方式
cl=7;
rl=2;

function start(){
var i=0,v,k,a=cl*rl,s=""
while(i<uhs.length){
s+="<table class=bd1 cellspacing=0 cellpadding=5 style=float:left;margin:1px><tr><td colspan="+cl+" class=bdb1 align=center>--- 第[ "+(i/a+1)+" ]页 ---";
for(k=0;k<rl&&i<uhs.length;k++){
s+="<tr>"
for(v=0;v<cl&&i<uhs.length;v++,i++)s+="<td><img width=60 height=60 src=../faces/"+uhs[i][1]+" title=\""+uhs[i][1]+"\"><br>"+uhs[i][0]+".<br>"+(uhs[i][2]?uhs[i][2]:"缺说明");
}
s+="</table>"
}
G('con').innerHTML="<table><tr><td>"+s+"</table><hr>"
}
start();
function doact(o){
actmode=o.value;
G('formdiv').innerHTML=act_mode(actmode);
}
function act_mode(v){
var s="<table cellspacing=0 cellpadding=5><tr><td width=60 align=right>";
switch(v){
case '1':
s+="排序编号</td><td><textarea id=resort name=resort rows=4 cols=60>";
for(i=1;i<=uhs.length;i++)s+=" ,"+i;
s+="</textarea></td><tr><td></td><td><input type=checkbox id=redata onclick=\"ckredata(this)\" name=redata value=1>数据库数据重排";
break;
case '2':
s+="头像编号</td><td><input type=text id=iconno name=iconno class=input30></td><td>文字说明</td><td><input type=text name=comm id=comm>";
break;
case '3':
s+="头像编号</td><td><textarea id=delicons name=delicons rows=2 cols=60></textarea></td></tr><tr><td></td><td>格式：头像号 [ ,头像号 ] ...<br>比如要删除12、18和20号头像图标，只要填入 12,18,20 就行了";
break;
case '4':
s+="头像文件</td><td><input type=file id=iconf name=iconf></td></tr><tr><td></td><td>头像文件是一个 gif 或者 jpg 文件，大小一般为 50x50 到 140x188，您可以自己制作也可以从网上下载。</td></tr><tr><td align=right>文字说明</td><td><input type=text name=comm id=comm>";
break;
}
return s+="</td></tr></table>";
}

G('formdiv').innerHTML=act_mode(actmode);

function checkdata(){
var o,m,a,s;
switch(parseInt(actmode)){
case 1:
if(G('redata').checked)break
o=G('resort');
if(/[^,\s\d]/.test(s=o.value.replace(/[\s,]+/g," ,"))){m="序列内含有非法字符,只能是数字、逗号或空格";break}
if(s.charAt()!=' ')s=" ,"+s;
o.value=s;
a=s.split(" ,");
if(!a[a.length-1])a.pop();
if(a.length-1!=uhs.length){m="头像号序列数量不正确，应该是 "+uhs.length+" 个，而目前是 "+(a.length-1)+" 个";break}
var i,t=new Array(a.length);
for(i=1;i<a.length;i++)if(a[i]==0||a[i]>uhs.length||t[a[i]])m="号码 "+a[i]+(t[a[i]]?" 重复！":" 非法！号码只能在 1 - "+uhs.length+" 范围内。");else t[a[i]]=1;
break;
case 2:
o=G('comm');o.value=trim(o.value)
o=G('iconno')
if(!o.value||!isnummm(o.value,uhs.length,1))m="头像编号不正确，只能是 1 - "+uhs.length+" 的数字"
break
case 3:
o=G('delicons')
if(/[^,\s\d]/.test(s=o.value.replace(/[,\s]+/g,","))){m="序列内含有非法字符,只能是数字、逗号或空格";break}
if(s.charAt()==',')s=s.substr(1,s.length);
a=s.split(",");
if(!a[a.length-1])a.pop();
o.value=a.toString();
if(!a.length)m="头像号至少得有一个才能提交个";else if(!confirm("您确定删除编号为 "+o.value+" 的头像吗？删除后将丢失这些头像文件。\n\n[确定]继续删除 [取消]取消删除\n "))return false;
break
case 4:
if(uhs.length>=504)m="头像数量已经超过范围,\n只能是 7 x 2 = 14 个每页，最多 36 页 ，共 504 个。";
o=G('comm');o.value=trim(o.value)
o=G('iconf');
if((s=o.value.substr(o.value.length-5,5).toLowerCase())!=".jpeg"&(s=s.substr(1))!=".jpg"&s!=".gif")m="头像文件格式不正确，应该是一个 gif 或者 jpg 文件"
}
if(m){alert(m);o.focus()}
//return false;
return !m;
}
function ckredata(o){
G('resort').disabled=o.checked
if(o.checked)alert("表格内显示的头像编号顺序不正确才需要使用此功能!\n如编号连续重复，编号不连续等。")
}