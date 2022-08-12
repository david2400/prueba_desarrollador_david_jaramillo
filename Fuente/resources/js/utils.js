/////////////////// At start ///////////////////
$(document).ready(function () {
  $("#usuario_menu").on("click", contenido_usuario);
  $("#contactos_menu").on("click", contenido_contacto);
  contenido_usuario();
});

function isEmpty(el) {
  return !$.trim(el.html());
}

function ocultar_contenidos(id) {
  $("#seccion_usuario").hide();

  $("#seccion_" + id).show();
}

/******************************************************************************** */

function contenido_usuario() {
  preloader();
  if (isEmpty($("#seccion_usuario"))) {
    $.ajax({
      url: "index.php",
      type: "post",
      data: {
        controlador: CT_1e,
        metodo: "index",
      },
      beforeSend: function () {},
      success: function (data) {
        var p1 = new Promise(function (resolve, reject) {
          $("#seccion_usuario").html(data);
          window.setTimeout(function () {
            resolve(endPreloader());
          }, 500);
        });
        ocultar_contenidos("usuario");

        p1.then(function (val) {
          $("#execute_search").on("click", execute_search);
          $("#execute_create").on("click", crearUsuario);
          startDataTable({
            idTable: "tablaUsuarios",
            controller: CT_1e,
            method: "reloadTable",
            responsive: true,
            scrollX: false,
            autoWidth: false,
            contextMenu: true,
            selection: true,
            contextMenu_items: {
              add: {
                name: "Editar detalle",
                icon: "fas fa-edit",
                callback: function (itemKey, opt, e) {
                  edit_usuario();
                },
              },
              edit: {
                name: "Eliminar",
                icon: "fas fa-plus-fa-trash-o",
                callback: function (itemKey, opt, e) {
                  cambiar_estado();
                },
              },
              selectAll: {
                name: "Seleccionar todo",
                icon: "fas fa-list-alt",
                callback: function (itemKey, opt, e) {
                  dataTableSelectAll();
                },
              },
              deSelectAll: {
                name: "Deseleccionar todo",
                icon: "far fa-list-alt",
                callback: function (itemKey, opt, e) {
                  dataTableDeselectAll();
                },
              },
            },

            params: {
              identificacion: $("#identificacion_for").val(),
              nombres: $("#nombre_for").val(),
              apellidos: $("#apellidos_for").val(),
              fecnacimiento: $("#fecha_nacimiento_for").val(),
              genero: $("#genero_for").val(),
            },
            columns: [
              { title: "item_row", data: "item_row", visible: false },
              { title: "Tipo", data: "tipo" },
              { title: "Identificacion", data: "identificacion" },
              { title: "Nombres", data: "nombres" },
              { title: "Apellidos", data: "apellidos" },
              { title: "Fecha de nacimiento", data: "fecnacimiento" },
              { title: "Genero", data: "genero" },
              { title: "Estado", data: "estado" },
              {
                title: "Contactos",
                data: "contactos",
                render: function (data, type, row, meta) {
                  return (
                    "<a class='btn btn-xs btn-default' data-toggle='tooltip' onclick=" +
                    "cargar_modal_contactos_usuario('" +
                    row.consec +
                    "')>" +
                    "<span class='fa fa-phone'></span></a>"
                  );
                },
              },
            ],
            // orderCol : 6,
            // orderType : 'asc',
            rowCallback: function (row, data, index) {},
          });
        }).catch(function (reason) {
          alert(reason);
        });
      },
      error: function (jqXHR, textStatus) {
        endWait();
        Swal.fire({
          title: "Error!",
          text: jqXHR.responseText,
          icon: "error",
        });
      },
    });
  } else {
    ocultar_contenidos("usuario");
    endPreloader();
  }
}


