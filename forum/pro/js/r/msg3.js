
o=G('receiver')
uID=o.value

o.nextSibling.onclick=o.onblur=function(){uNm.style.visibility=isID.checked&&receiver.value.replace(/(^\s*)|(\s*$)/g,"")==uID?"visible":"hidden"}

selFrd=0
function clickfriend(i){var o=G("fird"+i);if(o.checked&&selFrd==10){alert("最多选取10个用户.");
o.checked=false}else selFrd+=o.checked?1:-1}

function sendmsg(){o=receiver
if(!selFrd&&!(o.value=o.value.replace(/(^\s*)|(\s*$)/g,""))){alert("收件人不能为空!");o.focus();return}
if(o.value.length&&isID.checked&&(/\D/.test(o.value)||!parseInt(o.value))){alert("收件人ID只能是一个大于 0 的数字!");o.focus();return}
if(!(til.value=trim(til.value))){alert("标题不能为空！");til.focus();return}
orderform()
}