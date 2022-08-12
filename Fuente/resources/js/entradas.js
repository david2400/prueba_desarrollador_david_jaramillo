

var linea_detalle_pro = new Array();
var linea_detalle = new Array();

var datos_ord = {};
var datos_ord_det = [];

let CT_1e = "usuario";

const globalVarsU = {
  consec: "",
};

const globalVarsC = {
  consec: "",
};

function crearUsuario() {
  if (validar_orden_maestro()) {
    //capturar cada uno de los campos
    var identificacion = $("#identificacion_for").val();
    var tipo_identificacion = $("#tipo_identificacion_for").val();
    var nombre = $("#nombre_for").val();
    var apellido = $("#apellidos_for").val();
    var fecnacimiento = $("#fecha_nacimiento_for").val();
    var genero = $("#genero_for").val();

    submitToService({
      controlador: CT_1e,
      metodo: "crearUser",
      // alertDone: true, //Genera alerta de sweet alert
      params: {
        //Parametros POST
        identificacion: identificacion,
        tipo_identificacion: tipo_identificacion,
        nombre: nombre,
        apellido: apellido,
        fecnacimiento: fecnacimiento,
        genero: genero
      },
      on_data: (data) => {
        //Que hacer cuando retorne info;
      },
      on_done: (data) => {
        
      },
      on_error: (data) => {
        
      },
    });
  }
}
/******************************************************************************************************* */
function execute_search(){
  setTimeout(function() { reloadTable({ ids: ["tablaUsuarios"] });  }, 200);
}

function execute_search_contactos(){
  setTimeout(function() { reloadTable({ ids: ["tablaUsuarios"] });  }, 200);
}

/******************************************************************************************************* */
function edit_usuario() {
  submitToService({
    controlador: CT_0,
    metodo: "return_edit",
    alertDone: false,
    params: {
      data: item_row[idTable]
    },
    on_data: (data) => {
      closeModal();
    },
    on_done: (data) => {
      globalVarsU=data[0].consec;
      $("#identificacion_for_modal").val(data[0].identificacion);
      $("#tipo_identificacion_for_modal").val(data[0].tipo);
      $("#nombre_for_modal").val(data[0].nombres);
      $("#apellidos_for_modal").val(data[0].apellidos);
      $("#fecha_nacimiento_for_modal").val(data[0].fecnacimiento);
      $("#genero_for_modal").val(data[0].genero);
  

      var element = $("#modalUpdateUser");
      modalStyle({
        html: element,
        header: "Editar usuario",
        myFunction: modificarUsuario,
        button_text: "Guardar",
        cancelButton: () => {
          closeModal();
        },
      });
    },
    on_error: () => {
      // alert("entra al error");
    },
  });
}

function edit_contacto() {
  submitToService({
    controlador: CT_0,
    metodo: "return_edit",
    alertDone: false,
    params: {
      data: item_row[idTable]
    },
    on_data: (data) => {
      closeModal();
    },
    on_done: (data) => {
      globalVarsC=data[0].consec;
      $("#nombre_for_contactos_modal").val(data[0].nombre);
      $("#numcontac_for_contactos_modal").val(data[0].numcontac);
      $("#tiponum_for_contactos_modal").val(data[0].tiponum);
      $("#usuario_for_contactos_modal").val(data[0].usuario);
      $("#parentesco_for_contactos_modal").val(data[0].parentesco);

      var element = $("#modalUpdate");
      modalStyle({
        html: element,
        header: "Editar contactos",
        myFunction: modificarContacto,
        button_text: "Guardar",
        cancelButton: () => {
          closeModal();
        },
      });
    },
    on_error: () => {
      // alert("entra al error");
    },
  });
}





/******************************************************************************************************* */



function modificarUsuario() {
  if (validar_orden_maestro_modal()) {
    //capturar cada uno de los campos
    var identificacion = $("#identificacion_for_modal").val();
    var tipo_identificacion = $("#tipo_identificacion_for_modal").val();
    var nombre = $("#nombre_for_modal").val();
    var apellido = $("#apellidos_for_modal").val();
    var fecnacimiento = $("#fecha_nacimiento_for_modal").val();
    var genero = $("#genero_for_modal").val();

    submitToService({
      controlador: CT_1e,
      metodo: "modificarUser",
      // alertDone: true, //Genera alerta de sweet alert
      params: {
        consec:globalVarsU.consec,
        identificacion: identificacion,
        tipo_identificacion: tipo_identificacion,
        nombre: nombre,
        apellido: apellido,
        fecnacimiento: fecnacimiento,
        genero: genero
      },
      on_data: (data) => {
        //Que hacer cuando retorne info;
      },
      on_done: (data) => {
        
      },
      on_error: (data) => {
        
      },
    });
  }
}
function modificarContacto() {
  if (validar_orden_maestro()) {
    //capturar cada uno de los campos
    var usuario = $("#identificacion_for").val();
    var nombre = $("#identificacion_for").val();
    var numcontac = $("#identificacion_for").val();
    var tipo_num = $("#tipo_identificacion_for").val();
    var parentesco = $("#parentesco_for").val();

    submitToService({
      controlador: CT_1e,
      metodo: "modificarContacto",
      // alertDone: true, //Genera alerta de sweet alert
      params: {
        consec:globalVarsC.consec,
        nombre: nombre,
        usuario: usuario,
        numcontac: numcontac,
        tipo_num: tipo_num,
        parentesco: parentesco
      },
      on_data: (data) => {
        //Que hacer cuando retorne info;
      },
      on_done: (data) => {
        
      },
      on_error: (data) => {
        
      },
    });
  }
}



