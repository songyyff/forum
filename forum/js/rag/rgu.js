//resize object
var inputobjwidth=screen.width -21 -10 -150-150-150 -10 ;

var obj=G("signature");
obj.style.width=inputobjwidth;
obj.style.height=100;
obj=G("selfinfo");
obj.style.width=inputobjwidth;
obj.style.height=100;
G("homepage").style.width=inputobjwidth;

function checkifreg(thisobj){
var obj=G("username");
if(checkname(obj)) { 
	thisobj.disabled=true;
	subwin=window.open("chkuser.php?uname="+obj.value,"def","height=200,width=300");
}
else alert("必须填写合法名字才能查询");
}

// 用户头像函数 user head func

function selectsysface(){_uh.ini()}

function selfupface(){G("uh_plain").innerHTML="<input type=file name=userselfhead>(文件限制为 jpg , jpeg , gif 大小不能超过100k)"}

// 展开详细 expend detail
expended=1;
function expenddetail(){
var content=G("detailinfo");
if(expended){
	content.style.height="1px";
	content.style.overflow="hidden";
} else {
	content.style.height="";
}
expended=!expended;
}

function expenddetail1(){
var issign=G("isexpanddetail");
var content=G("detailinfo");
if(issign.innerHTML=="-"){
	content.style.height="1px";
	content.style.overflow="hidden";
	issign.innerHTML="+";
} else {
	issign.innerHTML="-";
	content.style.height="";
}
}

function f_onload(){
expenddetail();
selectsysface();
}
function submitform(){

if(checkname(G("username"))&&
checkpass(G("userpass"))&&
checkrpass(G("ruserpass"))&&
checkemail(G("email"))&&
checkbirthday(G("birthday"))&&
checkphone(G("phone"))&&
checkmsn(G("msn"))&&
checkqq(G("QQ"))&&
checkyahoo(G("yahoo"))&&
checkww(G("ww"))&&
checkhomepage(G("homepage"))&&
checksignature(G("signature"))&&
checkselfinfo(G("selfinfo"))&&
checknewtime(G("newtime"))&&
checkreplaysize(G("replaysize"))&&
checkitemsize(G("itemsize")))G("mainform").submit();
else{if(!expended)expenddetail();alert("表单填写有错误，无法提交，请检查错误")}

}
