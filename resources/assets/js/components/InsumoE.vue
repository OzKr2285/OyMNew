<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-charging-station"></i> 
          <strong class="lead">Gestión de Insumos por Equipo</strong >
          <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <template v-if="listado==1">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr class="p-3 mb-2 bg-dark text-white">                    
                    <th>Descripción</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="objeto in arrayInsumosE" :key="objeto.id">                    
                    <td v-text="objeto.desc"></td>
                    <td>
                      <md-button
                        class="md-icon-button"
                        @click="mostrarActualizar(objeto)"
                        title="Actualizar"
                      >
                        <i class="material-icons Color3">edit</i>
                      </md-button>
                      <md-button
                        class="md-icon-button md-primary"
                        @click="eliminarInsumoE(objeto)"
                        title="Eliminar"
                      >
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
          </div>
        </template>
        <template v-else-if="listado==0">
          <div class="card-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <md-card-content>
                <div class="md-layout">
                  <div class="md-layout-item" v-show="mostrarC==1">
                    <md-autocomplete
                      md-dense
                      v-model="idTpEquipo"
                      :md-options="arrayTpEquipo.map(x=>({
                      'id':x.id,
                      'nombre':x.nombre,
                      'toLowerCase':()=>x.nombre.toLowerCase(),
                      'toString':()=>x.nombre
                    }))"
                      @md-changed="getTpEquipo"
                      @md-opened="getTpEquipo"
                    >
                      <label>Tipo de Equipo</label>
                      <template slot="md-autocomplete-item" slot-scope="{ item }">{{ item.nombre }}</template>
                    </md-autocomplete>
                  </div>&nbsp;&nbsp;&nbsp;
                  <!-- <div class="md-layout-item" v-show="mostrarC==2">
                    <md-field md-clearable>
                      <label>Tipo de Equipo</label>
                      <md-select v-model="idTpEquipo2" md-dense @input="getRefE2">
                        <md-option
                          v-for="(tpequipo,index) in arrayTpEquipo"
                          :key="`tpequipo-${index}`"
                          :value="tpequipo.id"
                        >{{tpequipo.nombre}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp; -->
                  <div class="md-layout-item" v-show="mostrarC==1">
                    <!-- <md-field md-clearable> -->
                    <md-autocomplete
                      md-dense
                      v-model="idRefEquipo"
                      :md-options="arrayRefEquipo.map(x=>({
                      'id':x.id,
                      'nombre':x.nombre,
                      'toLowerCase':()=>x.nombre.toLowerCase(),
                      'toString':()=>x.nombre
                    }))"
                      @md-changed="getRefE"
                      @md-opened="getRefE"
                    >
                      <label>Nombre del Equipo</label>
                      <template slot="md-autocomplete-item" slot-scope="{ item }">{{ item.nombre }}</template>
                    </md-autocomplete>

                    <!-- </md-field> -->
                  </div>
                  <!-- <div class="md-layout-item" v-show="mostrarC==2">
                    <md-field md-clearable>
                      <label>Referencia del Equipo</label>
                      <md-select v-model="idRefEquipo2" md-dense >
                         <md-option
                          v-for="(refequipo,index) in arrayRefEquipo"
                          :key="`refequipo-${index}`"
                          :value="refequipo.id"
                        >{{refequipo.nombre}}</md-option>
                      </md-select>
                    </md-field>
        
                  </div> -->

                </div>
                <div class="md-layout" md-clearable>
                <div class="md-layout-item" md-clearable>
             
                    <md-field :class="getValidationClass('descripcion')">
                      <label for="desc-name">Descripción</label>
                      <md-input
                        name="desc-name"
                        id="desc-name"
                        autocomplete="given-name"
                        v-model="descripcion"
                        :disabled="sending"
                      />
                    </md-field>            
                </div>
                  <div class="md-layout-item md-size-5">
                    <br />
                    <md-button
                      class="md-icon-button md-dense md-raised md-primary"
                      @click="abrirModal"
                    >
                      <md-icon>add</md-icon>
                    </md-button>
                  </div>
                </div>
                <h4>Insumos</h4>

                <div class="table-responsive col-md-12">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Nombre</th>                        
                        <th>Observación</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody v-if="arrayDetInsumos.length">
                      <!-- <tr v-for="(equipo,index) in arrayEquipo" :key="`equipo-${index}`"> -->
                      <tr v-for="(detalle, index) in arrayDetInsumos" :key="`detalle-${index}`">
                        <td v-text="detalle.nombre"></td>                        
                        <td v-text="detalle.observacion"></td>

                        <td>
                          <md-button
                            class="md-icon-button"
                            @click="eliminarDetalle(index)"
                            title="Eliminar Insumo"
                          >
                            <i class="material-icons Color4">delete_sweep</i>
                          </md-button>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="5">NO hay Insumos agregados</td>
                      </tr>
                    </tbody>
                  </table>
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
                @click="actualizarInsumoE()"
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
            <div class="col-md-12">
              <div class="input-group">
                <select
                    class="form-control col-md-6"
                    v-model="idInsumo"
                    @change="listarInsumos(1, this.idInsumo,criterio )"
                  >
                    <option
                      v-for="objeto in arrayInsumo"
                      :key="objeto.id"
                      :value="objeto.id"
                      >{{ objeto.nombre }}</option
                    >
                  </select>
                  <input
                    type="text"
                    v-model="criterio"
                    @keypress="listarInsumos(1,this.idInsumo,criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
                  <button
                    type="submit"
                    @click="listarInsumos(1, this.idInsumo,criterio)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                    </div>
              </div>
            </div>
            <!-- <div class="md-layout"> -->
              <!-- <div class="md-layout-item">
                <md-field >
                  <label for="desc-name">Descripción</label>
                  <md-input
                    name="desc-name"
                    id="desc-name"
                    autocomplete="given-name"
                    v-model="descripcion"
                    :disabled="sending"
                  />                  
                </md-field>
              </div>&nbsp;&nbsp;&nbsp;-->
              <!-- <div class="md-layout-item">
                <md-field md-clearable>
                  <label>Qué desea Buscar</label>
                  <md-input v-model="buscar" @keypress="listarInsumo(1,buscar,criterio)"></md-input>
                </md-field>
              </div>&nbsp;&nbsp;&nbsp;
              <div class="md-layout-item md-size-5">
                <br />
                <md-button
                  class="md-icon-button md-dense md-raised md-primary"
                  @click="listarInsumo(1,buscar,criterio)"
                >
                  <md-icon>search</md-icon>
                </md-button>
              </div>
            </div> -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <!-- <th>Descripción</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(detinsumo, index)  in arrayInsumos" :key="`detinsumo-${index}`">
                    <td>
                      <button
                        type="button"
                        @click="agregarDetalleModal(detinsumo)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                    <td v-text="detinsumo.nombre"></td>
                    <!-- <td v-text="detinsumo.desc"></td> -->
                  </tr>
                </tbody>
              </table>
              <nav>
                <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaA(pagination.current_page - 1,buscar,criterio)"
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
                      @click.prevent="cambiarPaginaA(page,buscar,criterio)"
                      v-text="page"
                    ></a>
                  </li>
                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPaginaA(pagination.current_page + 1,buscar,criterio)"
                    >Sig</a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="md-layout">
              <md-field>
                <label for="desc-name">Observacion</label>
                <md-input
                  name="desc-name"
                  id="desc-name"
                  autocomplete="given-name"
                  v-model="observacion"
                  :disabled="sending"
                />
              </md-field>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!--Fin del modal-->
  </main>