function contenido_contacto() {
  preloader();
  if (isEmpty($("#seccion_contactos"))) {
    $.ajax({
      url: "index.php",
      type: "post",
      data: {
        controlador: CT_1e,
        metodo: "index",
      },
      beforeSend: function () {},
      success: function (data) {
        var p1 = new Promise(function (resolve, reject) {
          $("#seccion_contactos").html(data);
          window.setTimeout(function () {
            resolve(endPreloader());
          }, 500);
        });
        ocultar_contenidos("contactos");

        p1.then(function (val) {
          $("#execute_search_contactos").on("click", execute_search_contactos);
          $("#execute_create_contactos").on("click", crearContacto);
          startDataTable({
            idTable: "tablaUsuarios",
            controller: CT_1e,
            method: "reloadTable",
            responsive: true,
            scrollX: false,
            autoWidth: false,
            contextMenu: true,
            selection: true,
            contextMenu_items: {
              add: {
                name: "Editar detalle",
                icon: "fas fa-edit",
                callback: function (itemKey, opt, e) {
                  edit_contacto();
                },
              },
              edit: {
                name: "Eliminar",
                icon: "fas fa-plus-fa-trash-o",
                callback: function (itemKey, opt, e) {
                  cambiar_estado();
                },
              },
              selectAll: {
                name: "Seleccionar todo",
                icon: "fas fa-list-alt",
                callback: function (itemKey, opt, e) {
                  dataTableSelectAll();
                },
              },
              deSelectAll: {
                name: "Deseleccionar todo",
                icon: "far fa-list-alt",
                callback: function (itemKey, opt, e) {
                  dataTableDeselectAll();
                },
              },
            },

            params: {
              identificacion: $("#identificacion_for").val(),
              nombres: $("#nombre_for").val(),
              apellidos: $("#apellidos_for").val(),
              fecnacimiento: $("#fecha_nacimiento_for").val(),
              genero: $("#genero_for").val(),
            },
            columns: [
              { title: "item_row", data: "item_row", visible: false },
              { title: "Tipo", data: "tipo" },
              { title: "Identificacion", data: "identificacion" },
              { title: "Nombres", data: "nombres" },
              { title: "Apellidos", data: "apellidos" },
              { title: "Fecha de nacimiento", data: "fecnacimiento" },
              { title: "Genero", data: "genero" },
              { title: "Estado", data: "estado" },
              {
                title: "Contactos",
                data: "contactos",
                render: function (data, type, row, meta) {
                  return (
                    "<a class='btn btn-xs btn-default' data-toggle='tooltip' onclick=" +
                    "cargar_modal_contactos_usuario('" +
                    row.consec +
                    "')>" +
                    "<span class='fa fa-phone'></span></a>"
                  );
                },
              },
            ],
            // orderCol : 6,
            // orderType : 'asc',
            rowCallback: function (row, data, index) {},
          });
        }).catch(function (reason) {
          alert(reason);
        });
      },
      error: function (jqXHR, textStatus) {
        endWait();
        Swal.fire({
          title: "Error!",
          text: jqXHR.responseText,
          icon: "error",
        });
      },
    });
  } else {
    ocultar_contenidos("contactos");
    endPreloader();
  }
}



/***************************************************************************************************************** */
function cargar_modal_contactos_usuario(consec) {
  globalVarsU.consec = consec;
  if (isEmpty($("#table_contactos_usuario"))) {
    listarContactosUsuario();
    ver_telefonos_busqueda();
  } else {
    setTimeout(function () {
      reloadTable({ ids: ["table_contactos_usuario"] });
      ver_telefonos_busqueda();
    }, 200);
  }
}

function ver_telefonos_busqueda() {
  var element = $("#modalContactos");
  modalStyle({
    html: element,
    header: "Ver telefonos",
    myFunction: "",
    button_text: "OK",
    cancelButton: () => {
      closeModal();
    },
  });
}

function listarContactosUsuario() {
  startDataTable({
    idTable: "series_table",
    controller: CT_1e,
    method: "busquedaS2series",
    responsive: true,
    scrollX: false,
    autoWidth: false,
    contextMenu: false,
    params: {
      condet: () => {
        return globalVarsP.condet;
      },
      conmas: () => {
        return globalVarsP.conmas;
      },
    },
    columns: [
      { title: "consec", data: "consec", visible: false },
      { title: "conmas", data: "conmas", visible: false },
      { title: "condet", data: "condet", visible: false },
      { title: "codpro", data: "codpro", visible: false },
      { title: "Series", data: "nroser" },
    ],
    // orderCol : 6,
    // orderType : 'asc',
    rowCallback: function (row, data, index) {
      //   console.log('datosssssssss');
      //   console.log(data);
      pro = data.codpro;
    },
  });
}




/***************************************************************** */
function selectOrdenes() {
  autocomplete({
    id: "valor_factura_for",
    controlador: CT_1e,
    metodo: "fillOutAutocompleteNumeroCompra",
    parametros: {
      ordenCompra: () => {
        return $("#proveedor_for").val();
      },
    },
    events: [
      {
        event: "change.select2",
        action: "setTimeout(function(){validarOrdenCompra();},100);",
      },
    ],
  });

  $("#valor_factura_for").select2("trigger", "select", {
    data: { id: "", text: "" },
  }); // Este metodo limpia el select oki
}


function limpiar_campos_usuario() {
  $("#identificacion_for").val("");
  $("#nombre_for").val("");
  $("#apellidos_for").val("");
  $("#fecha_nacimiento_for").val("");
  $("#genero_for").val("");

  execute_search();

}

function limpiar_campos_contacto() {
  $("#identificacion_for").val("");
  $("#nombre_for").val("");
  $("#apellidos_for").val("");
  $("#fecha_nacimiento_for").val("");
  $("#genero_for").val("");

  execute_search_contactos();
}

function validar_orden_parcial(ids, mess, arrs, idfoc) {
  var validacion = true;
  for (var i = 0; i < ids.length; i++) {
    if (ids[i].trim() != "") {
      keyId = ids[i];
      elemId = $("#" + keyId);
      valor = elemId.val();
      if (valor == "" || valor === undefined) {
        $("#" + ids[i]).focus(); //Dirige la navegacion
        elemId.addClass("input-error");
        alertify.error(mess[i]);

        validacion = false;
        break;
      }
    }
  }
  if (validacion) $("#" + idfoc).focus(); //Dirige la navegacion
  return validacion;
}

// FIN ENTRADA
