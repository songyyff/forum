D=document
B=D.body
s=D.createElement("div")
s.style.cssText="overflow:scroll;width:100px;height:100px;"
B.appendChild(s)
BW=IE?B.parentNode.offsetWidth-B.clientWidth:s.offsetWidth-s.clientWidth
B.removeChild(s)
MIW=screen.width-BW-216
document.write("<style>iframe{height:10;border:0;width:"+MIW+"}</style>")