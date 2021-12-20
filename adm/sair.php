<?php
	session_start();
	unset(
		$_SESSION['usuarioId'],
		$_SESSION['usuarioNome'],
		$_SESSION['idnivelacesso'] ,
		$_SESSION['usuarioEmail']
	);
	
	$_SESSION['loginDeslogado'] = "Deslogado com Sucesso";
	header("Location: login.php");
?>