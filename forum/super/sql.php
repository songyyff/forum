<?php

e_e();

echo "<div class=subhead><b>Sql客户工具</b> ",date("Y-m-d H:i:s",time()),"<hr></div>";
if($query=f_delsla($_REQUEST['sqlstr'])){
	echo "sql: ".f_rpspc($query);
	$result=@mysql_query($query) or die("<br>SQL语句错误：$query<br>数据库消息：".mysql_error()."</br>");
	if($len=@mysql_num_rows($result)){
		echo "<table border=1 cellpadding=2 cellspacing=1>";
		if($cols=mysql_num_fields($result)){
		echo "<tr height=22 bgcolor=#f0f0f0>";
		for($i=0;$i<$cols;$i++){$cn=mysql_fetch_field($result);echo "<td><b>$cn->name</b></td>";}
		echo "</tr>";
		}
		$i=1;$h=$_REQUEST['ishtml'];
		while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
			echo "<tr height=20".($i%5?"":" bgcolor=#f0f0f0").">";
			foreach($row as $cv){
			echo "<td>".($h?$cv:"<pre>".f_rpspc($cv)."</pre>")."</td>";
			}
			echo "</tr>";
			$i++;
		}
		echo "</table>";
	}
	echo "<br>查出记录数：$len<br>被影响行数：".mysql_affected_rows()."<br>状态：".mysql_info();
	@mysql_free_result($result);
}
mysql_close($link);
?>
<p><font color="red">这里是您对数据库直接提交修改，需要十分紧慎，为了让数据返回迅速，<b>请使用 <font color=Black>limit</font> 限制查询结果在100行以内</b>。</font></p>
<form method="POST" enctype="multipart/form-data" action="?type=<?php echo $vtype;?>">
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr>
<TD width=67>Sql语句</td>
<td><textarea name=sqlstr rows=5 cols=72><?php echo f_rpspc($_REQUEST['sqlstr']); ?></textarea></TD>
</tr>
<tr>
<TD></td>
<td><input type=checkbox name=ishtml value=1<?php echo $_REQUEST['ishtml']?" checked":""; ?>>不进行HTML标记转换，直接显示结果。(HTML标记不可见)</TD>
</tr>
<tr height=34><TD></td>
<td><input type=submit value=" 提交(S) " default accesskey="S">   <input type=reset value="重置"></TD>
</tr>
</table>
</form>