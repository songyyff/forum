/* 
emotion.php 脚本
2011.2
*/

ems.pop()
emts.pop()

IE=navigator.appName.indexOf("Microsoft")!=-1
function G(o){return document.getElementById(o)}

function start(){

for(o=G('semt'),i=0;i<emts.length;i++){
o.appendChild(t=document.createElement('option'))
t.value=emts[i][0];t.innerHTML=emts[i][1]
if(emts[i][0]==EMT)t.selected=1
}
//o.childNodes[--EMT].selected=1
o.onchange=function(){
window.location.href="?type=4&EMT="+this.value
}

s="";
for(i=0;i<ems.length;){
s+="<table class=bd1 cellspacing=0 cellpadding=5 style=float:left;margin:1px><tr><td colspan=9 class=bdb1 align=center>--- 第[ "+(i/54+1)+" ]页 ---";
s+="<tr>";
k=0;
for(k=0;k<6&&i<ems.length;k++){
s+="<tr>"
for(v=0;v<9&&i<ems.length;v++,i++)s+="<td><img width=50 height=50 src=../icons/em/"+EMT+"/"+ems[i][1]+"><br>"+ems[i][0]+"."+ems[i][2]
}
s+="</table>"
}
G('con').innerHTML="<table><tr><td>"+s+"</table><hr>"
}start()

function doact(o){
actmode=o.value;
G('formdiv').innerHTML=act_mode(actmode);
}
function act_mode(v){
var s="<table cellspacing=0 cellpadding=5><tr><td width=60 align=right>";
switch(v){
case '1':
s+="排序编号</td><td><textarea id=resort name=resort rows=4 cols=60>";
for(i=1;i<=ems.length;i++)s+=" ,"+i;
s+="</textarea></td><tr><td></td><td><input type=checkbox id=redata onclick=\"ckredata(this)\" name=redata value=1>数据库数据重排";
break;
case '2':
s+="表情编号</td><td><input type=text id=iconno name=iconno class=input30></td><td>文字说明</td><td><input type=text name=comm id=comm>";
break;
case '3':
s+="表情编号</td><td><textarea id=delicons name=delicons rows=2 cols=60></textarea></td></tr><tr><td></td><td>格式：表情号 [ ,表情号 ] ...<br>比如要删除12、18和20号表情图标，只要填入 12,18,20 就行了";
break;
case '4':
s+="表情文件</td><td><input type=file id=iconf name=iconf></td></tr><tr><td></td><td>表情文件是一个 gif 动画文件，大小一般为 30x30 到 50x50，您可以自己制作也可以从网上下载。</td></tr><tr><td align=right>文字说明</td><td><input type=text name=comm id=comm>";
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
if(a.length-1!=ems.length){m="表情号序列数量不正确，应该是 "+ems.length+" 个，而目前是 "+(a.length-1)+" 个";break}
var i,t=new Array(a.length);
for(i=1;i<a.length;i++)if(a[i]==0||a[i]>ems.length||t[a[i]]){m="号码 "+a[i]+(t[a[i]]?" 重复！":" 非法！号码只能在 1 - "+ems.length+" 范围内。");break}else t[a[i]]=1;
break;
case 2:
o=G('comm');o.value=trim(o.value)
o=G('iconno')
if(!o.value||!isnummm(o.value,ems.length,1))m="表情编号不正确，只能是 1 - "+ems.length+" 的数字"
break
case 3:
o=G('delicons')
if(/[^,\s\d]/.test(s=o.value.replace(/[,\s]+/g,","))){m="序列内含有非法字符,只能是数字、逗号或空格";break}
if(s.charAt()==',')s=s.substr(1,s.length);
a=s.split(",");
if(!a[a.length-1])a.pop();
o.value=a.toString();
if(!a.length)m="表情号至少得有一个才能提交个";else if(!confirm("您确定删除编号为 "+o.value+" 的表情吗？删除后将丢失这些表情文件。\n\n[确定]继续删除 [取消]取消删除\n "))return false;
break
case 4:
o=G('comm');o.value=trim(o.value)
o=G('iconf');
if(o.value.substr(o.value.length-3,3).toLowerCase()!="gif")m="表情文件格式不正确，应该是一个 gif 文件"
break
}
if(m){alert(m);o.focus()}
return !m;
}
function ckredata(o){
G('resort').disabled=o.checked
if(o.checked)alert("表格内显示的表情编号顺序不正确才需要使用此功能!\n如编号连续重复，编号不连续等。")
}