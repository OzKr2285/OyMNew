<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i>Requerimiento de Insumos
          <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <div class="card-body">
          <template v-if="listado==1">
            <div class="md-layout">
              <div class="md-layout-item">
                <br />
                <md-button class="md-icon-button md-dense md-raised md-primary" @click="listarReq(1,buscar,criterio)">
                  <md-icon>search</md-icon>
                </md-button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr class="p-3 mb-2 bg-dark text-white">
                    <th>N°</th>
                    <th>Mto N°</th>
                    <th>Técnico</th>
                    <th>Observación</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="objeto in arrayDatos" :key="objeto.id">
                    <td v-text="objeto.id"></td>
                    <td v-text="objeto.cod_estacion"></td>
                    <td v-text="objeto.nombreFull"></td>
                    <td v-text="objeto.obs"></td>
                    <td v-text="objeto.fec_solicitud"></td>
                    <td>
                    <template v-if="objeto.edo==0">
                      <span class="badge badge-warning">Solicitado</span>
                    </template>
                    <template v-if="objeto.edo==1">
                      <span class="badge badge-success">Disponible</span>
                    </template>
                    <template v-if="objeto.edo==2">
                      <span class="badge badge-dark">Entregado</span>
                    </template>
                  </td>
                    <td>
                    <md-button class="md-icon-button " @click="mostrarActualizar(objeto)" title="Actualizar">                         
                      <i class="material-icons Color3">visibility</i>
                    </md-button>
                    <md-button class="md-icon-button md-primary " @click="eliminarEtapa(objeto)" title="Eliminar">
                      <i class="material-icons Color4">delete</i>
                    </md-button>
                    </td>
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
          </template>
          <template v-else-if="listado==0">
            <div class="card-body">
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">
                <md-card-content>
                    <h6>
                      N° 
                      <small class="text-muted">{{this.idReq}}    </small>                      
                    </h6>
                    <h6>
                      Técnico 
                      <small class="text-muted">{{this.nombreTec}}    </small>                      
                    </h6>
                    <h6>
                      N° Mantenimiento  
                      <small class="text-muted">{{this.codMto}}    </small>                      
                    </h6>
                    <h6>
                      Fecha Solicitud  
                      <small class="text-muted">{{this.fecS}}    </small>                      
                    </h6>
                    <h6>
                      Observación 
                      <small class="text-muted">{{this.obs}}    </small>                      
                    </h6>             
              
                  <div class="md-layout">
                    <md-field md-clearable :class="getValidationClass('nombre')">
                      <label for="first-name">Observación</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="obs"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.nombre.required"
                      >El nombre de la Etapa es requerido</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>
                  <div class="md-layout-item">
                  <md-datepicker
                      v-model="fecE"
                      value="fecE"                  
                      md-immediately
                      :md-model-type="String"
                    >
                    <label>Fecha de Entrega</label>
                  </md-datepicker>
              </div>
                </md-card-content>
                        <div class="table-responsive col-md-12">
                    <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Código</th>
                          <th>Nombre</th>
                          <th>Cantidad</th>
                          <th>Unidad</th>
                          <th>Estado</th>
                          <th>Fecha Entrega</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody v-if="arrayReqIns.length">
                        <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                        <tr v-for="(detalle, index) in arrayReqIns" :key="`detalle-${index}`">
                          <td v-text="detalle.codigo"></td>
                          <td v-text="detalle.nombre"></td>
                          <td v-text="detalle.cant"></td>
                          <td v-text="detalle.und_med"></td>
                          <td>
                            <template v-if="detalle.edo==0">
                              <span class="badge badge-warning">Solicitado</span>
                            </template>
                            <template v-if="detalle.edo==1">
                              <span class="badge badge-success">Disponible</span>
                            </template>
                            <template v-if="detalle.edo==2">
                              <span class="badge badge-dark">Entregado</span>
                            </template>
                          </td>
                          <td v-text="detalle.fec_entrega"></td>

                          <td>   
                            <md-button class="md-icon-button md-primary " @click="actReqIns(detalle)" title="Eliminar">
                              <i class="material-icons Color3">verified_user</i>
                            </md-button>                      
                            <!-- <md-button class="md-icon-button md-primary " @click="eliminarInsumo(index)" title="Eliminar">
                              <i class="material-icons Color4">delete</i>
                            </md-button>                       -->
 
                          </td>
                        </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td colspan="7">NO existen Insumos asociados, realice la solicitud a bodega</td>
                        </tr>
                      </tbody>
                    </table>
             
                  <div class="md-layout"></div>
                  </div>
             
                  <div class="md-layout"></div>
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
                  @click="actualizarEtapa()"
                >Actualizar</md-button>
              </md-card-actions>
            </div>
          </template>
        </div>

        <!-- Fin ejemplo de tabla Listado -->
      </div>
    </div>

    <!--Inicio del modal agregar/actualizar-->

    <!-- /.modal-dialog -->

    <!--Fin del modal-->
  </main>
