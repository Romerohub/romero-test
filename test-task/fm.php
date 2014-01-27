<h2>FILE MANAGER</h2>
<hr/>
<a href="/fm.php">Back root</a><br>
<?php

 require_once("lib/fm.class.php");
$fm = new fm();
  
$fm->mask="*";  // задаем маску поиска если нужно
  
 if(!empty($_GET['path'])){
 	
 	if($_GET['path'] == ".."){
 		
 	}else{
 	
	 	$dir = urldecode($_GET['path']);
	 	
	 	$fm->dir = $dir;
 	}
 }

$list =$fm->showList();
 	
  
 echo "<b>Current path:</b> ".$fm->dir."<br>";
 echo "<b>List of files</b><br>";
 
 ?>
 <table border="1"  cellspacing="0">
 <?php
 if(empty($fm->up_dir)){
 	 echo '<tr> <td width="300px">.. </td> <td> </td> </tr>';
 }else{
 	 echo '<tr> <td width="300px"><a href="?path='.$fm->up_dir.'">..</a> </td> <td> </td> </tr>';
 }
 
 if(empty($list)){
 	 echo '<tr> <td>empty folder!</td> <td></td> </tr>';
 }
 
 foreach($list as $k=>$v){

 	echo "<tr>";
 	if($v['type'] == "folder"){
 		echo ' <td><a href="?path='.$v['url'].'">'.$v['name'].'</a> </td><td>  Type: '.$v['type'].' | Permissions: '.$v['perms'].' | Last date edit: '.$v['date_edit']	
 		.(($v['have_access'])?"":' | <b style="color:red;">No Access!</b> ').'  </td>';
 		
 		
 	}else{
 echo "<td>".$v['name'].'</a></td><td>  Type: '.$v['type'].'  | Size: '.$v['file_size'].'kb | Last date edit: '.$v['date_edit'].' </td>';
 	}
 	echo "</tr>";
 	
 }
?>
</table>