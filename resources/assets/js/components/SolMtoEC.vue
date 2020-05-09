<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i>Ejecución Mantenimiento Equipos de Computo.
        <!-- <md-button
              class="md-dense md-raised color='rgba(52, 139, 64, 0.849)' "
              @click="mostrarDetalle()"
              title="Nuevo"
            >
              <i class="material-icons Color2">add</i>
            Nuevo</md-button> -->
<!--      
          <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button> -->
            <!-- <md-button
              class="md-icon-button md-primary"
              @click="eliminarDetalle(index)"
              title="Eliminados"
            >
              <i class="material-icons Color4">delete_outline</i>
            </md-button> -->
            <button v-show="del==1"
            title="Eliminados"
            type="button"
            @click="abrirModal5()"
            class="btn btn-danger btn-sm"
          >
            <i class="fas fa-trash-alt"></i>&nbsp;
          </button>
        </div>
        <template v-if="listado==1">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr class="p-3 mb-2 bg-dark text-white">
                    <th>Tipo Oficina</th>
                    <th>Fecha Realización</th>
                    <th>Fecha Finalización</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="objeto in arrayDatos" :key="objeto.id">                                     
                    <td v-text="objeto.nombre"></td>
                    <td v-text="objeto.fec_realiza"></td>
                    <td v-text="objeto.fec_finaliza"></td>
                    <td>       
                      <template v-if="objeto.tp_mto==1">
                        <span class="badge badge-secondary">Preventivo</span>
                      </template>
                      <template v-else>
                        <span class="badge badge-danger">Correctivo</span>
                      </template>
                    </td>
                    <td>
                      <template v-if="objeto.edo==0">
                        <span class="badge badge-primary">Programado</span>
                      </template>
                      <template v-if="objeto.edo==1">
                        <span class="badge badge-warning">En Ejecución</span>
                      </template>
                      <template v-if="objeto.edo==2">
                        <span class="badge badge-success">Finalizado</span>
                      </template>
                      <template else v-if="objeto.edo==3">
                        <span class="badge badge-dark">Reprogramado</span>
                      </template>
                    </td>
                    <td>
                       <md-button
                        class="md-icon-button"
                        @click="mostrarActualizar(objeto)"
                        title="Ejecutar"
                      >
                        <i class="material-icons Color3">assignment</i>
                      </md-button>
                      <md-button
                        class="md-icon-button md-primary"
                        @click="eliminarActE(objeto)"
                        title="Eliminar"
                      >
                        <i class="material-icons Color4">delete</i>
                      </md-button>
                    </td>
                  </tr>
                </tbody>
              </table>
          <nav>
            <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"
                >Ant</a>
              </li>
              <li
                class="page-item"
                v-for="page in pagesNumber"
                :key="page"
                :class="[page == isActived ? 'active' : '']"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="cambiarPagina(page,buscar,criterio)"
                  v-text="page"
                ></a>
              </li>
              <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"
                >Sig</a>
              </li>
            </ul>
          </nav>
            </div>
          </div>
        </template>
        <template v-else-if="listado==0">
        <md-tabs>
          <md-tab id="tab-home" md-label="Detalle" md-icon="assignment">
            <h5>Mantenimiento Oficina {{this.nomOficina}}</h5>
                   <div class="md-layout">
                  <div class="table-responsive col-md-12">
                    <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                        <th>Serial</th>                        
                        <th>Tp Equipo</th>                        
                        <th>Nombre</th>                        
                        <th>Responsable</th>                        
                        <th>Opciones</th>
                        </tr>
                      </thead>
                       <tbody v-if="arrayDetM.length">
                      <tr
                        v-for="(objeto, index) in arrayDetM"
                        :key="`objeto-${index}`"
                      >                        
                        <td v-text="objeto.serial"></td>
                        <td v-text="objeto.tpEquipo"></td>
                        <td v-text="objeto.desc"></td>
                        <td v-text="objeto.respo"></td>
                        <td>
                          <md-button class="md-icon-button md-primary " @click="mostrarDetalle(objeto)" title="Ejecutar Mantenimiento">
                            <i class="material-icons Color3">assignment_turned_in</i>
                          </md-button>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="5">
                          NO hay Equipos asociados a la Oficina
                        </td>
                      </tr>
                    </tbody>
                    </table>
                </div>
                  </div>
                    <div class="modal-footer">
                      <md-card-actions>
                        <md-button type="button" class="md-raised" @click="ocultarDetalle2()">Cerrar</md-button>
                      </md-card-actions>
                    </div>

          </md-tab>
          <md-tab id="tab-pages" md-label="Historial" md-icon="pages"></md-tab>

        </md-tabs>          
        </template>

         <template v-if="listado==2">

              <div class="card-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <md-card-content>
             <h6>
                Categoría 
                <small class="text-muted">{{tpEquipo}}</small>
              </h6>
             <h6>
                Modelo 
                <small class="text-muted">{{nomModelo}}</small>
              </h6>
             <h6>
                Detalle 
                <small class="text-muted">{{nomEquipo}}</small>
              </h6>
                <div class="table-responsive col-md-12">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Actividad</th>                        
                        <th>Descripción</th>                        
                        <th>Opciones</th>
                      </tr>
                      <!-- <md-button class="md-icon-button md-primary" @click="abrirModal5">
                        <md-icon>post_add</md-icon>
                      </md-button> -->
                    </thead>
                    <tbody v-if="arrayDetAct.length">
                      <tr
                        v-for="(objeto, index) in arrayDetAct"
                        :key="`objeto-${index}`"
                      >                        
                        <td v-text="objeto.nomAct"></td>
                        <td v-text="objeto.observacion"></td>
                        <td>
                          <md-button class="md-icon-button md-primary " @click="eliminarMpio(objeto)" title="Eliminar">
                            <i class="material-icons Color4">delete</i>
                          </md-button>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="5">
                          NO hay Actividades asociados al Equipo
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              <div class="md-layout">
                <md-field :class="getValidationClass('obs')">
                  <label>Observación</label>
                  <md-textarea v-model="obs"></md-textarea>
                  <md-icon>description</md-icon>
                    <span
                      class="md-error"
                      v-if="!$v.obs.required"
                    >Olvidaste ingresar el trabajo realizado
                    </span>
                </md-field>
              </div>
              </md-card-content>
            </form>
          </div>
          <div class="modal-footer">
            <md-card-actions>
              <md-button type="button" class="md-raised" @click="ocultarDetalle()">Cerrar</md-button>
            </md-card-actions>

            <md-card-actions>
              <md-button
                type="submit"
                v-if="tipoAccion==1"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="validarDatos()"
              >Guardar</md-button>
              <md-button
                type="submit"
                v-if="tipoAccion==2"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="actualizarM()"
              >Actualizar</md-button>
            </md-card-actions>

          </div>
         </template>  
      </div>

      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="Nombre">Documento</option>
                    <option value="Descripción">Nombre Técnico</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keypress="getPerso(1, buscar, this.criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
                  <button
                    type="submit"
                    @click="getPerso(1, buscar, this.criterio)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Documento</th>
                    <th>Nombre Técnico</th>
                    <th>Selección</th>
                  </tr>
                </thead>
                <tbody v-if="arrayPerso.length">
                  <tr v-for="(objeto, index)  in arrayPerso" :key="`objeto-${index}`">
                    <td v-text="objeto.id"></td>
                    <td v-text="objeto.nombreFull"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarTecnico(objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>                         
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Actividades asignadas al equipo</td>
                  </tr>
                </tbody>
              </table>
            </div>
              <nav>
                <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaTec(pagination.current_page - 1,buscar,criterio)"
                    >Ant</a>
                  </li>
                  <li
                    class="page-item"
                    v-for="page in pagesNumber"
                    :key="page"
                    :class="[page == isActived ? 'active' : '']"
                  >
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaTec(page,buscar,criterio)"
                      v-text="page"
                    ></a>
                  </li>
                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaTec(pagination.current_page + 1,buscar,criterio)"
                    >Sig</a>
                  </li>
                </ul>
              </nav>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal-dialog -->

    <!-- segunda ventana modal equipos etapas -->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal2}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal2()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="Serial">Serial</option>
                    <option value="Modelo">Modelo</option>
                    <option value="Nombre">Nombre</option>
                    <option value="Descripción">Descripción</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keypress="listarExEtapa(1, buscar, criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
                  <button
                    type="submit"
                    @click="listarExEtapa(1, buscar, criterio)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>TAG</th>
                    <th>Serial</th>
                    <th>Modelo</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                  </tr>
                </thead>
                <tbody v-if="arrayAct.length">
                  <tr v-for="(etapa, index)  in arrayEquipo" :key="`etapa-${index}`">
                    <td>
                      <button
                        type="button"
                        @click="agregarDetalleModal2(etapa)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                    <td v-text="etapa.tag"></td>
                    <td v-text="etapa.serial"></td>
                    <td v-text="etapa.modelo"></td>
                    <td v-text="etapa.nomequipo"></td>
                    <td v-text="etapa.desc"></td>
                  </tr>
              </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Insumos asignados al equipo</td>
                  </tr>
                </tbody>
              </table>
              <nav>
                <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(pagination.current_page - 1,buscar,criterio)"
                    >Ant</a>
                  </li>
                  <li
                    class="page-item"
                    v-for="page in pagesNumber"
                    :key="page"
                    :class="[page == isActived ? 'active' : '']"
                  >
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(page,buscar,criterio)"
                      v-text="page"
                    ></a>
                  </li>
                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(pagination.current_page + 1,buscar,criterio)"
                    >Sig</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal2()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!--Fin del modal-->

        <!-- Tercera ventana modal Actividades equipos  -->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal3}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal3()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="Nombre">Nombre</option>
                    <option value="Descripción">Descripción</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keypress="listarActE(1, buscar, criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
                  <button
                    type="submit"
                    @click="listarActE(1, buscar, criterio)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Actividad</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="arrayAct.length">
                  <tr v-for="(objeto, index)  in arrayAct" :key="`objeto-${index}`">
                    <td v-text="objeto.desc"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarDetAct(objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>                         
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Actividades asignadas al equipo</td>
                  </tr>
                </tbody>
              </table>
              <nav>
                <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(pagination.current_page - 1,buscar,criterio)"
                    >Ant</a>
                  </li>
                  <li
                    class="page-item"
                    v-for="page in pagesNumber"
                    :key="page"
                    :class="[page == isActived ? 'active' : '']"
                  >
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(page,buscar,criterio)"
                      v-text="page"
                    ></a>
                  </li>
                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(pagination.current_page + 1,buscar,criterio)"
                    >Sig</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal3()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
            <!-- Tercera ventana modal Insumos equipos  -->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal4}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal4()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="Nombre">Nombre</option>
                    <option value="Descripción">Descripción</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keypress="listarInsE(1, this.idRefE, criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
                  <button
                    type="submit"
                    @click="listarInsE(1, this.idRefE, criterio)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Actividad</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="arrayIns.length">
                  <tr v-for="(objeto, index)  in arrayIns" :key="`objeto-${index}`">
                    <td v-text="objeto.nombre"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarDetIns(objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>                         
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5">NO hay Insumos asignados al equipo</td>
                  </tr>
                </tbody>
              </table>
              <nav>
                <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(pagination.current_page - 1,buscar,criterio)"
                    >Ant</a>
                  </li>
                  <li
                    class="page-item"
                    v-for="page in pagesNumber"
                    :key="page"
                    :class="[page == isActived ? 'active' : '']"
                  >
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(page,buscar,criterio)"
                      v-text="page"
                    ></a>
                  </li>
                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaE(pagination.current_page + 1,buscar,criterio)"
                    >Sig</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal4()">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
       <!-- Tercera ventana modal Actividades equipos  -->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal5}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
    <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button
              type="button"
              class="close"
              @click="cerrarModal5()"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-9">
                <div class="input-group">
                  <!-- <select
                    class="form-control col-md-4"
                    v-model="idTpEquipo"
                    @change="listarExEtapa(1, this.idTpEquipo,criterio )"
                  >
                    <option
                      v-for="objeto in arrayTpEquipo"
                      :key="objeto.id"
                      :value="objeto.id"
                      >{{ objeto.nombre }}</option
                    >
                  </select> -->
                  <!-- <input
                    type="text"
                    v-model="criterio"
                    @keypress="listarExEtapa(1,this.idTpEquipo,criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  > -->
                  <button
                    type="submit"
                    @click="listarExEtapa(1, this.idTpEquipo,criterio)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>Tp Equipo</th>
                    <th>Nombre</th>
                    <th>Responsable</th>
                    <th>Selección</th>
                  </tr>
                </thead>
                <tbody v-if="arrayDel.length">
                  <tr
                    v-for="(objeto, index) in arrayDel"
                    :key="`objeto-${index}`"
                  >
                    <td v-text="objeto.serial"></td>
                    <td v-text="objeto.tpEquipo"></td>
                    <td v-text="objeto.desc"></td>
                    <td v-text="objeto.respo"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarEquipo(index,objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>       
                    {{this.del=0}}             
                    <td colspan="5">NO hay Equipos registrados en esta Categoria.</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <nav>
              <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="
                      cambiarPaginaM(
                        pagination.current_page - 1,
                        buscar,
                        criterio
                      )
                    "
                    >Ant</a
                  >
                </li>
                <li
                  class="page-item"
                  v-for="page in pagesNumber"
                  :key="page"
                  :class="[page == isActived ? 'active' : '']"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPaginaM(page, buscar, criterio)"
                    v-text="page"
                  ></a>
                </li>
                <li
                  class="page-item"
                  v-if="pagination.current_page < pagination.last_page"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="
                      cambiarPaginaM(
                        pagination.current_page + 1,
                        buscar,
                        criterio
                      )
                    "
                    >Sig</a
                  >
                </li>
              </ul>
            </nav>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="cerrarModal5()"
            >
              Cerrar
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </main>
</template>

<script>
import format from "date-fns/format";

import vSelect from "vue-select";

import { validationMixin } from "vuelidate";
import {
  MdButton,
  MdContent,
  MdField,
  MdCard,
  MdMenu,
  MdList,
  MdDatepicker,
  MdSteppers
} from "vue-material/dist/components";

Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdList);
Vue.use(MdDatepicker);
Vue.use(MdSteppers);

