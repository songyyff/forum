
function submitform(){
var o=G("rdnum")
o.value=o.value.replace(/(^\s*)|(\s*$)/g,"")
if(/\D/.test(o.value)||parseInt(o.value)<0||parseInt(o.value)>256){
alert("阅读权限只能在 0 到 255 之间!")
o.focus()
}else{
o=G("mainform")
o.action="?type=4"
o.submit()
}
}
