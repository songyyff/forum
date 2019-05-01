var IE=navigator.appName.indexOf("Microsoft")!= -1,
pageC="<table border=1 width=100% cellpadding=2 cellspacing=0>\
<TR height=27 class=bar3><TD align=center><b>播放媒体</b></TD></TR>\
<TR><TD align=center id=player></TD></TR>\
<TR><TD><div id=cdiv class=fmlist style=\"padding:3px\"></div></td></TR>\
</tbody>\
</table>";
with(document){
write("<html>\
<head>\
<title>播放媒体</title>\
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">");
write("<link rel=\"stylesheet\" type=\"text/css\" href=\""+hostAddress+"../theme/"+pageStyle+"/def.css\">");
write("</head><body>");
if(!IE)write(pageC);
write("</body></html>");
if(IE)body.innerHTML=pageC;
}
function G(d){return document.getElementById(d);}
function m(i){return i<10?"0"+i:i;}
function Q(o,i){return o.childNodes[i].childNodes[0];}
var p=window.opener.tagNodes[songNum];
function build(){
var d=new Date();
with(G("cdiv")){
innerHTML="<br>标题："+p.n+"<br> <br>地址："+p.a+"<br> <br>说明/歌词：<br> <br>"+p.c+"<br> <br>打开时间："+d.getFullYear()+"-"+m(d.getMonth()+1)+"-"+m(d.getDate())+" "+m(d.getHours())+":"+m(d.getMinutes())+":"+m(d.getSeconds());
style.height=IE?"235px":"226px";
}
setTimeout("createplay()",0);
}
function createplay(){
G("player").innerHTML="<embed id=cdplay height=210 width=367 src=\""+p.a+"\" autostart=true showstatusbar=true />";
}
setTimeout("build()",0);