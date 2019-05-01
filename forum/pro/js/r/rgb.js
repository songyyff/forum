var waittingtime=11;
function userwitting(){
var g=G("useragree");
if(waittingtime-- >0){
	g.value="   ("+waittingtime+") 同意   ";
	setTimeout(userwitting,1000);
}else{
	g.value="     同意     ";
	g.disabled=false;
}
}
function notagree(){window.location="index.php"}
function f_onload(){userwitting()}