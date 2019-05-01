//	未定义通用语言	2014.7
(function(){
var F=/(\b(break|delete|if|this|while|case|do|in|throw|with|catch|else|instanceof|try|continue|finally|new|typeof|debugger|for|return|var|default|function|switch|void|true|false)\b)+|\\*['"]|\d+|\/\x2a|\x2a\/|\/\/|\r\n|\r|\n/ig,
rd=/\\*"|\r\n|\r|\n/g,
rs=/\\*'|\r\n|\r|\n/g,
rc=/\x2a\/|\r\n|\r|\n/g,
rr=/\r\n|\r|\n/g;

cvLan['X']=function(o){
function e(s){return document.createTextNode(s)}
function T(s,t){if(t){A(i,t=C(g[t]));A(t,e(s))}else A(i,e(s))}
function L(){A(l,i=C('li'));if(++I&1)i.className="il"}
function Z(){return z=h.index+r.length}

var g=[0,'i','u','b','s'],I=In=0,
v,d,n,i,H,z,h,r,k,c,x,t,S=o.d.value
A(o,i=C('a'))
A(i,e("其它语言"))
iniCtag(o)
A(o,l=C('ol'))
if(IE)l.style.marginLeft=40
A(l,i=C('li'))

for(z=0;h=F.exec(S);Z()){r=h[0]
if(z!=h.index)T(S.substring(z,h.index))
if("\r\n".indexOf(r)>=0)L()
else if(H=r=='"'?rd:r=="'"?rs:r=='//'?rr:r=='/*'?rc:0){
d=H==rd||H==rs?4:1
for(H.lastIndex=Z(),z=h.index;h=H.exec(S);){r=h[0]
if("\r\n".indexOf(r)>=0){T(S.substring(z,h.index),d);Z();L();if(H!=rc){F.lastIndex=Z();break}}
else{if(d==4&&!(r.length&1))continue;T(S.substring(z,F.lastIndex=Z()),d);break}}
}else T(r,2)}
if(z!=S.length)T(S.substr(z))
}}
)()