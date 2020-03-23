<?php
	require 'usuariodao.php';
	$user = new UsuarioDAO();

	$idtipousuario = $_POST['idtipousuario'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$nombre = $_POST['nombre'];
	$appat = $_POST['appat'];
	$apmat = $_POST['apmat'];

    $data = array(
      'idtipousuario' => $idtipousuario,
      'username' => $username,
      'password' => $password,
      'nombre' => $nombre,
      'appat' => $appat,
      'apmat' => $apmat
    );

	$user->insert($data);
?>