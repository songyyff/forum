//	PHP		2013.02
(
function(){
var F=/(\b(and|or|xor|__FILE__|exception|__LINE__|array|as|break|case|class|const|continue|declare|default|die|do|echo|else|elseif|empty|enddeclare|endfor|endforeach|endif|endswitch|endwhile|eval|exit|extends|for|foreach|function|global|if|include|include_once|isset|list|new|print|require|require_once|return|static|switch|unset|use|var|while|__FUNCTION__|__CLASS__|__METHOD__|final|php_user_filter|interface|implements|extends|public|private|protected|abstract|clone|try|catch|throw|cfunction|old_function|this)\b)+|\\*['"]|\d+|\/\x2a|\x2a\/|\/\/|\r\n|\r|\n/ig
,
W=/\b(and|or|xor|__FILE__|exception|__LINE__|array|as|break|case|class|const|continue|declare|default|die|do|echo|else|elseif|empty|enddeclare|endfor|endforeach|endif|endswitch|endwhile|eval|exit|extends|for|foreach|function|global|if|include|include_once|isset|list|new|print|require|require_once|return|static|switch|unset|use|var|while|__FUNCTION__|__CLASS__|__METHOD__|final|php_user_filter|interface|implements|extends|public|private|protected|abstract|clone|try|catch|throw|cfunction|old_function|this)\b/i
,
rd=/\\*"|\r\n|\r|\n/g,
rs=/\\*'|\r\n|\r|\n/g,
rc=/\x2a\/|\r\n|\r|\n/g,
rr=/\r\n|\r|\n/g
;

function e(s){return document.createTextNode(s)}
cvLan['$']=function(o){
var g=[0,'i','u','b','s','span'],I=In=0,
v,n,i,H,z,h,r,k,c,x,t,S=o.d.value
A(o,i=C('a'))
A(i,e("PHP"))
A(o,l=C('ol'))
if(IE)l.style.marginLeft=40
A(l,i=C('li'))

function T(s,t){if(t){A(i,t=C(g[t]));A(t,e(s))}else A(i,e(s))}
function L(){A(l,i=C('li'));if(++I&1)i.className="il"}
function Z(){return z=h.index+r.length}

for(z=0;h=F.exec(S);Z()){r=h[0]
if(z!=h.index)T(S.substring(z,h.index))
if("\r\n".indexOf(r)>=0)L()
else if(H=(c=r.charAt(r.length-1))=='"'?rd:c=="'"?rs:c=='/'?rr:c=='*'?rc:0){k=h.index
x=c=='*'?'/':c=='/'?'r':c
v=(n=x=='/'||x=='r')?1:4
for(H.lastIndex=Z();h=H.exec(S);){r=h[0]
if(r.charAt(r.length-1)==x||x=='r'){if(r.length&1||n){T(S.substring(k,F.lastIndex=Z()),v);if(x=='r')L();break}}else{T(S.substring(k,k=h.index),v);k+=r.length;L()}}
}else T(r,W.test(r)?3:2)}
if(z!=S.length)T(S.substring(z))
}
}

)()