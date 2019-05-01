<?php include "../func/mustfunc.php";
if(!($uid=$_S['seuserid']))f_toerror("nologin");
$q="select * from tspu where uid=$uid and gid=0";
$rs=mysql_query($q) or die(f_e($q));
$n=mysql_num_rows($rs);
mysql_free_result($rs);
if(!n)f_toerror("noright");

$h=0;
$rootnode="";
$linetree=array();

buildguesthelp();
builduserhelp();
buildmnghelp();

mysql_close($link);

function buildmnghelp(){
	global $h,$_rootpath;
	$f="$_rootpath/mjs/mm.js";
	@unlink($f);
	$h = fopen ($f, "w");

	fwrite ($h, "/* 本文件由论坛超级管理员于 " . date("Y-m-d H:i:s",time()) . " 创建 */\n");
	echo "/* mng本文件由论坛超级管理员 " . $_S['seuserid'] . ":" . $_S['seusername'].  " 于 " . date("Y-m-d H:i:s",time()) . " 创建 */<br>"; 

	fwrite($h,"\nvar n3=new node();\n");
	
	$prow->id=3;
	buildtree($prow,0);
	
	fwrite ($h, $fileend);
	echo $fileend;
	
	fclose ($h);
}

function builduserhelp(){
	global $h,$_rootpath;
	$f="$_rootpath/mjs/um.js";
	@unlink($f);
	$h = fopen ($f, "w");

	fwrite ($h, "/* 本文件由超级管理员于" . date("Y-m-d H:i:s",time()) . "创建 */\n");
	echo "/* 本文件由超级管理员" . $_S['seuserid'] . ":" . $_S['seusername'].  "于" . date("Y-m-d H:i:s",time()) . "创建 */<br>"; 

	fwrite($h,"\nvar n2=new node();\n");
	
	$prow->id=2;
	buildtreeadd(4,"n2");
	buildtree($prow,0);
	buildtreeadd(9,"n2");
	
	fwrite ($h, $fileend);
	echo $fileend;
	
	fclose ($h);
}

function buildguesthelp(){
	global $h,$_rootpath;
	$f="$_rootpath/mjs/gm.js";
	@unlink($f);
	$h = fopen ($f, "w");

	fwrite ($h, "/* 本文件由超级管理员于" . date("Y-m-d H:i:s",time()) . "创建 */\n");
	echo "/* guest本文件由超级管理员" . $_S['seuserid'] . ":" . $_S['seusername'].  "于" . date("Y-m-d H:i:s",time()) . "创建 */<br>"; 

	fwrite($h,"\nvar n1=new node();\n");
	
	$prow->id=1;
	buildtreeadd(4,"n1");
	buildtree($prow,0);
	buildtreeadd(9,"n1");
	
	fwrite ($h, $fileend);
	echo $fileend;
	
	fclose ($h);
}
function havechild($r){
	$q="select count(id) as num from thelp where pid=$r->id";
	$R=mysql_query($q) or die(f_e($q));
	$r1=mysql_fetch_object($R);
	mysql_free_result($R);
	return $r1->num;
}
function buildtree($prow,$level){
	global $h;
	$q = "select * from thelp where pid=$prow->id order by sort asc;";
	$R = mysql_query($q) or die(f_e($q));
	$level++;
	if($len=mysql_num_rows($R)){
		for($ri=0;$ri<$len;$ri++){
			$r=mysql_fetch_object($R);
fwrite ($h, "var n$r->id=new node($r->id,\"$r->link\",\"$r->title\")\nn$prow->id.c[n$prow->id.c.length]=n$r->id;\n");
			buildtree($r,$level);
		}
	}
	mysql_free_result($R);
}
function buildtreeadd($id,$rootnode){
	global $h;
	$q = "select * from thelp where id=$id";
	$R = mysql_query($q) or die(f_e($q));
	$r=mysql_fetch_object($R);
	mysql_free_result($R);
	fwrite ($h, "var n$r->id=new node($r->id,\"$r->link\",\"$r->title\");\n$rootnode.c[$rootnode.c.length]=n$r->id;\n");
	buildtree($r,$level);
}
?>