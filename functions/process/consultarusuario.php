<?php
	require 'usuariodao.php';
	$user = new UsuarioDAO();

	$idusuario = $_GET['idusuario'];

	$user->readbyidusuario($idusuario);
?>