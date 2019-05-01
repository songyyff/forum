<?php
function f_newfile($path,$extname){
	do{$filename=time().rand(0,10000).$extname;
	}while(file_exists($path.$filename));
	return $filename;
}
e_e();

if(($l=strlen($_R['userpass']))<6||$l>50)$MSG="提交内容有错误!";
else{
$upedfile=0;
if($_R['facetype']){
	$F=&$_FILES['userselfhead'];
	if($F['error']==0){
		if($F['size']<160000){
			preg_match("/\.[^\.]*$/",$F['name'],$extn);
			$fileext=strtolower($e_=$extn[0]);
			if($fileext==".gif"||$fileext==".jpg"||$fileext==".jpeg"){
				$uf=date("yW")."/";
				$pp="$_rootpath/faces/$uf";
				if(!file_exists($pp))mkdir($pp,0777);
				do{$n_=base_convert(mt_rand(100,2000000000),10,36);$fn="$pp$n_$e_";}while(!$h_=@fopen($fn,"x"));fclose($h_);
				if(@move_uploaded_file($F['tmp_name'],$fn))$pic=$uf.$n_.$e_;else $MSG.="创建上传头像文件 $fn 错误。";
			}else $MSG.="上传头像文件 ".f_rpspc($F['name'])." 类型错误，必须是 .gif .jpg .jpeg 文件。<br>";
		}else $MSG.="上传头像文件错误，".f_rpspc($F['name'])." 文件大小为".number_format($F['size'])."字节,上传最大尺寸为".number_format(1024*150)."字节。<br>";
	}else $MSG.="上传头像文件错误，错误码: ".$F['error']." .<br>";
	if(!$pic)$pic="sys/3.jpg";
}else $pic=isset($_R['userheadpic'])?f_rpspc($_R['userheadpic']):"sys/3.jpg";

if(!$MSG){
include "../func/login.php";
f_encode(f_delsla($_R['userpass']));

$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$stmt=$mysqli->stmt_init();
$stmt->prepare("insert into tuser(ctime,ltime,name,pass,pkey,sex,email,bhday,phon,qq,http,ptth,sign,info,newt,rsize,isize,face,gptm) values(now(),now(),?,\"$v_enstr\",\"$v_enkey\",".(int)$_R['sex'].",?,'$_R[birthday]','$_R[phone]',".(int)$_R[QQ].",?,?,?,?,newt=$nT,rsize=$rZ,isize=$iZ,\"$pic\",now());");

$stmt->bind_param('ssssss',$Nm,$Em,$Hp,rawurlencode($_R['homepage']),$iS,$iI);
$stmt->execute();
$id=$mysqli->insert_id;
if($stmt->errno)if($stmt->errno==1062)$MSG.="注册".($stmt->error[strlen($stmt->error)-1]==2?"用户名":"Email地址")."冲突。<br>";else{echo"sql error:",$stmt->errno;die;}else{

$stmt=$mysqli->stmt_init();
$stmt->prepare("insert msgs(time,ref,tos,til,body)values(now(),1,?,?,?)");
$n="论坛系统";
$t="祝贺您成功注册论坛";
$b="尊敬的 $Nm ：\n\n    欢迎您来到本论坛。\n\n\n    祝您愉快 !\n\n    日期/时间: ".date("Y-m-d/H:i:s");
$stmt->bind_param('sss',$n,$t,$b);
$stmt->execute();

$q="insert msg(uid,fid,mid)values($id,0,".$mysqli->insert_id.")";
mysql_query($q) or die(f_e($q));

$realexpire=time()+60*60;
// set "cousername" must use $_R['username']
setcookie ("cousername",f_delsla($_R['username']),$realexpire,"/$_alias");
setcookie ("couserpass",$v_enstr,$realexpire,"/$_alias");
	
f_login($_R['username'],$v_enstr,1);
$constep=2;
}}}