</template>

<script>
import format from "date-fns/format";
import { validationMixin } from "vuelidate";
import {
  MdButton,
  MdContent,
  MdField,
  MdCard,
  MdMenu,
  MdList
} from "vue-material/dist/components";

// import VueMaterial from 'vue-material'
// Vue.use(VueMaterial)
Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdList);
import { required, minLength } from "vuelidate/lib/validators";


export default {
  mixins: [validationMixin],
  name: "Etapa",

  data() {
    let dateFormat = this.$material.locale.dateFormat || "yyyy-MM-dd";
    let now = new Date();
    return {
      form: {
        nombre: "",
        descripcion: ""
      },
      demo: 0,
      tipoAccion: 1,
      listado: 1,
      sending: false,
      idEtapa: 0,
      estacion_id: 0,
      idReq: 0,
      nombreTec: 0,
      obs: 0,
      fecS: 0,
      codMto: 0,
      fecE: format(now, dateFormat),
      arrayCriterio: ["Nombre", "Desc"],
      arrayDatos: [],
      arrayEtapa: [],
      arrayEstacion: [],
      arrayReqIns: [],
      modal: 0,
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
      criterio: "Nombre",
      buscar: ""
    };
  },

  validations: {
    form: {
      nombre: {
        required
      },
      descripcion: {
        required
      }
    }
  },

  computed: {
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
    getValidationClass(fieldName) {
      const field = this.$v.form[fieldName];
      if (field) {
        return {
          "md-invalid": field.$invalid && field.$dirty
        };
      }
    },
    validarDatos() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        this.registrarEtapa();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
      this.form.descripcion = null;
    },

    mostrarActualizar(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);

      this.idReq = data["id"];
      this.nombreTec = data["nombreFull"];
      this.obs = data["obs"];
      this.fecS = data["fec_solicitud"];
      this.codMto = data["cod_estacion"];
      this.getReqIns();
    },
    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
    },
    listarReq(page, buscar, criterio) {
      let me = this;
      var url =
        "/reqinsumo?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDatos = respuesta.req.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarReq(page, buscar, criterio);
    },
    getReqIns() {
      let me = this;
      var url = "/detreqinsumo/?buscar=" + this.idReq;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayReqIns = respuesta.req;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    registrarEtapa() {
      let me = this;

      axios
        .post("/etapa/registrar", {
          nombre: this.form.nombre.toUpperCase(),
          desc: this.form.descripcion.toUpperCase()
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarReq(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarEtapa() {
      let me = this;

      axios
        .put("/etapa/actualizar", {
          nombre: this.form.nombre.toUpperCase(),
          desc: this.form.descripcion.toUpperCase(),
          id: this.idEtapa
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarReq(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actReqIns(data=[]) {
      let me = this;

      axios
        .put("/detreqinsumo/actualizar", {
          id: data["id"],
          fecE: this.fecE
        })
        .then(function(response) {
          // me.ocultarDetalle();
          me.getReqIns();
          me.mensaje("Aprobado", "Aprobó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarEtapa(data = []) {
      swal({
        title: "Esta seguro de Eliminar la Etapa " + data["nombre"],
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
          this.idEtapa = data["id"];
          axios
            .post("/etapa/eliminar", {
              id: this.idEtapa
            })
            .then(function(response) {
              me.ocultarDetalle();
              me.listarReq(1, "", "nombre");
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

    mensaje(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    }
  },

  mounted() {
    this.listarReq(1, this.buscar, this.criterio);
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
.material-icons.Color1 {
  color: rgb(31, 33, 34);
}
.material-icons.Color2 {
  color: rgba(167, 142, 5, 0.849);
}
.material-icons.Color3 {
  color: rgb(12, 170, 91);
}
.material-icons.Color4 {
  color: rgba(228, 54, 54, 0.863);
}
</style>
