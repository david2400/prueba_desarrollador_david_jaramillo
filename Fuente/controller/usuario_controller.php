<?php

/**
 * Este controlador tiene como objetivo gestionar la vista principal 
 * y los metodos de proposito general de la aplicacion
 *
 * @author david
 */

class usuario_controller extends ControladorBase
{

    private $model;

    private $objCon;

    function __construct()
    {
        parent::__construct();
        $this->model = cargarModel('usuario');

        $this->objCon = new Odbc();
        $this->con = $this->objCon->conectar(MYSQL_USER, MYSQL_DATABASE, MYSQL_PASSWORD, MYSQL_HOST);
    }


    function index()
    {
        $vista = cargarView("usuario");
        $vista->dibujar();
    }

    function contenido_modal_telefonos()
    {
        $vista = cargarView("usuario");
        $vista->html_form_ver_series();
    }


    function crearUser()
    {
        $return = ['message' => 'Se ha registrado con exito', 'title' => 'Genial!', 'icon' => 'success'];
        $a = $this->model;
        $a->autocommit();
        $data = $_POST['params'];

        // IBG\rlog($data);
        // IBG\rlog($result);

        $datos = [
            'consec' => 0,
            'identificacion' => $data['identificacion'],
            'nombres' =>  $data['nombres'],
            'apellidos' => $data['apellidos'],
            'fecnacimiento' => $data['fecnacimiento'],
            'genero' => $data['genero'],
            'tipo' => $data['tipo']
        ];
        $insert = IBG\crearSentenciaInsert([
            'tabla' => 'usuario',
            'conten' => $datos
        ]);
        $result = $this->objCon->ExecuteTransaction($insert);

        if ($result == 0) {
            $return['success'] = true;
        } else {
            $return['success'] = false;
        }

        IBG\service_return($return);
    }


    function crearContacto()
    {
        $return = ['message' => 'Se ha registrado con exito', 'title' => 'Genial!', 'icon' => 'success'];
        $a = $this->model;
        $a->autocommit();
        $data = $_POST['params'];

        // IBG\rlog($data);
        // IBG\rlog($result);

        $datos = [
            'consec' => 0,
            'usuario' => $data['usuario'],
            'nombre' =>  $data['nombre'],
            'numcontac' => $data['numcontac'],
            'tiponum' => $data['tiponum'],
            'parentesco' => $data['parentesco']
        ];

        $insert = IBG\crearSentenciaInsert([
            'tabla' => 'contacto',
            'conten' => $datos
        ]);
        $result = $this->objCon->ExecuteTransaction($insert);

        if ($result == 0) {
            $return['success'] = true;
        } else {
            $return['success'] = false;
        }

        IBG\service_return($return);
    }


    function cambiar_estado()
    {
        $return = ['success' => true, 'message' => 'Se modifico exitosamente la maquina'];
        $a = $this->model;
        $data = $_POST['params']['data'];

        for ($i = 0; $i < count($data); $i++) {
            $sql = $a->consultar_estado(['consec' => $data[$i]]);
            $datosOdbc = $this->objCon->Execute($sql);
            array_walk_recursive($datosOdbc, function (&$item) {
                $item = utf8_encode(trim($item));
            });
            $set['estado'] = '';
            if ($datosOdbc[0]['estado'] === 'A') {
                $set['estado'] = 'I';
            } else if ($datosOdbc[0]['estado'] === 'I') {
                $set['estado'] = 'A';
            }
            $where['consec'] = $data[$i];

            $update = IBG\crearSentenciaUpdate([
                'tabla' => 'usuario',
                'sets' => $set,
                'where' => $where
            ]);
            $result = $this->objCon->ExecuteTransaction($update);
        }

        if ($result != 0) {
            $return = ['success' => false, 'message' => 'Error modificando el estado de la maquina'];
        }

        IBG\service_return(['data' => $return]);
    }


