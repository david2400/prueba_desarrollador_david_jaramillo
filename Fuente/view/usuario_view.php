<?php

/**
 * Este controlador tiene como objetivo gestionar la vista principal 
 * y los metodos de proposito general de la aplicacion
 *
 * @author Ancizar
 */
class usuario_view extends VistaBase
{

  /**
   * Pintar la pantalla principal
   */
  function dibujar()
  {
?>
    <div class="container-fluid" id="container">
      <div class="form-group col-sm-12 col-md-12">
        <h5 class="card-header">
          <div class="row">
            <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5">
              <button id="execute_search" type="button" class="btn btn-primary mr-2 "><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5">
              <div id="container_buscar">
                <span class="text-center">Gestionar</span>
                <button id="execute_create" type="button" class="btn btn-primary mr-2"><i class="fa fa-eye" aria-hidden="true"></i> Crear</button>
              </div>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-2 col-lg-2">
              <button type="button" class="btn btn-outline-danger" onclick="limpiar_campos_usuario();"><i class="fa-solid fa-x"></i></button>
            </div>
          </div>
        </h5>
      </div>
      <div class="card-body">
        <!-- Inicio formulario -->
        <form id='formularioCrearIngreso'>
          <div class="form-row d-flex align-items-end" id="main_buttons">

            <div class="form-group col-sm-4">
              <label for="identificacion_for" class="col-form-label">identificaci&oacute;n</label>
              <div class="input-group">
                <input type="text" class="form-control" id="identificacion_for" aria-label="Text input with dropdown button">
                <div class="input-group-append">
                  <select class="btn btn-outline-secondary dropdown-toggle" id="tipo_identificacion_for">
                    <option value="cc"> CC </option>
                    <option value="ti"> TI </option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group col-sm-4">
              <label for="nombre_for" class="col-form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre_for">
            </div>

            <div class="form-group col-sm-4">
              <label for="apellidos_for" class="col-form-label">Apellidos</label>
              <input type="text" class="form-control" id="apellidos_for">
            </div>

            <div class="form-group col-sm-4">
              <label for="fecha_nacimiento_for" class="col-form-label">Fecha Nacimiento</label>
              <input type="date" class="form-control" id="fecha_nacimiento_for">
            </div>

            <div class="form-group col-sm-3">
              <label for="genero_for" class="col-form-label">G&eacute;nero</label>
              <div id="genero_content">
                <select class="form-control" id="genero_for">
                  <option value="">Seleccionar...</option>
                  <option value="F">Femenino</option>
                  <option value="M">Masculino</option>
                </select>
              </div>
            </div>
          </div>
        </form>
        <!-- fin formulario -->
      </div>
    </div>


    <div class="container-fluid">
      <h5 class="card-header"><span class="text-center">Usuarios</span></h5>
      <div class="card-body">
        <div class="table-responsive">
          <form id="detalleform">
            <table id="tablaUsuarios" class="table table-hover table-condensed table-bordered table-striped">
            </table>
          </form>
        </div>
      </div>
    </div>

    <!-- ------------------------------------------------------------------------------------ -->

    <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel">
      <div id="modalContactos">
        <h5 class="card-header"><span class="text-center">Contactos</span></h5>
        <div class="card-body">
          <div class="table-responsive">
            <form id="detalleform">
              <div class="row">
                <div class="col-sm-12">
                  <table id="table_contactos_usuario" class="table table-striped table-bordered dt-responsive" style="width:100%"></table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="modalUpdateUser">
        <h5 class="card-header"><span class="text-center">Modificar</span></h5>
        <div class="card-body">
          <div class="table-responsive">
            <form id="detalleform">
              <div class="row">
                <div class="form-group col-sm-4">
                  <label for="identificacion_for_modal" class="col-form-label">identificaci&oacute;n</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="identificacion_for_modal" aria-label="Text input with dropdown button">
                    <div class="input-group-append">
                      <select class="btn btn-outline-secondary dropdown-toggle" id="tipo_identificacion_for_modal">
                        <option value="cc"> CC </option>
                        <option value="ti"> TI </option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group col-sm-4">
                  <label for="nombre_for_modal" class="col-form-label">Nombre</label>
                  <input type="text" class="form-control" id="nombre_for_modal">
                </div>

                <div class="form-group col-sm-4">
                  <label for="apellidos_for_modal" class="col-form-label">Apellidos</label>
                  <input type="text" class="form-control" id="apellidos_for_modal">
                </div>

                <div class="form-group col-sm-4">
                  <label for="fecha_nacimiento_for_modal" class="col-form-label">Fecha Nacimiento</label>
                  <input type="date" class="form-control" id="fecha_nacimiento_for_modal">
                </div>

                <div class="form-group col-sm-3">
                  <label for="genero_for_modal" class="col-form-label">G&eacute;nero</label>
                  <div id="genero_content_modal">
                    <select class="form-control" id="genero_for_modal">
                      <option value="">Seleccionar...</option>
                      <option value="F">Femenino</option>
                      <option value="M">Masculino</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  <?php
  }

