<?php

/**
  Clase que se encarga de las solicitudes a la BD
 */

class Odbc
{

  private $userbd;
  private $passworddb;
  private $database;
  private $port;
  private $host;
  private $connect;
  /**
    contructor
    dsn = nombre de la ODBC
    usuario = usuaridio de la BD
    clave = clave de la BD
    salir =
    simulador = (true) activa la opcion de desarrollador que evita que se hagan consultas a la BD. solo se consulta 1 vez y los datos son cargados en la SESSION
    (false) metodo por defecto. habilidato para produccion.
   */
  function __construct($userbd = '', $database = '', $clave = '', $host = '', $salir = true)
  {
    $this->userbd =  $userbd;
    $this->passworddb = $clave;
    $this->database = $database;
    $this->host = $host;
    $this->conectado = $this->conectar();
    $this->salir = $salir;
  }


  public function conectar($userbd = '', $database = '', $clave = '', $host = '', $salir = true)
  {
    try {
      $this->userbd = MYSQL_USER;
      $this->passworddb = MYSQL_PASSWORD;
      $this->database = MYSQL_DATABASE;
      $this->host = "localhost";

      /* Ultima linea de UTF8 es para evitar problemas con las acentuaciones y las Ñ */
      $this->connect = new PDO("mysql:host=$host;dbname=$database", $this->userbd, $this->passworddb, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      // set the PDO error mode to exception
      $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully";
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  /**
    funcion que consulta a la BD y que soporta la opcion de simulador.
    consulta = string de la consulta
    nomSimulador = alias de la consulta para ser guardada en la session y no ser reescribida.
   */
  public function getConnect()
  {
    return $this->connect;
  }

  public function ExecuteTransaction($query)
  {
    try {
      /* Le asigno la consulta SQL a la conexion de la base de datos */
      $resultado = $this->getConnect()->prepare($query);
      /* Executo la consulta */
      $resultado->execute();
      /* Si obtuvo resultados, entonces paselos a un vector */

      if ($resultado->rowCount() > 0) {
        return 0;
      } else {
        return 1;
      }
    } catch (PDOException $exception) {
      return 0;
    }
  }

  public function Execute($query)
  {
    $vec = [];
    try {
      /* Le asigno la consulta SQL a la conexion de la base de datos */
      $resultado = $this->getConnect()->prepare($query);
      /* Executo la consulta */
      $resultado->execute();
      /* Si obtuvo resultados, entonces paselos a un vector */
      if ($resultado->rowCount() > 0) {
        $vec = $resultado->fetchAll(PDO::FETCH_ASSOC);
      }

      return $vec;
    } catch (PDOException $exception) {
      /* Se captura el error de ejecucion SQL */

      return $vec;
    }
  }
}