/************************************************************************************************************* */
function cambiar_estado(e) {
  modalConfirm({
    message: 'Segur@ que desea cambiar el estado del registro seleccionado',
    doConfirm: () => {
      submitToService({
        controlador: 'usuarios',
        metodo: 'cambiar_estado',
        alertDone: false,
        params: {
          data: item_row[idTable]
        },
        on_data: (data) => {
        },
        on_done: (data) => {
          closeModal();
          execute_search(); 
          if (data.success) {
            alertify.success(data.message);
          }else {
            alertify.error(data.message);
          }
        },
        on_error: () => {

        }
      });
    },
    doCancel: () => {
    }
  })
}

function cambiar_estado_contacto(e) {
  modalConfirm({
    message: 'Segur@ que desea cambiar el estado del registro seleccionado',
    doConfirm: () => {
      submitToService({
        controlador: 'usuarios',
        metodo: 'cambiar_estado_contacto',
        alertDone: false,
        params: {
          data: item_row[idTable]
        },
        on_data: (data) => {
        },
        on_done: (data) => {
          closeModal();
          execute_search_contactos(); 
          if (data.success) {
            alertify.success(data.message);
          }else {
            alertify.error(data.message);
          }
        },
        on_error: () => {

        }
      });
    },
    doCancel: () => {
    }
  })
}

/*************************************************************************** */
function crearUsuario() {
  if (validar_orden_maestro()) {
    //capturar cada uno de los campos
    var identificacion = $("#identificacion_for").val();
    var tipo_identificacion = $("#tipo_identificacion_for").val();
    var nombre = $("#nombre_for").val();
    var apellido = $("#apellidos_for").val();
    var fecnacimiento = $("#fecha_nacimiento_for").val();
    var genero = $("#genero_for").val();

    submitToService({
      controlador: CT_1e,
      metodo: "crearUser",
      // alertDone: true, //Genera alerta de sweet alert
      params: {
        //Parametros POST
        identificacion: identificacion,
        tipo_identificacion: tipo_identificacion,
        nombre: nombre,
        apellido: apellido,
        fecnacimiento: fecnacimiento,
        genero: genero
      },
      on_data: (data) => {
        //Que hacer cuando retorne info;
      },
      on_done: (data) => {
        
      },
      on_error: (data) => {
        
      },
    });
  }
}

function crearContacto() {
  if (validar_orden_contacto()) {
    //capturar cada uno de los campos
    var usuario = $("#identificacion_for").val();
    var nombre = $("#identificacion_for").val();
    var numero = $("#identificacion_for").val();
    var tipo_num = $("#tipo_identificacion_for").val();
    var parentesco = $("#parentesco_for").val();

    submitToService({
      controlador: CT_1e,
      metodo: "crearContacto",
      // alertDone: true, //Genera alerta de sweet alert
      params: {
        //Parametros POST
        usuario: usuario,
        tipo_identificacion: tipo_identificacion,
        nombre: nombre,
        numero: numero,
        tipo_num: tipo_num,
        parentesco: parentesco
      },
      on_data: (data) => {
        //Que hacer cuando retorne info;
      },
      on_done: (data) => {
        
      },
      on_error: (data) => {
        
      },
    });
  }
}

/*************************************************** */



function validar_orden_maestro() {
  var validacion = true;
  ids = [
    "identificacion_for",
    "nombre_for",
    "apellidos_for",
    "fecha_nacimiento_for",
    "genero_for"
  ];
  mess = [
    "Ingresar Identificacion",
    "Ingresar Nombre",
    "Ingresar Apellido",
    "Ingresar Fecha de nacimiento",
    "Ingresar Genero"
  ];
  validacion = validar_orden_parcial(ids, mess, [], "");

  return validacion;
}

function validar_orden_maestro_modal() {
  var validacion = true;
  ids = [
    "identificacion_for_modal",
    "nombre_for_modal",
    "apellidos_for_modal",
    "fecha_nacimiento_for_modal",
    "genero_for_modal"
  ];
  mess = [
    "Ingresar Identificacion",
    "Ingresar Nombre",
    "Ingresar Apellido",
    "Ingresar Fecha de nacimiento",
    "Ingresar Genero"
  ];
  validacion = validar_orden_parcial(ids, mess, [], "");

  return validacion;
}

function validar_orden_contacto() {
  var validacion = true;
  ids = [
    "identificacion_for",
    "nombre_for",
    "apellidos_for",
    "fecha_nacimiento_for",
    "genero_for"
  ];
  mess = [
    "Ingresar Identificacion",
    "Ingresar Nombre",
    "Ingresar Apellido",
    "Ingresar Fecha de nacimiento",
    "Ingresar Genero"
  ];
  validacion = validar_orden_parcial(ids, mess, [], "");

  return validacion;
}

function validar_orden_contacto_modal() {
  var validacion = true;
  ids = [
    "identificacion_for_modal",
    "nombre_for_modal",
    "apellidos_for_modal",
    "fecha_nacimiento_for_modal",
    "genero_for_modal"
  ];
  mess = [
    "Ingresar Identificacion",
    "Ingresar Nombre",
    "Ingresar Apellido",
    "Ingresar Fecha de nacimiento",
    "Ingresar Genero"
  ];
  validacion = validar_orden_parcial(ids, mess, [], "");

  return validacion;
}

