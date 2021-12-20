<?php
	function seguranca_adm(){
		if((empty($_SESSION['usuarioId'])) || (empty($_SESSION['usuarioEmail'])) || (empty($_SESSION['idnivelacesso']))){		
			$_SESSION['loginErro'] = "Área restrita";
			header("Location: login.php");
		//}else{
		//	if($_SESSION['idnivelacesso'] != "1"){
		//		$_SESSION['loginErro'] = "Área restrita";
		//		header("Location: login.php");
		//	}
		}
	}
?>