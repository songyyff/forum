
for(l=screen.width-21-10-150-150-150-10,a="mypage,mIcons,Info,myInfo,mySign".split(','),i=0;o=a[i++];G(o).style.width=l);

function altermain(o){for(var i=0,os=["username","oldpass","userpass","ruserpass"];i<os.length;G(os[i++]).disabled=!o.checked);}

altermain(G("isaltermain"));

function checknewpass(o){return msg(o,(o.value=trim(o.value)).length?o.value.length<6?"新密码长度至少6位":isusername(o.value)?"":"新密码含有非法字符,只能是ASCII字符数字和汉字":"")}

function checknewrpass(o){return msg(o,(o.value=trim(o.value))!=G("userpass").value?"重复新密码与新密码不相等,请重新输入":"")}

chkI=doCHK=0
function checkifreg(o){var I,n=G("username")
if(!checkname(n)){o.disabled=true;
if(!chkI){A(mainform,chkI=C('iframe'));chkI.className="hfdiv"}
chkI.src="../rag/chkname.htm"
}else alert("必须填写合法名字才能查询")}

//用户头像函数
function dontalterface(){G("uh_plain").innerHTML=""}

function selectsysface(){_uh.ini()}

function selfupface(){G("uh_plain").innerHTML="<input type=file name=userselfhead>(文件限制为 jpg , jpeg , gif 大小不能超过100k)";}

ifbg=0;

function submitform(){
eo=1
E=0
if(G("isaltermain").checked){checkname(G("username"));checkoldpass(G("oldpass"));checknewpass(G("userpass"));checknewrpass(G("ruserpass"))}
checkemail(G("email"))
checkbirthday(G("birthday"))
checkphone(G("phone"))
checkqq(G("QQ"))
checkhomepage(G("mypage"))
if(ifbg)checkgbsort(G('bgsort'))
checknewtime(G("newtime"))
checkreplaysize(G("replaysize"))
checkitemsize(G("itemsize"))
checkInfo()

if(!E){
o=G("mainform")
o.action="?type=5"
o.submit()
}else alert("表单填写有错误,无法提交.")
}