    function cambiar_estado_contacto()
    {
        $return = ['success' => true, 'message' => 'Se modifico exitosamente la maquina'];
        $a = $this->model;
        $data = $_POST['params']['data'];

        for ($i = 0; $i < count($data); $i++) {
            $sql = $a->consultar_estado(['consec' => $data[$i]]);
            $datosOdbc = $this->objCon->Execute($sql);
            array_walk_recursive($datosOdbc, function (&$item) {
                $item = utf8_encode(trim($item));
            });
            $set['estado'] = '';
            if ($datosOdbc[0]['estado'] === 'A') {
                $set['estado'] = 'I';
            } else if ($datosOdbc[0]['estado'] === 'I') {
                $set['estado'] = 'A';
            }
            $where['consec'] = $data[$i];

            $update = IBG\crearSentenciaUpdate([
                'tabla' => 'usuario',
                'sets' => $set,
                'where' => $where
            ]);

            $result = $this->objCon->ExecuteTransaction($update);
        }
        if ($result != 0) {
            $return = ['success' => false, 'message' => 'Error modificando el estado de la maquina'];
        }
        IBG\service_return(['data' => $return]);
    }

    /**
     * Metodos que permite obtener el consecutivo de cualquier entrada para poder obtener toda la informacion 
     */
    public function buscarUsuario()
    {
        $a = $this->model;
        $data = $_POST['param']; // Aqui lo tienes como "params" asi. Listo!
        $dataTable['data'] = [];
        // $dataTable['data'] = [];
        $sql = $a->obtener_usuarios($data);
        $datosOdbc = $this->objCon->Execute($sql);
        array_walk_recursive($datosOdbc, function (&$item) {
            $item = utf8_encode(trim($item));
        });


        $dataTable = [
            "identificacion" => $datosOdbc['identificacion'],
            "tipo" => $datosOdbc['tipo'],
            "nombres" => $datosOdbc['nombres'],
            "apellidos" => $datosOdbc['apellidos'],
            "fecnacimiento" => $datosOdbc['fecnacimiento'],
            "genero" => $datosOdbc['genero'],
            "estado" => $datosOdbc['estado']
        ];

        IBG\service_return([
            'message' => 'respuesta',
            'data' => $dataTable
        ]);
    }

    /**
     * Metodos que permite obtener el consecutivo de cualquier entrada para poder obtener toda la informacion 
     */
    public function reloadTable()
    {
        $a = $this->model;
        $data = $_POST['param']; // Aqui lo tienes como "params" asi. Listo!
        $dataTable['data'] = [];
        // $dataTable['data'] = [];
        $sql = $a->obtener_usuarios($data);

        $datosOdbc = $this->objCon->Execute($sql);
        IBG\rlog($datosOdbc);

        if (!empty($datosOdbc)) {
            array_walk_recursive($datosOdbc, function (&$item) {
                $item = utf8_encode(trim($item));
            });
            foreach ($datosOdbc as $key => $value) {
                $dataTable['data'][] = [
                    "identificacion" => $value['identificacion'],
                    "tipo" => $value['tipo'],
                    "nombres" => $value['nombres'],
                    "apellidos" => $value['apellidos'],
                    "fecnacimiento" => $value['fecnacimiento'],
                    "genero" => $value['genero'],
                    "estado" => $value['estado']
                ];
            }
        }

        IBG\service_return([
            'message' => 'respuesta',
            'data' => $dataTable
        ]);
    }

