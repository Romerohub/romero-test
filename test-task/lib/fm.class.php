<?php

class fm {

	public $mask="*";  // задаем маску поиска
	public $dir = "";
	public $up_dir = "";

    function __construct() {
    	
    }
    
    public function showList(){
    	
    	if(empty($this->dir)){
    		$this->dir =$_SERVER['DOCUMENT_ROOT'];
    	}
   		
   		$this->getUpFolder();
   		
   		
    	$dir = $this->dir."/".$this->mask;
    	
    	$list = glob($dir);
    	
		$arr = array();

    	foreach($list as $k=>$v){
    		
	    		if(is_dir($v)){
	    			$tmp['type'] = "folder";
	    			$tmp['have_access'] = is_readable($v);
 	    		}else{
	    			$tmp['type'] = "file";
	    		}
    			$tmp['file'] = $v;
    			

    		 	$tmp['name'] = basename($v);
 				$tmp['url'] = urlencode($v);
 				$tmp['file_size'] = filesize($v);
 				$tmp['file_size'] = round($tmp['file_size']/1024, 2);
 				$tmp['date_edit'] = date("d-m-Y H:i", filemtime($v));
 				$tmp['perms'] = $this->perms($v);
 				
 				$arr[] = $tmp;
    		
    	}
    	
  		return $arr;
    	
    }
    /**Получаем значения доступа*/
    function perms($filename)
	{
	    return substr(decoct(fileperms($filename)), -3);
	}
    
    private function getUpFolder(){
  	
    	$arr = explode("/", $this->dir );

   		$num =count($arr); 	
    	if( $num > 0){
    		unset($arr[$num-1]);
    	}
    	
  		$this->up_dir = implode("/", $arr);
  		if(empty($this->up_dir)){
  			$this->up_dir = "/";
  		}
    }
}

