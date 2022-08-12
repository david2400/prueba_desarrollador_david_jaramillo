<?php

/**
 * Este controlador tiene como objetivo gestionar la vista principal 
 * y los metodos de proposito general de la aplicacion
 *
 * @author Ancizar
 */
class ingreso_entrada_buscar_view extends VistaBase
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
            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-7">
              <span class="text-center">Busqueda</span>
              <button id="execute_buscar" type="button" class="btn btn-primary mr-2 ">Buscar</button>
              <button id="execute_modificar" type="button" class="btn btn-primary mr-2 " onclick="modificar();">Modificar</button>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-3">
              <div id="container_buscar">
                <span class="text-center">Entregas</span>
                <button id="execute_ver_entradas_busqueda" type="button" onclick="ver_entradas_busqueda();" class="btn btn-primary mr-2"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button>
              </div>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-2 col-lg-2">
              <button type="button" class="btn btn-outline-danger" onclick="limpiar_campos_buscador();"><i class="fa-solid fa-x"></i></button>
            </div>
          </div>
        </h5>
      </div>
      <div class="card-body">
        <!-- Inicio formulario -->
        <form id='formularioCrearIngreso'>
          <div class="form-row d-flex align-items-end" id="main_buttons">
            <input type="hidden" value="" id="id_remision" />

            <div class="form-group col-sm-4">
              <label for="remision_for_busqueda" class="col-form-label">Remision</label>
              <input type="text" class="form-control" id="remision_for_busqueda">
            </div>



            <!-- <input id="fechaop_busc" type="text" class="form-control  datepicker text-center input-sm" onfocus="quitar_error('fechaop_busc')" onkeyup="iniciar_busqueda(event);" data-placement="top" title="Fecha operacion" placeholder="Fecha operacion"> -->

            <div class="form-group col-sm-4">
              <label for="valor_remision_for_busqueda" class="col-form-label">Valor Total de Remision</label>
              <input type="number" class="form-control" id="valor_remision_for_busqueda">
            </div>

            <div class="form-group col-sm-4">
              <label for="factura_for_busqueda" class="col-form-label">Factura</label>
              <input type="input" class="form-control" id="factura_for_busqueda">
            </div>

            <div class="form-group col-sm-4">
              <label for="fecha_factura_for_busqueda" class="col-form-label">Fecha Factura</label>
              <div class="input-group">
                <input type="date" class="form-control" id="fecha_factura_for_busqueda" aria-label="Text input with dropdown button">
                <div class="input-group-append">
                  <select class="btn btn-outline-secondary dropdown-toggle" id="signo_fecfac_busqueda">
                    <option value="="> = </option>
                    <option value="<">
                      < </option>
                    <option value=">"> > </option>
                    <option value="<>">
                      <>
                    </option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group col-sm-4">
              <label for="valor_for_busqueda" class="col-form-label">Valor Total de Factura</label>
              <input type="number" class="form-control" id="valor_for_busqueda">
            </div>

            <div class="form-group col-sm-12">
              <label for="cufe_for_busqueda" class="col-form-label">CUFE</label>
              <input type="input" class="form-control" id="cufe_for_busqueda">
            </div>

            <div class="form-group col-sm-2">
              <label for="clase_for_busqueda" class="col-form-label">Clase</label>
              <input type="number" class="form-control" id="clase_for_busqueda">
            </div>

            <div class="form-group col-sm-3">
              <label for="tipo_for_busqueda" class="col-form-label">tipo</label>
              <div id="tipo_for_busqueda_content">
                <select class="form-control" id="tipo_for_busqueda">
                  <option value="">Seleccionar...</option>
                  <option value="1">Contado</option>
                  <option value="2">Credito</option>
                  <option value="3">Mayoreo</option>
                </select>
              </div>
            </div>

            <div class="form-group col-sm-3">
              <label for="fuente_for_busqueda" class="col-form-label">Fuente</label>
              <input type="input" class="form-control" id="fuente_for_busqueda">
            </div>

            <div class="form-group col-sm-2">
              <label for="transac_for_busqueda" class="col-form-label">Transac.</label>
              <input type="input" class="form-control" id="transac_for_busqueda">
            </div>

            <div class="form-group col-sm-2">
              <label for="tipo_inv_for_busqueda" class="col-form-label">tipodoc</label>
              <input type="input" class="form-control" id="tipo_inv_for_busqueda">
            </div>

            <div class="form-group col-sm-6">
              <label for="proveedor_for_busqueda" class="col-form-label">Proveedor</label>
              <div id="proveedor_for_busqueda_content">
                <select class="form-control" id="proveedor_for_busqueda"></select>
              </div>
            </div>

            <div class="form-group col-sm-6">
              <label for="valor_factura_for_busqueda" class="col-form-label">Numero orden de compra</label>
              <div id="valor_factura_for_busqueda_content">
                <select class="form-control" id="valor_factura_for_busqueda"></select>
              </div>
            </div>

            <div class="form-group col-sm-6">
              <label for="bodega_for_busqueda" class="col-form-label">Bodega</label>
              <div id="bodega_for_busqueda_content">
                <select class="form-control" id="bodega_for_busqueda"></select>
              </div>
            </div>

            <div class="form-group col-sm-6">
              <label for="factor_cantidad_for_busqueda" class="col-form-label">Factor de Cantidad</label>
              <input type="input" class="form-control" id="factor_cantidad_for_busqueda">
            </div>

            <div class="form-group col-sm-3">
              <label for="fecha_creacion_for_busqueda" class="col-form-label">Fecha Creacion</label>
              <input type="date" class="form-control" id="fecha_creacion_for_busqueda">
            </div>

            <div class="form-group col-sm-3">
              <label for="usuario_creacion_for_busqueda" class="col-form-label">Usuario Creacion</label>
              <input type="input" class="form-control" id="usuario_creacion_for_busqueda">
            </div>

            <div class="form-group col-sm-3">
              <label for="fecha_modificacion_for_busqueda" class="col-form-label">Fecha Modificacion</label>
              <input type="date" class="form-control" id="fecha_modificacion_for_busqueda">
            </div>

            <div class="form-group col-sm-3">
              <label for="usuario_modificacion_for_busqueda" class="col-form-label">Usuario Modificacion</label>
              <input type="input" class="form-control" id="usuario_modificacion_for_busqueda">
            </div>
          </div>
        </form>
        <!-- fin formulario -->
      </div>
    </div>

    <div class="container-fluid" id="container2">
      <h5 class="card-header"><span class="text-center">Productos</span></h5>
      <div class="card-body">
        <div class="table-responsive">
          <form id="detalleform">
            <div class="row">
              <div class="col-sm-12">
                <table id="productos_table_busqueda" class="table table-striped table-bordered dt-responsive" style="width:100%"></table>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
    <div class="container-fluid" id="container3">
      <h5 class="card-header"><span class="text-center">Productos</span></h5>
      <div class="card-body">
        <div class="table-responsive">
          <form id="detalleform">
            <table id="tablaProductos_busqueda" class="table table-hover table-condensed table-bordered table-striped">
              <thead>
                <tr>
                  <th class="center-x" width="20%">Producto</th>
                  <th class="center-x" width="8%">Cantidad Solicitada</th>
                  <th class="center-x" width="8%">Cantidad</th>
                  <th class="center-x" width="8%">Costo Unid</th>
                  <th class="center-x" width="8%">Costo Total </th>
                  <th class="center-x" width="34%">Serie</th>
                </tr>
              </thead>
              <tbody>
                <tr id="agregar_concep_busqueda">
                  <td>
                    <div id="productos_for_busqueda_content">
                      <select class="form-control" id="productos_for_busqueda"></select>
                    </div>
                  </td>
                  <td>
                    <label id="cantidad_solicitada_busqueda"> </label>
                  </td>
                  <td>
                    <input type="text" class="form-control" id="cantidad_series_busqueda" onkeypress="return valideKey(event);">
                  </td>
                  <td>
                    <input type="text" class="form-control" id="costoUnidad_busqueda">
                  </td>
                  <td>
                    <label id="CostoTotal_busqueda"></label>
                  </td>
                  <td>
                    <div id="input-agregar-series-busqueda">
                      <table id="tablaSeries_busqueda" class="table table-hover table-condensed table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="center-x" width="9%">Nro</th>
                            <th class="center-x" width="41%">Nro serie</th>
                            <th class="center-x" width="6%">Accion</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </td>
                  <td id='botonAgregar' class="center-x" style="vertical-align: middle;">
                    <a class="btn btn-xs btn-default" data-toggle="tooltip" title="Agregar" onclick="agregarListaProductoUpdate();">
                      <span class="fa fa-plus"></span>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>


    <!-- INICIO MODAL -->
    <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel">
      <div id="modalResumenCuentas">
        <h5 class="card-header"><span class="text-center">Entradas</span></h5>
        <div class="card-body">
          <div class="table-responsive">
            <form id="detalleform">
              <div class="row">
                <div class="col-sm-12">
                  <table id="resumenCuentas_table" class="table table-striped table-bordered dt-responsive" style="width:100%"></table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel">
      <div id="modalSeriesBusqueda">
        <div>
          <div class="card-body">
            <div class="table-responsive">
              <form id="modalForm">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="series_table" class="table table-striped table-bordered dt-responsive" style="width:100%"></table>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- FIN MODAL -->



<?php
  }
}
?>