    public function listarNumeros()
    {
        $a = $this->model;
        $data = $_POST['param']; // Aqui lo tienes como "params" asi. Listo!
        $dataTable['data'] = [];
        // $dataTable['data'] = [];
        $sql = $a->busquedaParametros($data);
        $datosOdbc = $this->objCon->Execute($sql);

        array_walk_recursive($datosOdbc, function (&$item) {
            $item = utf8_encode(trim($item));
        });

        if (!empty($datosOdbc)) {
            foreach ($datosOdbc as $key => $value) {
                $dataTable['data'][] = [
                    "consec" => $value['consec'],
                    "nrodoc" => $value['nrodoc'],
                    "fecha" => $value['fecha'],
                    "factura" => $value['factura'],
                    "fecfac" => $value['fecfac'],
                    "codven" => $value['codven'],
                    "numero_comprobante" => $value['numero_comprobante'],
                    "bodega" => $value['bodega'],
                    "accion" => $value['accion'],
                ];
            }
        }

        IBG\service_return([
            'message' => 'respuesta',
            'data' => $dataTable
        ]);
    }
    /*************************************************************************************** */

    function modificarUser()
    {
        $return = ['message' => 'Se ha registrado con exito', 'title' => 'Genial!', 'icon' => 'success'];
        $a = $this->model;
        $a->autocommit();
        $data = $_POST['params'];
        // IBG\rlog($data);
        // IBG\rlog($result);

        $set['identificacion'] =  $data['identificacion'];
        $set['nombres'] =  $data['nombres'];
        $set['apellidos'] =  $data['apellidos'];
        $set['fecnacimiento'] =  $data['fecnacimiento'];
        $set['genero'] =  $data['genero'];
        $set['tipo'] =  $data['tipo'];

        $where['consec'] = $data['consec'];

        $update = IBG\crearSentenciaUpdate([
            'tabla' => 'usuario',
            'sets' => $set,
            'where' => $where
        ]);

        $result = $this->objCon->ExecuteTransaction($update);

        if ($result != 0) {
            $return['success'] = false;
            $return['title'] = "Error!";
            $return['icon'] = 'error';
            $return['message'] = "ERROR! Modificando el usuario";
        }

        IBG\service_return($return);
    }

    function modificarContacto()
    {
        $return = ['message' => 'Se ha registrado con exito', 'title' => 'Genial!', 'icon' => 'success'];
        $a = $this->model;
        $a->autocommit();
        $data = $_POST['params'];
        // IBG\rlog($data);
        // IBG\rlog($result);

        $set['nombre'] =  $data['nombre'];
        $set['usuario'] =  $data['usuario'];
        $set['numcontac'] =  $data['numcontac'];
        $set['tiponum'] =  $data['tiponum'];
        $set['parentesco'] =  $data['parentesco'];

        $where['consec'] = $data['consec'];

        $update = IBG\crearSentenciaUpdate([
            'tabla' => 'usuario',
            'sets' => $set,
            'where' => $where
        ]);

        $result = $this->objCon->ExecuteTransaction($update);

        if ($result != 0) {
            $return['success'] = false;
            $return['title'] = "Error!";
            $return['icon'] = 'error';
            $return['message'] = "ERROR! Modificando contacto";
        }

        IBG\service_return($return);
    }
    /**************************************************************************** */

    function return_edit()
    {
        $a = $this->model;
        $data = $_POST['params'];
        $data = $data['data'];

        if (count($data) > 1) {
            throw new IBG\APIException("Sólo se permite editar un registro a la vez", []);
        }
        $sql = $a->obtener_usuario(['consec' => $data[0]]);
        $datosOdbc = $this->objCon->Execute($sql);

        array_walk_recursive($datosOdbc, function (&$item) {
            $item = utf8_encode(trim($item));
        });
        IBG\service_return([
            'data' => $datosOdbc
        ]);
    }

    function return_edit_contacto()
    {
        $a = $this->model;
        $data = $_POST['params'];
        $data = $data['data'];

        if (count($data) > 1) {
            throw new IBG\APIException("Sólo se permite editar un registro a la vez", []);
        }
        $sql = $a->obtener_contacto(['consec' => $data[0]]);
        $datosOdbc = $this->objCon->Execute($sql);
        array_walk_recursive($datosOdbc, function (&$item) {
            $item = utf8_encode(trim($item));
        });
        IBG\service_return([
            'data' => $datosOdbc
        ]);
    }
    // FIN METODOS INGRESO DE ENTRADA 

}
