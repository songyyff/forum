IE=navigator.appName.indexOf("Mi")!=-1

function G(d){return document.getElementById(d)}
function C(t){return document.createElement(t)}
function A(o,t){o.appendChild(t)}

uid=parseInt(uid);ismng=parseInt(ismng)
O=G('menutd')
o=O.firstChild
if(IE&&o)O.removeChild(o)

O.innerHTML="<tt id=fr>"+(uid?"| <a href=../pro/logout.php>退出</a>"+(ismng?" | <a href=../mng/mng.php>管理</a>":"")+" | <a href=../pro/msgs.php>消息箱"+msgs+"</a>":"<a href=../pro/login.php>登陆</a> | <a href=../pro/userreg.php>注册</a>")+" | <a href=../pro/search.php>搜索</a>"+(uid?" | <a id=mM href=../pro/myself.php>我的》</a> | <a id=mC href=../pro/control.php>控制面版</a>":"")+" | <a href=../help/help.php>帮助</a></tt><a href=../index.php><img border=0 src=../images/1.png></a>"
if(o){fr.insertBefore(o,o=fr.firstChild);o.data=" "+o.data}
for(i=0,Z=menutd.getElementsByTagName('a');a=Z[i++];a.className="whiteLink");

uid?(function(){var x=y=z=0
function M(p,s,m,o){A(menutd,o.d=O=C('pre'));O.className="menuplain"
O.onmouseout=function(){setTimeout(H,1000);x=0}
O.onmouseover=function(){x=1}
o.onmouseover=function(){var t=this;if(z!=t){h();S(t);z=t}y=1}
o.onmouseout=function(){setTimeout(H,1000);y=0}
for(i=0;i<m;i++){A(O,a=C('a'));a.className="whitelink";a.href="../pro/"+p+".php?type="+i;a.innerHTML=s.substr(i<<2,4);A(O,C('br'))}}
function h(){if(z&&z.d)z.d.style.visibility="hidden";z=0}
function S(t){for(var v=t.d,x=0,y=t.offsetHeight;t!=null;x+=t.offsetLeft,y+=t.offsetTop,t=t.offsetParent);with(v.style){left=x;top=y;visibility="visible"}}
function H(){if(!x&&!y)h()}
M("myself","我的订阅我的好友我的帖子我的回复我的权限我的资料",6,mM)
M("control","快速浏览论坛用户选择主题论坛徽章",4,mC)
})():0;

(function(){
var I=0,D=["t1.jpg",
"<b>欢迎您使用《众言论坛》</b><br><br>《众言论坛》以设计简洁，使用方便著称；<br><br>相信您可以在这里感受到舒适体验。",
"t2.jpg",
"<b>众多功能</b><br><br>论坛融合了图文混排，媒体嵌入，连接引用等众多排版功能；<br><br>并有强大的搜索能力和出众的权限控制系统；<br><br>方便的站内短信功能；出色的管理方法；完善的帮助系统。<br><br>这些都使《众言论坛》使用更加容易。",
"t3.jpg",
"<b>结构稳固</b><br><br>论坛所有功能以金字塔积木试结构堆叠，最终形成了论坛总体。<br><br>这可方便的在将来按您的需求拆卸和扩展功能。",
"t4.jpg",
"<b>透明代码</b><br><br>论坛所有代码都是文本代码。<br><br>如果您有时间可按自己需求修改代码。",
"t5.jpg",
"<b>集思广益</b><br><br>论坛是多用户系统，众多智慧会聚于此；<br><br>愿您有所收益。"]
function C(){imgtil.src= "../images/"+D[I++];titcom.innerHTML=D[I++];if(I==D.length)I=0;setTimeout(C,15000)}C()
})()

function RO(o){with(o){if(width>height&&width>188)width=188;else if(height>188)height=188;}o.onload=null}