import { required, minLength } from "vuelidate/lib/validators";
import { MdAutocomplete } from 'vue-material/dist/components';

export default {
  mixins: [validationMixin],

  data() {
    let dateFormat = this.$material.locale.dateFormat || "yyyy-MM-dd";
    let now = new Date();
    return {
      active: "first",



      form: {
        descripcion: ""
      },

      tipoAccion: 1,
      fecR: format(now, dateFormat),
      fecF: format(now, dateFormat),
      listado: 1,
      sending: false,
      // variables Mto Estacion

      tpMto: 1,
      del: 0,
      frec: 0,
      idRefE:0,
      idTec:0,
      idRespo:0,

      idOficina: 0,
      idEquipo: 0,
      idEstacion: 0,

      idEtapa: 0,
      idMto: 0,
      idTrenEtapa: 0,
      idproveedor: 0,
      idMarca: 0,
      tpTren:0,
      nomOficina: "",
      nomEquipo: "",
      tpEquipo: "",
      nomModelo: "",
      obs: "",
      serial: "",
      modelo: "",

      fecInstala: "",
      descripcion: "",

      // array Mto Estacion
      
      arrayTpMto: [{id: 1, name:"PREVENTIVO"},{id: 2 ,name:"CORRECTIVO"}],      
      arrayFrec: [{id:0 ,name:"INMEDIATO"},{id:1 ,name:"1 MES"},{id:2 ,name:"2 MESES"},{id:3 ,name: "3 MESES"},{id:4 ,name:"4 MESES"},{id:6 ,name:"6 MESES"},{id:9 ,name:"9 MESES"},{id:12 ,name:"12 MESES"},{id:18 ,name:"18 MESES"},{id:24 ,name:"24 MESES"},{id:36 ,name:"36 MESES"}],
  

      arrayMtoAct: [],
      arrayPerso: [],
      arrayTec: [],
      arrayDatos: [],


      arrayDel: [],
      arrayDetAct: [],
      arrayIns: [],
      arrayAct: [],
      arrayOficina: [],
      arrayNomEstacion: [],
      arrayDetM: [],
      arrayDetMAct: [],
      arrayEtapa: [],
      arrayEquipo: [],   
      arrayMarca: [],
      modal: 0,
      modal2: 0,
      modal3: 0,
      modal4: 0,
      modal5: 0,
      idTpEquipo: "",
      bDetEtapa: 1,
      bVerE: 0,
      bVerA: 0,
      bEtapa: null,
      textoEtapa: "",
      tituloModal: "",
      tipoAccion: 0,

      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3,
      criterio: "nomref",
      buscar: ""
    };
  },
  components: {
    vSelect
  },
  validations: {

  
      obs: {
        required
      }
    
  },

  computed: {
    type() {
      if (
        typeof this.dynamicByModel === "object" &&
        this.dynamicByModel instanceof Date &&
        isValid(this.dynamicByModel)
      ) {
        return "date";
      } else if (typeof this.dynamicByModel === "string") {
        return "string";
      } else if (
        Number.isInteger(this.dynamicByModel) &&
        this.dynamicByModel >= 0
      ) {
        return "number";
      } else if (this.model === null || this.model === undefined) {
        return "null";
      } else {
        throw new Error("Type error");
      }
    },
    mdType() {
      switch (this.mdTypeValue) {
        case "date":
          return Date;
        case "string":
          return String;
        case "number":
          return Number;
      }
    },
    dateFormat() {
      return this.$material.locale.dateFormat || "yyyy-MM-dd";
    },
    isActived: function() {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  methods: {
    toString() {
      this.toDate();
      this.dynamicByModel =
        this.dynamicByModel && format(this.dynamicByModel, this.dateFormat);
    },
    toDate() {
      switch (this.type) {
        case "string":
          this.dynamicByModel = parse(
            this.dynamicByModel,
            this.dateFormat,
            new Date()
          );
          break;
      }
    },

    abrirModal() {
      this.modal = 1;
      this.tituloModal = "Seleccione una o varios Técnicos";
      this.getPerso(1,this.buscar, this.criterio);
    },
    abrirModal2() {
      this.modal2 = 1;
      this.tituloModal = "Seleccione uno o varios Equipos";
    },
    abrirModal3(data = []) {
      this.idRefE=data["idref"];
      this.modal3 = 1;
      this.tituloModal = "Seleccione una o varias Actividades";
      this.listarActE(1, this.buscar, this.criterio);
    },
    abrirModal4(data = []) {
      this.idRefE=data["idRefE"];
      this.modal4 = 1;
      this.tituloModal = "Seleccione una o varios Insumos";
      this.listarInsE(1, this.idRefE, this.criterio);
    },
    abrirModal5() {
      // this.idRefE=data["idref"];
      this.modal5 = 1;
      this.tituloModal = "Restaure uno o varios Equipos";
      // this.getPerso(1,this.buscar, this.criterio);
    },
    regEquiposPpal(data = []) {
      this.textoEtapa = data["nombre"];
      this.idEtapa =data["id"];
      this.tpTren =0;
      this.bEtapa = 1;
      this.bDetEtapa = 0;
      this.getExEtapa();
    },
    regEquiposByPass(data = []) {
      this.textoEtapa = data["nombre"];
      this.idEtapa =data["id"];
      this.tpTren =1;
      this.bEtapa = 0;
      this.bDetEtapa = 0;
      this.getExEtapa1();
    },
        getOficina() {
      let me = this;

      var url = "/oficina/selectOficina";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayOficina = respuesta.oficina;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarDetalle() {
      let me = this;
      var url =
        "/detmtoec?page=" +
        1 +
        "&buscar=" +
        this.idMto ;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDetM = respuesta.refe.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarDetAct() {
      let me = this;
      var url =
        "/detactequipo/actE?page=" +
        1 +
        "&buscar=" +
        this.idEquipo ;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDetAct = respuesta.actividad.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    verEquipos(data = []) {
      this.bVerE=1;
      this.textoEtapa = data["nombre"];
      this.idEtapa =data["id"];
      this.bEtapa = null;
      this.bDetEtapa = null;
      this.getEqMto();
      // this.getExEtapa();
      // this.getExEtapa1();
    },
    verAct(data = []) {
      this.bVerA=1;
      this.bVerE=null;
      this.textoEtapa = data["nombre"];
      this.idRefE =data["idref"];
      this.bEtapa = null;
      this.bDetEtapa = null;
    },
    atras() {
      this.arrayTrenPpal=[];
      this.arrayTrenByPass=[];
      this.bEtapa = null;
      this.bVerE = null;
      this.bVerA = null;
      this.bDetEtapa = 1;
    },
    // ir a seleccion de mantenimientos
    atrasMnt() {
      // this.arrayTrenPpal=[];
      // this.arrayTrenByPass=[];
      this.bEtapa = null;
      this.bVerE = 1;
      this.bVerA = null;
      this.bDetEtapa = null;
    },
    cerrarModal() {
      this.modal = 0;
      this.demo = 0;
      this.tituloModal = "";
    },
    cerrarModal2() {
      this.modal2 = 0;
      this.tituloModal = "";
    },
    cerrarModal3() {
      this.modal3 = 0;
      this.tituloModal = "";
    },
    cerrarModal4() {
      this.modal4 = 0;
      this.tituloModal = "";
    },
    cerrarModal5() {
      this.modal5 = 0;
      this.tituloModal = "";
    },
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayEtapas.length; i++) {
        if (this.arrayEtapas[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    encuentra2(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayMtoPpal.length; i++) {
        if (this.arrayMtoPpal[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    encuentra3(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetM.length; i++) {
        if (this.arrayDetM[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    encuentra4(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayMtoAct.length; i++) {
        if (this.arrayMtoAct[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    encuentra5(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayTec.length; i++) {
        if (this.arrayTec[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    setTecnico(id){
      swal({
      title: 'Esta seguro de Asignar al Técnico como Responsable?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar!',
      cancelButtonText: 'Cancelar',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false,
      reverseButtons: true
      }).then((result) => {
      if (result.value) {
          let me = this;
          
          me.arrayTec[id].Rol = 1;          
      } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
      ) {
          
      }
      }) 
        },
      unsetTecnico(id){
        swal({
        title: 'Esta seguro de Asignar al Técnico como Auxiliar?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            let me = this;
            
            me.arrayTec[id].Rol = 0;          
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            
        }
      }) 
        },
    agregarTecnico(data = []) {
      let me = this;
      if (me.encuentra5(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "El Técnico seleccionado ya se encuentra agregado!"
        });
      } else {
          me.arrayTec.push({
          id: data["id"],
          nombre: data["nombreFull"],
          Rol: 0
        });
      } 
    },
    agregarDetalleModal(data = []) {
      let me = this;

      if (me.encuentra(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "La Etapa seleccionada ya se encuentra agregada!"
        });
      } else {
          me.arrayEtapas.push({
          id: data["id"],
          nombre: data["nombre"],
          desc: data["desc"]
        });
      }
    },
    agregarDetAct(data = []) {
      let me = this;

      if (me.encuentra4(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "La Actividad seleccionada ya se encuentra agregada!"
        });
      } else {
          me.arrayMtoAct.push({
          id: data["id"],
          idRefE: data["idRef"],          
          nombre: data["nombre"],
          desc: data["desc"]
        });
          me.mensaje("Agregar", "Agrego ");
      }
    },
      agregarEquipo(index, data = []) {
      let me = this;
      if (me.encuentra3(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "El Equipo seleccionado ya se encuentra agregado!"
        });
      } else {
        me.arrayDetM.push({
            id: data["id"], 
            tpEquipo:data["tpEquipo"],
            serial: data["serial"],
            respo: data["respo"],
            desc: data["desc"]
        });
      me.arrayDel.splice(index, 1);
      }
    },
    agregarDetalleMto(data = []) {
      let me = this;
      if(this.tpTren==0){
        if (me.encuentra2(data["idequipo"])) {
            swal({
              type: "error",
              title: "Error...",
              text: "El equipo seleccionado ya se encuentra agregada!"
          });
        } else{
            me.arrayMtoPpal.push({
            id: data["idequipo"], 
            idref:data["idref"],
            tag: data["tag"],
            serial: data["serial"],
            modelo: data["modelo"],
            nomequipo: data["nombre"],
            desc: data["desc"]
          });
          me.arrayTrenEquipos.push({
          id: data["id"],
          id_equipo: data["idequipo"],
          tp_tren: 0
        });
            me.mensaje("Agregar", "Agrego ");
          }
      }
      else {
        if (me.encuentra3(data["idequipo"])) {
          swal({
          type: "error",
          title: "Error...",
          text: "El equipo seleccionado ya se encuentra agregada!"
        });
      } else{
          me.arrayMtoByPass.push({
          id: data["idequipo"],
          tag: data["tag"],
          serial: data["serial"],
          modelo: data["modelo"],
          nomequipo: data["nombre"],
          desc: data["desc"]
    });
           me.arrayTrenEquipos.push({
          id: data["id"],
          id_equipo: data["idequipo"],
          tp_tren: 1
        });
        me.mensaje("Agregar", "Agrego ");
        }        
        }
    },

    getValidationClass(fieldName) {
      const field = this.$v[fieldName];
      if (field) {
        return {
          "md-invalid": field.$invalid && field.$dirty
        };
      }
    },
    validarDatos() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        this.registrarEquiposEs();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
      this.form.descripcion = null;
    },
    listarMto(page, buscar, criterio) {
      let me = this;
      var url =
        "/mtoec?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDatos = respuesta.mto.data;          
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarEtapa(page, buscar, criterio) {
      let me = this;
      var url =
        "/etapa?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEtapa = respuesta.etapa.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarActE(page, buscar, criterio) {
      let me = this;
      var url =
        "/detactequipo/actE?page=" + page + "&buscar=" + this.idRefE + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayAct = respuesta.actividad.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarInsE(page, buscar, criterio) {
      let me = this;
      var url =
        "/detinsumo/insumose?page=" + page + "&buscar=" +  this.idRefE + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayIns = respuesta.insumose.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarEquipo(page, buscar, criterio) {
      let me = this;
      var url =
        "/equipo?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEquipo = respuesta.equipo.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarExEtapa(page, buscar, criterio) {
      let me = this;
      var url =
        "/equipo/exetapa?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEquipo = respuesta.equipo.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    // opcion  seleccion en el select
      getPerso(page, buscar, criterio) {
      let me = this;

      var url = "/persona/selectTecnico?page=" + page + "&buscar=" + buscar;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayPerso = respuesta.perso.data;
          me.pagination = respuesta.pagination;

        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getEtapas() {
      let me = this;
      var url = "/detequipoestacion/etapas/?buscar=" + this.idEstacion;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEtapas = respuesta.etapa;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    // Traer equipos tren principal
    getExEtapa() {
      let me = this;
      var url = "/detequipoestacion/ppal/?buscar=" + this.idEtapa + '&estacion='+ this.idEstacion;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayTrenPpal= respuesta.equipo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getEqMto() {
      let me = this;
      var url = "/detmtoes/?buscar=" + this.idMto;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayMtoPpal= respuesta.equipo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    // traer equipos tren Bypass
    getExEtapa1() {
      let me = this;
      var url = "/detequipoestacion/bypass/?buscar=" + this.idEtapa + '&estacion='+ this.idEstacion;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayTrenByPass= respuesta.equipo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getTpEstacion() {
      let me = this;

      var url = "/tpestacion/selectTpEstacion";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTpEstacion = respuesta.tpestacion;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getEstacion() {
      let me = this;
      var url = "/estacion/selectEstacion?buscar=" + this.idOficina;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEstacion = respuesta.estacion;
        })
        .catch(function(error) {
          console.log(error);
        });
        
    },
    getNomEstacion() {
      this.getEtapas();
      let me = this;
      var url = "/estacion/selectNomEstacion?buscar=" + this.idEstacion;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayNomEstacion = respuesta.estacion;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getEtapa() {
      let me = this;

      var url = "/etapa/selectEtapa";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayEtapas = respuesta.etapa;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    getTrenEtapa() {
      let me = this;
      var url = "/trenetapa/selectTrenEtapa/?buscar=" + this.idEtapa;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayTrenEtapa = respuesta.trenetapa;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    mostrarActualizar(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.idMto = data["idMto"]),     
      this.listarDetalle(),
      (this.nomOficina = data["nombre"]);    


    },
    mostrarDetalle(data = []) {
      let me = this;
      (this.tipoAccion = 1), (me.listado = 2);
       (this.nomEquipo = data["desc"]);   
       (this.tpEquipo = data["tpEquipo"]);   
       (this.nomModelo = data["modelo"]);   
       (this.idEquipo = data["idRef"]);   
        this.listarDetAct();
    },
    ocultarDetalle() {
      this.listado = 0;
    },
    ocultarDetalle2() {
      this.listado = 1;
    },

    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarEstacion(page, buscar, criterio);
    },
    cambiarPaginaE(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarEtapa(page, buscar, criterio);
    },
    cambiarPaginaTec(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.getPerso(page, buscar, criterio);
    },
    listarEstacion(page, buscar, criterio) {
      let me = this;
      var url =
        "/detequipoestacion/estacion?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEstacion = respuesta.estacion.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    registrarEquiposEs() {
      let me = this;
            axios
          .post("/mtoec/registrar", {
          idOficina: this.idOficina,
            fec_realiza: this.fecR,
            fec_finaliza: this.fecF,
            obs: this.descripcion,
            tp_mto: this.tpMto,
            frec: this.frec,
            data: this.arrayTec,
            data2: this.arrayDetM

          })
          .then(function(response) {

            me.mensaje("Guardado", "Guardo ");
          })
          .catch(function(error) {
            console.log(error);
          });

    
    },
    actualizarEstacion() {
      let me = this;

      axios
        .put("/estacion/actualizar", {
          idOficina: this.idOficina,
          nombre: this.form.nombre,
          descripcion: this.form.descripcion,
          id: this.estacion_id
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarEstacion(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarEquipo(data = []) {
      swal({
        title: "Esta seguro de Eliminar la Estación " + data["nombre"],
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          let me = this;
          this.estacion_id = data["id"];
          axios
            .post("/estacion/eliminar", {
              id: this.estacion_id
            })
            .then(function(response) {
              me.ocultarDetalle();
              me.listarEstacion(1, "", "nombre");
              me.mensaje("Eliminado", "Eliminó ");
            })
            .catch(function(error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    eliminarDetalle(index,data=[]){
      let me = this;
      this.del=1;
      me.arrayDetM.splice(index, 1);
      me.arrayDel.push({
            id: data["id"], 
            tpEquipo:data["tpEquipo"],
            serial: data["serial"],
            respo: data["respo"],
            desc: data["desc"]
      
    });
    },
    mensaje(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    }
  },

  mounted() {
    this.getPerso(1,this.buscar, this.criterio);
    this.listarMto(1,this.buscar, this.criterio);
      this.getOficina();
    // this.getEtapa();
    // this.listarExEtapa(1, this.buscar, this.criterio);
  }
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
.material-icons.Color1 { color: rgb(31, 33, 34); }
.material-icons.Color2 { color: rgba(52, 139, 64, 0.849); }
.material-icons.Color3 { color: rgb(31, 114, 134); }
.material-icons.Color4 { color: rgb(248, 53, 46); }

</style>
