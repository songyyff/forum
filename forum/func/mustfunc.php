<?php include "../hefo/db.php";

session_name('PHPSESSID');
session_set_cookie_params(99999999,"/$_alias");
session_start();

//常数
$pointperitem=6;//每贴的分数
$pointperreplay=2;//每个回复的分数
$pointperaddtional=5;//每个附件的分数
$v_ontlen=15;//分钟数
$v_postpt=30;//发贴时间间隔秒数
$v_defitsize=30;//默认页面尺寸
$v_defrpsize=20;//默认回复页面尺寸
//权限设置
$right_saved['guestview']=1;//匿名用户浏览权
$right_saved['userview']=2;//普通用户浏览权
$right_saved['usernew']=4;//普通用户发贴权
$right_saved['usermodify']=8;//普通用户贴子修改权
$right_saved['userrpy']=1<<4;//普通用户回复权
$right_saved['usershow']=1<<5;//是否对普通用户显示内容
$right_saved['usermsg']=1<<6;//是否可收发消息
$right_saved['userismng']=1<<7;//用户是否管理员
$right_saved['userstop']=1<<8;//用户禁言
$right_saved['uservote']=1<<9;//用户投票权
//高16位
$right_saved['superview']=1<<16;//管理员浏览权 0x10000
$right_saved['supernew']=1<<17;//管理员发贴权
$right_saved['supermodify']=1<<18;//管理员修改权
$right_saved['supershow']=1<<19;//管理员显示权
$right_saved['superrpy']=1<<20;//管理员回复权
$right_saved['superhidden']=1<<21;//管理员隐藏权
$right_saved['superdel']=1<<22;//管理员删除权
$right_saved['superother']=1<<23;//管理其他管理员
$right_saved['supermng']=0xffffffff;//零时管理员权

$_S=&$_SESSION;$_R=&$_REQUEST;

if($_S['seuserpass']&&$_S['seuserpass']!=$_R['couserpass']){$_S=array();session_destroy();f_toerror("illegallogin");}

//判断是否使用cookie登陆
if($_S["seuserid"]){//分析用户在线时间
if(time()>$_S["seltime"]){$q="update tuser set ltime=\"".date("Y-m-d H:i:s",time())."\",ontime=ontime+".($v_ontlen+($tt=(time()-$_S["seltime"])/60)<$v_ontlen?$tt:0)." where id=".$_S['seuserid'];mysql_query($q) or die(f_e($q));$_S["seltime"]=time()+$v_ontlen*60;}
}else if(!$_S['selgd']){$_S=array();$_S['seuserid']=0;$_S['selgd']=1;$_S['seitsize']=$v_defitsize;$_S['serpsize']=$v_defrpsize;$_S["senew"]=24;$_S["sestyle"]="blue1";$_S[seismng]=0;if(isset($_COOKIE["cousername"])){include "../func/login.php";f_login($_COOKIE["cousername"],$_COOKIE["couserpass"],1);}}

function f_getsubpath(){$p=$_SERVER['SCRIPT_NAME'];$k=strlen($p)-6;while($p[$k--]!='/');if($k<0)return "/";while($p[$k--]!='/');if($k<0)return "/";else return substr($p,0,$k+2);}
function f_toerror($e=0){if($e)$_SESSION["seerrorid"]=$e;header("location: http://".$_SERVER['HTTP_HOST'].f_getsubpath()."pro/errorinfo.php");die;}
function f_date($time){return date("y.m.d H:i",strtotime($time));}
function f_isonline($indatetime){return strtotime($indatetime)<(time()-30*60);}
$v_mgcc=get_magic_quotes_gpc();
function &f_rpspc(&$s){global$v_mgcc;return str_replace(array("&","<","\"","\\\\"),array("&amp;","&lt;","&quot;","&#092;"),$v_mgcc?stripslashes($s):$s);}
function &f_delsla(&$s){global$v_mgcc;return$v_mgcc?stripslashes($s):$s;}
function &f_slquot(&$s){global$v_mgcc;return$v_mgcc?$s:addslashes($s);}