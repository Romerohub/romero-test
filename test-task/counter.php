<?php
 
 $arr = array();
 $n = 109;
for($y=0; $y<10; $y++){
 		$arr[$y]=1;
}
 	 	
 for($i=1; $i<$n; $i++){
 	for($y=0;$y<10;$y++){
 		
 		$pos = strpos((string)$i, (string)$y);
 		if($pos !== false){
 			$arr[$y]++;
 		}
 	}
 }
 
 
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
</head>
<body>

<table border="1px" cellpadding="5" cellspacing="0">
<tr>
	<td width="300px">Исходные данные</td>
	<td width="300px">результат</td>
</tr>
<tr>
	<td valign="top"><?php echo $n; ?></td>
	<td>
	<?php  
	foreach($arr as $k=>$v){
 		echo $v."<br>";
	} 
 	?>
 	</td>
</tr>
</table>

</body>
</html>