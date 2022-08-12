<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/* Configuración global */
require_once 'config/global.php';

/* Funciones para el controlador frontal */
require 'application/Odbc.php';

require_once 'config/structure.php';
require_once 'application/ControladorBase.php';
require_once 'application/VistaBase.php';
//echo'entraaaa';
/* Cargamos controladores y acciones */
if (isset($_REQUEST["controlador"])) {
  $controllerObj = cargarControlador($_REQUEST["controlador"]);
  lanzarAccion($controllerObj);
} else {
  $controllerObj = cargarControlador(CONTROLADOR_DEFECTO);

  lanzarAccion($controllerObj);
}
