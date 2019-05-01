<?php e_e();

//否是修改关键资料库
if($_R['isaltermain'])include"mydtm.php";

//修改其他资料
$F=&$_FILES['userselfhead'];
switch($uft=(int)$_R['facetype']){
case 0: $pic=f_rpspc($_R['userheadpic']);break;
case 1:
	if($F['error']==0)
	if($F['size']<1024*150){
		preg_match("/\.[^\.]*$/",$F['name'],$extn);
		$fileext=strtolower($e_=$extn[0]);
		if($fileext==".gif"||$fileext==".jpg"||$fileext==".jpeg"){
			$uf=date("yW")."/";
			$pp="$_rootpath/faces/$uf";
			if(!file_exists($pp))mkdir($pp,0777);
			do{$n_=base_convert(mt_rand(100,2000000000),10,36);$fn="$pp$n_$e_";}while(!$h_=fopen($fn,"x"));fclose($h_);
			if(@move_uploaded_file($F['tmp_name'],$fn)){
				$pic=$uf.$n_.$e_;
			}else $MSG.="创建上传头像文件 $fn 错误。";
		}else $MSG.="上传头像文件 ".f_rpspc($F['name'])." 类型错误，必须是 .gif .jpg .jpeg 文件。<br>";
	}else $MSG.="上传头像文件错误，".f_rpspc($F['name'])." 文件大小为".number_format($F['size'])."字节,上传最大尺寸为".number_format(1024*150)."字节。<br>";
	else $MSG.="上传头像文件错误，错误码: ".(int)$F['error']." .<br>";
}
if($uft<2&&$ur->face[0]!='s')@unlink("$_rootpath/faces/$ur->face");

$mysqli = new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}

$stmt=$mysqli->prepare("update tuser set sex=".((int)$_R['sex']).",email=?,bhday=\"".$_R['birthday']."\",phon=\"".$_R['phone']."\",qq=".(int)$_R['QQ'].",http=?,ptth=?,sign=?,info=?,newt=$nT,rsize=$rZ,isize=$iZ".($pic?",face=\"$pic\"":"")." where id=$ur->id");
$stmt->bind_param('sssss',$Em,$Hp,rawurlencode($_R['homepage']),$iS,$iI);
$stmt->execute();
if($stmt->errno)if($stmt->errno==1062)$MSG.=($stmt->error[strlen($stmt->error)-1]==2?"用户名":"Email地址")."冲突。<br>";else{echo"sql error:",$stmt->errno;die;}else{
//从新提取用户信息
$q="select * from tuser where id=$ur->id";
$R=mysql_query($q) or die(f_e($q));
if($R)$ur=mysql_fetch_object($R);else f_toerror("nouser");
$_S["seusername"]=$ur->name;
$_S["seitsize"]=$ur->isize;
$_S["serpsize"]=$ur->rsize;
$_S["senew"]=$ur->newt;
$MSG.="所有提交成功修改";
}