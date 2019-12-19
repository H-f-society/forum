<?php  
	
	if($_POST["code1"] != ""){
		if($_POST["code1"] != $_POST["code2"]){
			echo "1";
		}
	}else{
		echo "2";
	}
?>