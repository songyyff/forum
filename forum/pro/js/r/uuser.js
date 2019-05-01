D=document
B=D.body
s=D.createElement("div")
s.style.cssText="overflow:scroll;width:100px;height:100px;"
B.appendChild(s)
BW=IE?B.parentNode.offsetWidth-B.clientWidth:s.offsetWidth-s.clientWidth
B.removeChild(s)
D.write("<style>#spre{width:"+(MIW=screen.width-BW-384)+"px;}#spre img{margin:2 0;max-width:"+MIW+"px;behavior:url(../images/img.htc)}</style>")