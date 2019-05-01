D=document
B=D.body
s=D.createElement("div")
s.style.cssText="overflow:scroll;width:100px;height:100px;"
B.appendChild(s)
BW=IE?B.parentNode.offsetWidth-B.clientWidth:s.offsetWidth-s.clientWidth
B.removeChild(s)
D.write("<style>#spre{padding:5 0;width:"+(MIW=screen.width-BW-170)+"px;}#spre img{margin:2 0;max-width:"+MIW+"px;min-width:5px;behavior:url(../images/img.htc);}#spre textarea{visibility:hidden;}</style>")