  /**
   * Pintar el formulario de contactos
   * 
   */

  function dibujar_contactos()
  {
  ?>
    <div class="container-fluid" id="container">
      <div class="form-group col-sm-12 col-md-12">
        <h5 class="card-header">
          <div class="row">
            <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5">
              <button id="execute_search_contactos" type="button" class="btn btn-primary mr-2 "><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5">
              <div id="container_buscar">
                <span class="text-center">Gestionar</span>
                <button id="execute_create_contactos" type="button" class="btn btn-primary mr-2"><i class="fa fa-eye" aria-hidden="true"></i> Crear</button>
              </div>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-2 col-lg-2">
              <button type="button" class="btn btn-outline-danger" onclick="limpiar_campos_usuario();"><i class="fa-solid fa-x"></i></button>
            </div>
          </div>
        </h5>
      </div>
      <div class="card-body">
        <!-- Inicio formulario -->
        <form id='formularioCrearIngreso'>
          <div class="form-row d-flex align-items-end" id="main_buttons">

            <div class="form-group col-sm-4">
              <label for="nombre_for_contactos" class="col-form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre_for_contactos">
            </div>

            <div class="form-group col-sm-4">
              <label for="numcontac_for_contactos" class="col-form-label">Num. contacto</label>
              <div class="input-group">
                <input type="text" class="form-control" id="numcontac_for_contactos" aria-label="Text input with dropdown button">
                <div class="input-group-append">
                  <select class="btn btn-outline-secondary dropdown-toggle" id="tiponum_for_contactos">
                    <option value="C"> Celular </option>
                    <option value="F"> Fijo </option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group col-sm-6">
              <label for="usuario_for" class="col-form-label">Usuario</label>
              <div id="usuario_for_content">
                <select class="form-control" id="usuario_for"></select>
              </div>
            </div>

            <div class="form-group col-sm-3">
              <label for="parentesco_for_contactos" class="col-form-label">Parentesco</label>
              <div id="parentesco_content">
                <select class="form-control" id="parentesco_for_contactos">
                  <option value="">Seleccionar...</option>
                  <option value="A">Amigo</option>
                  <option value="F">Familiar</option>
                  <option value="C">Compañero de trabajo</option>
                </select>
              </div>
            </div>
          </div>
        </form>
        <!-- fin formulario -->
      </div>
    </div>


    <div class="container-fluid">
      <h5 class="card-header"><span class="text-center">Contactos</span></h5>
      <div class="card-body">
        <div class="table-responsive">
          <form id="detalleform">
            <table id="tablaContactos" class="table table-hover table-condensed table-bordered table-striped">
            </table>
          </form>
        </div>
      </div>
    </div>

    <!-- ------------------------------------------------------------------------------------ -->

    <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel">
      <div id="modalContactos">
        <h5 class="card-header"><span class="text-center">Contactos</span></h5>
        <div class="card-body">
          <div class="table-responsive">
            <form id="detalleform">
              <div class="row">
                <div class="col-sm-12">
                  <table id="table_contactos" class="table table-striped table-bordered dt-responsive" style="width:100%"></table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="modalUpdate">
        <h5 class="card-header"><span class="text-center">Modificar</span></h5>
        <div class="card-body">
          <!-- Inicio formulario -->
          <form id='formularioModificarContacto'>
            <div class="form-row d-flex align-items-end" id="main_buttons">

              <div class="form-group col-sm-4">
                <label for="nombre_for_contactos_modal" class="col-form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre_for_contactos_modal">
              </div>

              <div class="form-group col-sm-4">
                <label for="numcontac_for_contactos_modal" class="col-form-label">Num. contacto</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="numcontac_for_contactos_modal" aria-label="Text input with dropdown button">
                  <div class="input-group-append">
                    <select class="btn btn-outline-secondary dropdown-toggle" id="tiponum_for_contactos_modal">
                      <option value="C"> Celular </option>
                      <option value="F"> Fijo </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group col-sm-6">
                <label for="usuario_for_contactos_modal" class="col-form-label">Usuario </label>
                <div id="usuario_for_content_contactos_modal">
                  <select class="form-control" id="usuario_for_contactos_modal"></select>
                </div>
              </div>

              <div class="form-group col-sm-3">
                <label for="parentesco_for_contactos_modal" class="col-form-label">Parentesco</label>
                <div id="parentesco_content_modal">
                  <select class="form-control" id="parentesco_for_contactos_modal">
                    <option value="">Seleccionar...</option>
                    <option value="A">Amigo</option>
                    <option value="F">Familiar</option>
                    <option value="C">Compañero de trabajo</option>
                  </select>
                </div>
              </div>
            </div>
          </form>
          <!-- fin formulario -->
        </div>
      </div>
    </div>


<?php
  }
}
?>