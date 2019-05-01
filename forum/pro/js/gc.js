var codeE
function iniCtag(t){t=t.firstChild
t.title='查看源码'
t.href='javascript:;'
t.d=1
t.onclick=function(){
var c,i=this,p=i.parentNode,x=p.childNodes
if(i.d=!i.d)p.removeChild(x[1])
else if(codeE&&editMenus.D.style.top!="-1000px"){codeE(p);i.d=1}
else{p.insertBefore(c=C('pre'),x[1])
c.className='getcode'
c.contentEditable=false
c.innerHTML='text'
c.firstChild.data=p.d.value
}return false}}