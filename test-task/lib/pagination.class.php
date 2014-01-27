<?php

class pagination {

	public $total_n = 7;//количество элементов ссылок на странице
	
	public $max_count = 10; //общее количество страниц
	public $current = 1; //номер текущей страницы
	
	public $page = "?page="; //
	
	private $num = 0; 


    function __construct() {
    	if($this->total_n  > $this->max_count ){
    		$this->total_n  = $this->max_count;
    	}
    	
    }

	/**формирование пагинации**/
    public function showNumbers(){
    	
    	$str = "";
    	
    	$str .= '<a href="'.$this->page.'1"><<</a>';
    	$str .= ' ';
    	
    	$before = $this->current - 1;
    	if($before < 1){
    		$before=1;
    	}
    	
    	$str .= '<a href="'.$this->page.$before.'"><-</a>';
    	
    	$area = $this->area();
    	
    	for($i=$area; $i <= $this->num; $i++){
    		
    		if($i == $this->current){
    			
    			$str .= ' [<a href="'.$this->page.$i.'">'.$i.'</a>] ';
    		}else{
    			
    			$str .= ' (<a href="'.$this->page.$i.'">'.$i.'</a>) ';
    		}
    	}
    	
    	$after = $this->current + 1;
    	if($after > $this->num){
    		$after = $this->num;
    	}
    	$str .= '<a href="'.$this->page.$after.'">-></a>';
    	$str .= ' ';
    	$str .= '<a href="'.$this->page.$this->num.'">>></a>';
    	
    	return $str;
    }

    private function area(){
    
    	$tmp = floor($this->total_n/2);
    	
    	$tmp = $this->current-$tmp;
    	
    	if($tmp < 1){
    		
    		$tmp = 1;
    	}else{

    		$this->num = $this->total_n+$tmp-1; 
    		
    		if($this->num > $this->max_count ){
    		
	    		$this->num = $this->max_count;
	    	}

	    	 $tmp2= $this->num - $tmp+1;
	    	
	    	$tmp2 = $this->total_n -$tmp2;
	    	if($tmp2 >0){
	    		$tmp = $tmp-$tmp2;
	    	}

    	}
    	if($this->num < 1){
	    	$this->num = $this->total_n;
	    }

    	return $tmp;
    }
    
}
