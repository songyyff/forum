/*
list.php
*/

function Img(){return new Image()}

briefI=Bc=Ec=Sc=0
/*
document.getElementsByTagName("head")[0].appendChild(s=C('link'))
s.type="text/css"
s.href="../theme/"+P.tTheme+"/edit.css"
*/
D=document
function loadC(s){var o=C("script");o.type="text/javascript";o.src=s;A(D.body,o)}
function brief(t){if(!briefI){var o=C('link');D.getElementsByTagName("head")[0].appendChild(o);o.type="text/css";o.rel="stylesheet";o.href="../theme/"+tTheme+"/code.css";loadC("js/gc.js");loadC("e/i.js")}t.parentNode.removeChild(t);return false}

function topage(o,e){if(IE){o=this;e=event}if(e.keyCode==13)if(/\D/.test(o.value)||parseInt(o.value)==0)alert("页面非法,只能是大于 0 的数字");else document.location.href="?groupid="+gi.d+"&page="+o.value}

function GPS(o){var c=0,i,t,L,H=5,W=10;o.style.padding="1 0 1"
o.innerHTML=""
with(gi){P=Math.ceil(I/z);p=p<1?1:p>P?P:p
if(P>W){
 	if(p>H)
		if((P-p)>H){i=p-H+1;L=p+H}
		 else {i=P-W+1;L=P}
	else {i=1;L=W}
}else {i=1;L=P}

o.appendChild(t=C('table'));t.cellSpacing=t.cellPadding=0;o=t.insertRow(0)
function X(){t=o.insertCell(c++);t.style.border="1px solid #cccccc";t.style.padding=3;return t}
X().innerHTML=((p-1)*z+1)+"/"+(p==P?I-(P-1)*z:z)+"/"+I
function N(){t=o.insertCell(c++);t.style.width=1}
N();s="?groupid=";b="&page="
if(P>W){X().appendChild(t=C('a'));t.innerHTML="[<&lt;";t.href=s+d+b+1;N()}
for(;i<=L;i++){t=X();if(i!=p){v=t;v.appendChild(t=C('a'));t.href=s+d+b+i}t.innerHTML=i;N()}
if(P>W){X().appendChild(t=C('a'));t.innerHTML=">>]";t.href=s+d+b+P;N()}

o.appendChild(v=C('td'));v.style.border="1px solid #cccccc";v.appendChild(t=C('input'))
IE?t.onkeydown=topage:t.setAttribute("onkeydown","topage(this,event)")
with(t.style){border=0;width=40;height=v.offsetHeight-4;margin=0}
}}

if(gi.I>0&&Is.length>1){GPS(G('pg1'));GPS(G('pg2'))}

(function(){Z=gi.Z
function a(r,t){var k,i
function b(){d.appendChild(x=C("a"));x.innerHTML=k;x.href="view.php?noteid="+t[i+1]+"&page="+k;x.style.padding="0 5 0 5";x.target="_blank"}
for(i=0,l=t.length-1;i<l;i+=2){r=r.nextSibling;n=t[i]-Z;for(k=2;k<5&&n>0;k++){n-=Z;d=r.childNodes[1];b()}if(n>0){k=Math.ceil(t[i]/Z);if(k>5)d.appendChild(document.createTextNode("..."));b()}}}
a(G('tis'),Ti);a(G('lis'),Is)})()