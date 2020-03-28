<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class UsuarioDAO implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      $query = "SELECT * FROM usuario";
      $objUsuario = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objUsuario[] = $value;
      }
      echo json_encode($objUsuario, JSON_UNESCAPED_UNICODE);
    }        

    public function readtipousuario()
    {
      $query = "SELECT * FROM tipousuario";
      $objUsuario = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objUsuario['data'][] = $value;
      }
      echo json_encode($objUsuario, JSON_UNESCAPED_UNICODE);
    }    

    public function readbyidusuario($idusuario)
    {
      try {
        $query = "SELECT * FROM usuario WHERE id_usuario = " . $idusuario;
        $objUsuario = null;
        foreach ($this->conex->consultar($query) as $key => $value) {
          $objUsuario[] = $value;
        }
        echo json_encode($objUsuario, JSON_UNESCAPED_UNICODE);
      } catch(Exception $e) {
        $objUsuario = [];
      }
    }    

    public function readbyusernameandpassword($username, $password, $tipousuario)
    {
      try {
        $query = "SELECT * FROM usuario u INNER JOIN tipousuario tu
        ON u.id_tipo_usuario = tu.id_tipo_usuario WHERE username =  '$username' and password = '$password'";
        $objUsuario = null;
        foreach ($this->conex->consultar($query) as $key => $value) {
          if($tipousuario == $value['id_tipo_usuario']) {
            $objUsuario = $value;
          } else {
            $objUsuario = "errorTipoUsuario";
          }
        }
        echo json_encode($objUsuario, JSON_UNESCAPED_UNICODE);
      } catch(Exception $e) {
        $objUsuario = [];
      }
    }

  
    public function insert($data)
    {
      $idtipousuario = $data['idtipousuario'];
      $username = $data['username'];
      $password = $data['password'];
      $nombre = $data['nombre'];
      $appat = $data['appat'];
      $apmat = $data['apmat'];

      $valoresInsertar = array(
        ':idtipousuario' => $idtipousuario,
        ':username' => $username,
        ':password' => $password,
        ':nombre' => $nombre,
        ':appat' => $appat,
        ':apmat' => $apmat
      );

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO usuario VALUES (null, :idtipousuario, :username, :password, :nombre, :appat, :apmat)", $valoresInsertar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function delete($id)
    {
      $valoresEliminar = array(
        ':idUsuario' => $id,
      );
      $sentencia = $this->conex->ejecutarAccion("DELETE FROM usuario WHERE id_usuario = :idUsuario", $valoresEliminar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function update($data)
    {
      $idusuario = $data['idusuario'];
      $idtipousuario = $data['idtipousuario'];
      $username = $data['username'];
      $password = $data['password'];
      $nombre = $data['nombre'];
      $appat = $data['appat'];
      $apmat = $data['apmat'];

      $valoresActualizar = array(
        ':idusuario' => $idusuario,
        ':idtipousuario' => $idtipousuario,
        ':username' => $username,
        ':password' => $password,
        ':nombre' => $nombre,
        ':appat' => $appat,
        ':apmat' => $apmat
      );


      $sentencia = $this->conex->ejecutarAccion("UPDATE usuario SET idtipousuario=:idtipousuario,
                                                username = :username, password=:password,nombre=:nombre,
                                                appat = :appat, apmat = :apmat
                                                WHERE id_usuario = :idusuario", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

  }
