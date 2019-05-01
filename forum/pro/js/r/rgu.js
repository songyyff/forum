
for(l=screen.width -21 -10 -150-150-150 -10,a="homepage,mIcons,Info,myInfo,mySign".split(','),i=0;o=a[i++];G(o).style.width=l);

chkI=doCHK=0
function checkifreg(o){var I,n=G("username");E=0
if(!checkname(n)){o.disabled=true;
if(!chkI){A(mainform,chkI=C('iframe'));chkI.className="hfdiv"}
chkI.src="../rag/chkname.htm"
}else alert("必须填写合法名字才能查询")}

// 用户头像函数 user head func

function selectsysface(){_uh.ini()}

function selfupface(){G("uh_plain").innerHTML="<input type=file name=userselfhead>(文件限制为 jpg , jpeg , gif 大小不能超过100k)"}

function f_onload(){selectsysface()}

function submitform(){
eo=1
E=0
checkname(G("username"))
checkpass(G("userpass"))
checkrpass(G("ruserpass"))
checkemail(G("email"))
checkbirthday(G("birthday"))
checkphone(G("phone"))
checkqq(G("QQ"))
checkInfo()
checkhomepage(G("homepage"))
checknewtime(G("newtime"))
checkreplaysize(G("replaysize"))
checkitemsize(G("itemsize"))

if(!E)G("mainform").submit();else alert("填写有错误,无法提交.")

}
