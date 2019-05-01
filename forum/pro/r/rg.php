<?php e_e();

if(!$fE){header("HTTP/1.1 404 Not Found");die;}
$s=filesize($f);

$v=explode('=',$_SERVER['HTTP_RANGE']);
$m=explode('-',$v[1]);
$b=intval($m[0]);
$d=intval($m[1]);

if(!$b&&$d)$d--;
if(!$d&&$b){$b=$s-$b;$d=$s-1;}
if(count($m)!=2||$b>$d||$d>=$s){
header("HTTP/1.1 416 Requested range not satisfiable");
header("Content-Range: bytes */$s");
die;}
header('HTTP/1.1 206 Partial content');
header('Accept-Ranges: bytes');
header("Content-Range: bytes $b-$d/$s");
header("Content-Length: ".(++$d-$b));
header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: no-cache');  
header("Content-Transfer-Encoding: binary");
header("Last-Modified: ".date('r',filemtime($f)));
header("Content-Type: $z->t");

$fm=@fopen($f,'rb');
if(!$fm){header("HTTP/1.1 505 Internal server error");die;}
fseek($fm,$b,0);
while(!feof($fm)&&$b<$d&&!connection_status()){
print fread($fm,min(8192,$d-$b));
$b+=8192;
}
fclose($fm);
die;