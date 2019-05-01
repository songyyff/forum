
/*
mynote.php
*/

function submitform(){

function sm(){
i=G("mainform")
i.action="?type=2&page="+Pinfo.p
i.submit()
}

for(i=0,os=document.getElementsByName("closenote[]");i<os.length;i++)if(os[i].checked)if(confirm("您选择了 显示/关闭 帖子，确定要提交吗？"))sm();else return

if(document.getElementsByName("rule")[0].checked)sm()

}
