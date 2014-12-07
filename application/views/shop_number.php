<?php 
	$number = count($this->cart->contents());

	if($number == 1){
		echo $number . " proizvod";
	}else{
		echo $number . " proizvoda";		
	}
	
 ?>