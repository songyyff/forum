//	C++		2013.01
(
function(){
	
var n=m=t=0

function w(W){

if("\r\n".indexOf(W)>=0)if(n){n=0;return "</s><li>"}else if(t||m)return"</s><li><s>";else return"<li>"
if(W=="//"){n=1;return "<s>//"}

if(m){
if(W=="*/"){m=0;return "*/</s>"}
return W
}
if(W=="/*"){m=1;return "<s>/*"}

if((c=W.charAt(l=W.length-1))=='"'||c=="'"){
if(t)if(l&1||t!=c)return W;else{t=0;return W+"</s>"}
else{t=c;return "<s>"+W}
}
if(t){alert(t+":"+W);return W}

c=W.charAt()
return W=="<"?"&lt;":W=="&"?"&#38;":
c>'/'&&c<':'||c=='.'?"<u>"+W+"</u>":
"{}()[]".indexOf(c)<0?"<b>"+W+"</b>":"<u>"+W+"</u>"
}

cvLan['C']=function(o){
n=m=t=0
o.innerHTML="<span>C++</span><ol><li>"+o.d.value.replace(/\b(break|delete|if|this|while|case|do|in|throw|with|catch|else|instanceof|try|continue|finally|new|typeof|debugger|for|return|var|default|function|switch|void)\b|(\.\s*(true|false|window|document|value|length|focus|innerHTML)\b)+|[{}\(\)\]\[]+|\\*['"]|<|&|\d+|\/\x2a|\x2a\/|\/\/|\r\n|\r|\n/g,w)
if(IE)o.childNodes[1].style.marginLeft=40
}
}

)()