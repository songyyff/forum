

function tagplay(n){
//=\"<embed id=cdplay controls=console height=100 width=300 src=\\\"../uploads/1.wma\\\" autostart=true />\";\n\
msplayer="<object align=middle classid=\"CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95\" class=OBJECT id=MediaPlayer width=300 height=69>\
<param name=ShowStatusBar value=1>\
<param name=Filename value=\"../uploads/1.wma\">\
</object>";

rmplayer="<object id=vid classid=\"clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA\" width=300 height=90>\
<param name=_ExtentX value=11298>\
<param name=_ExtentY value=7938>\
<param name=AUTOSTART value=-1>\
<param name=SHUFFLE value=0>\
<param name=PREFETCH value=0>\
<param name=NOLABELS value=-1>\
<param name=SRC value=\"../uploads/1.rm\">\
<param name=CONTROLS value=Imagewindow>\
<param name=CONSOLE value=clip1>\
<param name=LOOP value=0>\
<param name=NUMLOOP value=0>\
<param name=CENTER value=0>\
<param name=MAINTAINASPECT value=0>\
<param name=BACKGROUNDCOLOR value=#000000>\
</object>";
}

function freeplay(s){
alert(s);
}

function isinit(){
return 1;
}
