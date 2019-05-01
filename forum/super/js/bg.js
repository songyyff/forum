/* 

bedge.php 脚本
2011.3

*/

IE=navigator.appName.indexOf("Microsoft")!=-1;
function G(o){return document.getElementById(o);}

function start(){
s="<table width=100% cellspacing=0 cellpadding=5><tr class=bar2><td width=30>徽章</td><td width=100></td><td>说明</td></tr>";
for(i=0;i<bgs.length;i++){
s+="<tr onclick=fillalt(this)"+(i&1?" class=tr":"")+"><td>"+bgs[i][0]+"</td><td"+(bgs[i][1]==0?" bgcolor=red>":"><img style=background-color:white onmouseover=im(this) onmouseout=io(this) src=../icons/bg/"+bgs[i][1]+".gif>")+"</td><td><pre>"+bgs[i][2]+"\n"+bgs[i][3]+"</pre></td></tr>";
}
G('con').innerHTML=s+"</table>";
}

start();

function im(o){
s=o.src
o.className='b'
for(i=s.length-6;s.charAt(i--)!='/';);
o.src=s.substr(0,++i)+"/b"+s.substr(i,s.length)
}
function io(o){o.src=s}

function fillalt(o){
var v,t;
if(actmode==2){
v=G('iconno').value=o.firstChild.innerHTML;
v=bgs[--v];
G('bname').parentNode.innerHTML="<input type=text name=bname id=bname value=\""+v[2]+"\">";
t=G('comm');
if(IE)t.parentNode.innerHTML="<textarea name=comm id=comm rows=4 cols=60>"+v[3]+"</textarea>";
else t.innerHTML=v[3]
with(t=G('iradio')){disabled=v[1]!=0;checked=v[4]&1}
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
for(i=1;i<=bgs.length;i++)s+=" ,"+i;
s+="</textarea></td><tr><td></td><td><input type=checkbox id=redata onclick=\"ckredata(this)\" name=redata value=1>数据库数据重排";
break;
case '2':
s+="徽章编号</td><td width=30><input type=text id=iconno name=iconno class=input30></td><td align=right width=60>徽章名称</td><td><input type=text id=bname name=bname></td></tr><tr><td align=right>文字说明</td><td colspan=3><textarea name=comm id=comm rows=4 cols=60></textarea></td></tr><tr><td></td><td colspan=3><input type=checkbox id=iradio name=iradio value=1 disabled>单选分隔符";
break;
case '3':
s+="徽章编号</td><td><textarea id=delicons name=delicons rows=2 cols=60></textarea></td></tr><tr><td></td><td>格式：徽章号 [ ,徽章号 ] ...<br>比如要删除12、18和20号徽章图标，只要填入 12,18,20 就行了";
break;
case '4':
s+="徽章文件<td><input type=file id=iconf name=iconf><tr><td><td>徽章文件是一个 gif 动画文件，大小一般为 21 x 35，您可以自己制作也可以从<a href=\"http://www.eieusoft.com/fpro/bgs\">我们的站点</a>下载获得。<tr><td align=right>徽章大图<td><input type=file id=iconb name=iconb><tr><td><td>徽章大图是徽章文件的清晰大图，也是一个 gif 动画文件，大小一般为 80 x 133。<tr><td align=right>徽章名称</td><td><input type=text name=bname id=bname></td></tr><tr><td align=right>文字说明</td><td><textarea name=comm id=comm rows=4 cols=60></textarea></td></tr><tr><td></td><td><input type=checkbox id=ifhr name=ifhr value=0 onclick=ishr(this,0)>分隔符 <input type=checkbox id=ifshr name=ifhr value=1 onclick=ishr(this,1)>单选分隔符";
break;
}
return s+="</td></tr></table>";
}

G('formdiv').innerHTML=act_mode(actmode);

function ishr(o,n){
var p=n?o.previousSibling.previousSibling:o.nextSibling.nextSibling;
if(o.checked)p.checked=false;
G('iconf').disabled=o.checked;
}

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
if(a.length-1!=bgs.length){m="徽章号序列数量不正确，应该是 "+bgs.length+" 个，而目前是 "+(a.length-1)+" 个";break}
var i,t=new Array(a.length);
for(i=1;i<a.length;i++)if(a[i]==0||a[i]>bgs.length||t[a[i]]){m="号码 "+a[i]+(t[a[i]]?" 重复！":" 非法！号码只能在 1 - "+bgs.length+" 范围内。");break}else t[a[i]]=1;
break;
case 2:
o=G('comm');o.value=trim(o.value)
o=G('iconno')
if(!o.value||!isnummm(o.value,bgs.length,1))m="徽章编号不正确，只能是 1 - "+bgs.length+" 的数字"
break
case 3:
o=G('delicons')
if(/[^,\s\d]/.test(s=o.value.replace(/[,\s]+/g,","))){m="序列内含有非法字符,只能是数字、逗号或空格";break}
if(s.charAt()==',')s=s.substr(1,s.length);
a=s.split(",");
if(!a[a.length-1])a.pop();
o.value=a.toString();
if(!a.length)m="徽章号至少得有一个才能提交个";else if(!confirm("您确定删除编号为 "+o.value+" 的徽章吗？删除后将丢失这些徽章文件。\n\n[确定]继续删除 [取消]取消删除\n "))return false;
break
case 4:
o=G('comm');o.value=trim(o.value)
o=G('iconf');
if(!o.disabled&&o.value.substr(o.value.length-3,3).toLowerCase()!="gif")m="徽章文件格式不正确，应该是一个 gif 文件"
break
}
if(m){alert(m);o.focus()}
return !m;
}

function ckredata(o){
G('resort').disabled=o.checked
if(o.checked)alert("表格内显示的徽章编号顺序不正确才需要使用此功能!\n如编号连续重复，编号不连续等。")
}