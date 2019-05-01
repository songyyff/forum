/* 

mediatype.php 脚本
2012.5

*/

IE=navigator.appName.indexOf("Microsoft")!=-1;
function G(o){return document.getElementById(o);}

function start(){
s="<table width=100% cellspacing=0 cellpadding=5><tr class=bar2><td width=90>排序<td width=200>视频网名称<td>识别地址";
for(i=0;i<ts.length;i++)s+="<tr onclick=fillalt(this)"+(i&1?" class=tr":"")+"><td>"+ts[i][0]+"<td>"+ts[i][1]+"<td>"+ts[i][2]
G('con').innerHTML=s+"</table>"
}

start()

function fillalt(o){
var v,t;
if(actmode==2){
v=G('tno').value=o.firstChild.innerHTML
v=ts[--v]
G('tname').parentNode.innerHTML="<input name=tname id=tname value=\""+v[1]+"\">"
G('tadd').parentNode.innerHTML="<input name=tadd id=tadd value=\""+v[2]+"\">"
}
}

function doact(o){
actmode=o.value;
G('formdiv').innerHTML=act_mode(actmode);
}

function act_mode(v){
var s="<table cellspacing=0 cellpadding=5><tr><td width=60 align=right>";
switch(v){
case '1':
s+="排序编号</td><td><textarea id=resort name=resort rows=4 cols=60>";
for(i=1;i<=ts.length;i++)s+=" ,"+i;
s+="</textarea><tr><td><td><input type=checkbox id=redata onclick=\"ckredata(this)\" name=redata value=1>数据库数据重排";
break;
case '2':
s+="排序编号<td width=30><input type=text id=tno name=tno class=input30><tr><td align=right width=60>网站名称<td><input id=tname name=tname><tr><td align=right>识别地址<td><input id=tadd name=tadd>";
break;
case '3':
s+="排序编号</td><td><textarea id=delts name=delts rows=2 cols=60></textarea><tr><td><td>格式：排序号 [ ,排序号 ] ...<br>比如要删除12、18和20号类别，只要填入 12,18,20 就行了, 只有类别拥有表情数量是0时才可删除";
break;
case '4':
s+="网站名称<td><input name=tname id=tname><tr><td align=right>识别地址<td><input id=tadd name=tadd>";
break;
}
return s+="</table>";
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
if(a.length-1!=ts.length){m="列别号序列数量不正确，应该是 "+ts.length+" 个，而目前是 "+(a.length-1)+" 个";break}
var i,t=new Array(a.length);
for(i=1;i<a.length;i++)if(a[i]==0||a[i]>ts.length||t[a[i]]){m="号码 "+a[i]+(t[a[i]]?" 重复！":" 非法！号码只能在 1 - "+ts.length+" 范围内。");break}else t[a[i]]=1;
break;
case 2:
o=G('tno')
if(!o.value||!isnummm(o.value,ts.length,1))m="类别编号不正确，只能是 1 - "+ts.length+" 的数字"
break
case 3:
o=G('delts')
if(/[^,\s\d]/.test(s=o.value.replace(/[,\s]+/g,","))){m="序列内含有非法字符,只能是数字、逗号或空格";break}
if(s.charAt()==',')s=s.substr(1,s.length);
a=s.split(",");
if(!a[a.length-1])a.pop();
o.value=a.toString();
if(!a.length)m="类别号至少得有一个才能提交个";else if(!confirm("您确定删除编号为 "+o.value+" 的类别吗？\n\n[确定]继续删除 [取消]取消删除\n "))return false;
break
case 4:
break
}
if(m){alert(m);o.focus()}
return !m;
}

function ckredata(o){
G('resort').disabled=o.checked
if(o.checked)alert("表格内显示的类别编号顺序不正确才需要使用此功能!\n如编号连续重复，编号不连续等。")
}