</template>

<script>
import { validationMixin } from "vuelidate";
import {
  MdHighlightText,
  MdButton,
  MdContent,
  MdField,
  MdCard,
  MdMenu,
  MdList
} from "vue-material/dist/components";
// import VueMaterial from "vue-material";
// Vue.use(VueMaterial);

Vue.use(MdHighlightText);
Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdList);
import { required, minLength } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],

  data() {
    return {
      form: {
        nombre: ""
      },
      descripcion: "",
      observacion: "",
      demo: 0,
      tipoAccion: 1,
      listado: 1,
      sending: false,
      idInsumoe: 0,
      idInsumo: 0,
      idTpEquipo: "",
      idTpEquipo2: "",
      idRefEquipo: "",
      idRefEquipo2: "",
      estacion_id: 0,
      mostrarC: 1,
      idDet: 0,
      searchTerm: "",

      arrayInsumos: [],
      arrayInsumo: [],
      arrayCriterio: ["Nombre", "Desc"],
      arrayDetInsumos: [],
      arrayActDetInsumos: [],
      arrayInsumosE: [],
      arrayTpEquipo: [],
      arrayRefEquipo: [],
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
      criterio: "",
      buscar: ""
    };
  },

  validations: {
    form: {
      nombre: {
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

      this.registrarInsumoE();
      this.clearForm();
      // if (!this.$v.$invalid) {
      // }
    },
    clearForm() {
      this.$v.$reset();
      this.arrayDetInsumos=[];
      this.idTpEquipo = "";
      this.idRefEquipo = "";
      this.observacion = "";      
      this.descripcion = null;
    },
    getTpEquipo() {
      let me = this;

      var url = "/tpequipo/selectTpEquipo";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTpEquipo = respuesta.tpequipo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getInsumo() {
      let me = this;

      var url = "/tpmaterial/selectTpMaterial";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayInsumo = respuesta.tpmaterial;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getRefE() {
      let me = this;

      var url = "/refequipo/selectRefEquipo?buscar=" + this.idTpEquipo.id;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayRefEquipo = respuesta.refequipo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getRefE2() {
      let me = this;

      var url = "/refequipo/selectRefEquipo?buscar=" + this.idTpEquipo2.id;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayRefEquipo = respuesta.refequipo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarInsumos(page, buscar,criterio) {
      let me = this;
      var url =
        "refmaterial/getRefM?page=" +
        page +
        "&buscar=" +
        this.idInsumo +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayInsumos = respuesta.refM.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarInsumo(page, buscar, criterio) {
      let me = this;
      var url =
        "/insumo?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayInsumos = respuesta.insumo.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetInsumos.length; i++) {
        if (this.arrayDetInsumos[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    agregarDetalleModal(data = []) {
      let me = this;

      if (me.encuentra(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "Este Insumo ya se encuentra agregado!"
        });
      } else {
        me.arrayDetInsumos.push({
          id: data["id"],
          nombre: data["nombre"],
          desc: data["desc"],
          observacion: this.observacion
        });
        me.arrayActDetInsumos.push({
          id: data["id"],
          nombre: data["nombre"],
          desc: data["desc"],
          observacion: this.observacion
        });
      }     
    },

    eliminarDetalle(index) {
      let me = this;
      me.arrayDetInsumos.splice(index, 1);
    },
    abrirModal() {
      this.modal = 1;
      // this.listarInsumo(1,buscar,criterio);
      this.tituloModal = "Seleccione uno o varios Insumos";
    },
    cerrarModal() {
      this.modal = 0;
      this.demo = 0;
      this.tituloModal = "";
    },
    mostrarActualizar(data = []) {
      let me = this;
      this.mostrarC = 2;
      (this.tipoAccion = 2), (me.listado = 0);
      this.idTpEquipo2 =  data["idTpE"];
      this.idInsumoe =  data["id"];
      this.descripcion = data["desc"];
      this.listarDetInsumo(1, this.idInsumoe);      

      this.getRefE2();
      this.idRefEquipo2 =  data["idRefE"];
    },
    mostrarDetalle() {
      this.getTpEquipo();
      this.clearForm();
      let me = this;
      this.mostrarC = 1;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
    },

    listarInsumoE(page, buscar, criterio) {
      let me = this;
      var url =
        "/insumoe?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayInsumosE = respuesta.insumoe.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarDetInsumo(page, buscar) {
      let me = this;
      var url =
        "/detinsumo/detIns?page=" +
        page +
        "&buscar=" +
        buscar 
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDetInsumos = respuesta.detinsumo.data;
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
      me.listarInsumoE(page, buscar, criterio);
    },
    registrarInsumoE() {
      let me = this;

      axios
        .post("/detinsumo/registrar", {
          id_refequipo: this.idRefEquipo.id,
          desc: this.descripcion.toUpperCase(),
          data: this.arrayDetInsumos
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarInsumoE(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarInsumoE() {
      let me = this;

      axios
        .put("/detinsumo/actualizar", {   
          id: this.idInsumoe,   
          idDet: this.idDet,   
          idRefEquipo: this.idRefEquipo,          
          descripcion: this.descripcion.toUpperCase(),  
          data: this.arrayActDetInsumos       
        })
        .then(function(response) {
          me.arrayActDetInsumos=[]; 
          me.ocultarDetalle();
          me.listarInsumoE(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarInsumoE(data = []) {
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
              me.listarInsumoE(1, "", "nombre");
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
    this.getTpEquipo();
    this.getInsumo();
    this.listarInsumoE(1, this.buscar, this.criterio);
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

