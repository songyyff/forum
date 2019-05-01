var IE=navigator.appName.indexOf("Microsoft")!= -1,
pageCode="<table border=1 width=100% cellpadding=2 cellspacing=0>\
<TR height=27 class=bar3><TD align=center><b>播放媒体</b></TD></TR>\
<TR><TD align=center id=player></TD></TR>\
</table>\
<table border=1 width=100% cellpadding=2 cellspacing=0>\
<TR><TD width=38 valign=top></td></TR>\
<TR><TD></td></TR>\
<TR><TD>说明/歌词</td></TR>\
<TR><TD></td></TR>\
</table>";
with(document){
write("<html>\
<head>\
<title>播放媒体</title>\
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">");
write("<link rel=\"stylesheet\" type=\"text/css\" href=\""+hostAddress+"/theme/"+pageStyle+"/def.css\">");
write("</head><body>");
if(!IE)write(pageCode);
write("</body></html>");
if(IE)body.innerHTML=pageCode;
}


//some="<embed id=cdplay controls=console height=210 width=367 src=\""+o.title+"\" autostart=false />";
