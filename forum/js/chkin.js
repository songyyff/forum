//输入校验
eo=E=0
function msg(o,s){var m,t,w
function cr(o){var i,r=o.parentNode.insertRow(-1);for(i=0;i<2;i++)r.insertCell(0);r.d=1;r.lastChild.style.color="red";return r}w=o.parentNode.parentNode
if(m=w.nextSibling){if(!m.d&&s){w.parentNode.insertBefore(t=cr(w),m);m=t}}else if(s)m=cr(w)
if(s){m.lastChild.innerHTML=s;if(eo){o.focus();eo=0}}else if(m&&m.d)w.parentNode.removeChild(m);return E|=s?1:0}
function checkoldpass(o){return msg(o,(o.value=trim(o.value)).length<6?"密码长度至少6位":isusername(o.value)?"":"密码含有非法字符,只能是ASCII字符数字和汉字")}
function checkpass(o){return msg(o,(o.value=trim(o.value)).length<6?"密码长度至少6位":isusername(o.value)?"":"密码含有非法字符,只能是ASCII字符数字和汉字")}
function checkrpass(o){return msg(o,o.value!=G("userpass").value?"重复密码与输入密码不相等,请重新输入":"")}
function checkemail(o){return msg(o,isemail(o.value=trim(o.value))?"":"Email不合法")}
function checkname(o){return msg(o,(o.value=trim(o.value)).length?"":"必须填写名字")}
function checkbirthday(o){var r;
if(!(o.value=trim(o.value))){o.value="1955-01-01";return msg(o,"")}
if(r=/((19|20){1}\d{2})-(\d{2})-(\d{2})/.exec(o.value=o.value.substr(0,10))){
var nowday=new Date();
var today=new Date(parseInt(r[1]),parseInt(r[3])-1,parseInt(r[4]));
if(nowday.getFullYear()>=parseInt(r[1])&&today.getFullYear()==parseInt(r[1])&&(today.getMonth()+1)==parseInt(r[3])&&today.getDate()==parseInt(r[4]))return msg(o,"")
}return msg(o,"生日格式非法或无效,只能是1955-01-01格式")}
function checkphone(o){return msg(o,/([^\-\s0-9])/.test(o.value=trim(o.value))?"电话格式非法或无效,只能是 [ 区号 ][ - | 空格 ]电话号码 格式":"")}
function checkqq(o){return msg(o,/([^\d])/.test(o.value=trim(o.value))?"QQ号码只是一个数字":"")}
function checkhomepage(o){return msg(o,haveillegalchar(o.value=trim(o.value))?"地址内含有非法字符":/^http:\/\/(.+)/.test(o.value)||!o.value?"":"个人主页地址不合法,必须是http://开头")}
function checknewtime(o){return msg(o,isnumber(o.value=parseInt(o.value))?parseInt(o.value)>0&&parseInt(o.value)<301?"":"必须在1 - 300之间":"必须是数字")}
function checkreplaysize(o){return msg(o,isnumber(o.value=parseInt(o.value))?parseInt(o.value)>19&&parseInt(o.value)<61?"":"必须在20 - 60之间":"必须是数字")}
function checkitemsize(o){return msg(o,isnumber(o.value=parseInt(o.value))?parseInt(o.value) > 19&&parseInt(o.value)<61?"":"必须在20 - 60之间":"必须是数字")}