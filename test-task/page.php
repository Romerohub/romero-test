<?php
require_once("lib/pagination.class.php");

$p = new pagination();

if(!empty($_GET['page'])){
	$p->current = $_GET['page'];
}


echo $p->showNumbers();





