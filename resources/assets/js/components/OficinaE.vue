<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Gestión Equipos Oficina
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
                    <th>Oficina</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="objeto in arrayMain" :key="objeto.id">
                    <td v-text="objeto.nomM"></td>                    
                    <td>
                      <md-button class="md-icon-button " @click="mostrarActualizar(objeto)" title="Actualizar">                         
                      <i class="material-icons Color3">edit</i>
                    </md-button>
                    <md-button class="md-icon-button md-primary " @click="eliminarRefE(objeto)" title="Eliminar">
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
                <div class="md-layout-item md-size-45">
                  <md-field md-clearable>
                    <label>Seleccione la Oficina</label>
                    <md-select v-model="idOficina" md-dense @input="listarDetalle()">
                      <md-option
                        v-for="objeto in arrayOficina"
                        :key="objeto.id"
                        :value="objeto.id"
                      >{{objeto.nombre}}</md-option>
                    </md-select>
                  </md-field>
                </div>&nbsp;&nbsp;&nbsp;
<!--                 
                <div class="md-layout-item">
                  <md-field md-clearable :class="getValidationClass('nombre')">
                    <label for="first-name">Nombre</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.nombre"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.nombre.required"
                    >Olvidaste ingresar el nombre del Mercado</span>
                    
                  </md-field>
                </div> -->
                </div>
                 <div>          
                <span class="md-caption">Detalle Equipos Oficina</span>
                  <md-button class="md-icon-button md-primary" @click="abrirModal5">
                    <md-icon>post_add</md-icon>
                    </md-button>
                </div>    
                <div class="table-responsive col-md-12">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Serial</th>                        
                        <th>Equipo</th>                        
                        <th>Modelo</th>                        
                        <th>Responsable</th>                        
                        <th>Opciones</th>
                      </tr>
                      <!-- <md-button class="md-icon-button md-primary" @click="abrirModal5">
                        <md-icon>post_add</md-icon>
                      </md-button> -->
                    </thead>
                    <tbody v-if="arrayDetM.length">
                      <tr
                        v-for="(objeto, index) in arrayDetM"
                        :key="`objeto-${index}`"
                      >                        
                        <td v-text="objeto.serial"></td>
                        <td v-text="objeto.nombre"></td>
                        <td v-text="objeto.modelo"></td>
                        <td v-text="objeto.respo"></td>
                        <td>
                          <md-button class="md-icon-button md-primary " @click="eliminarEquipo(objeto)" title="Eliminar">
                            <i class="material-icons Color4">delete</i>
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
      :class="{ mostrar: modal5 }"
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
                  <select
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
                  </select>
                  <input
                    type="text"
                    v-model="criterio"
                    @keypress="listarExEtapa(1,this.idTpEquipo,criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  >
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
                    <th>Equipo</th>
                    <th>Modelo</th>
                    <th>Descripción</th>
                    <th>Selección</th>
                  </tr>
                </thead>
                <tbody v-if="arrayEquipo.length">
                  <tr
                    v-for="(objeto, index) in arrayEquipo"
                    :key="`objeto-${index}`"
                  >
                    <td v-text="objeto.serial"></td>
                    <td v-text="objeto.nomref"></td>
                    <td v-text="objeto.modelo"></td>
                    <td v-text="objeto.desc"></td>
                    <td>
                      <button
                        type="button"
                        @click="agregarEquipo(objeto)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
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
    </div>
    <!-- /.modal-dialog -->

    <!--Fin del modal-->
  </main>
</template>

<script>
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

  data() {
    return {
      form: {
        nombre: ""
      },
      demo: 0,
      tipoAccion: 1,
      listado: 1,
      sending: false,
      idOficina: 0,
      cant: 0,
      undMed: 0,
      costo: 0,
      precio: 0,
      idRefM: 0,
      idMpio: "",
      idTpEquipo: "",
      idDet: "",
      modal5: 0,

      arrayMain: [],
      arrayTpEquipo: [],
      arrayEquipo: [],
      arrayOficina: [],
      arrayMpios: [],
      arrayDptos: [],
      arrayDetM: [],
      arrayDetMAct: [],
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
      // nombre: {
      //   required
      // }
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
        this.registrarM();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.arrayDetMAct=[];
    },
    abrirModal5() {
      // this.idRefE=data["idref"];
      this.listarExEtapa(1, this.idTpEquipo,this.criterio);
      // this.getTpEquipo();
      this.modal5 = 1;
      this.tituloModal = "Seleccione uno o varios Equipos";
      // this.getPerso(1, this.buscar, this.criterio);
    },
    cerrarModal5() {
      this.modal5 = 0;
      this.tituloModal = "";
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
      listarExEtapa(page, buscar, criterio) {
      let me = this;
      var url =
        "/equipo/computoOficina?page=" + page + "&buscar=" + this.idTpEquipo + "&criterio=" + criterio;
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

    agregarEquipo(data = []) {
      let me = this;
      if (me.encuentra3(data["ide"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "El Equipo seleccionado ya se encuentra agregado!"
        });
      } else {
        me.arrayDetM.push({
          id: data["ide"],
          serial: data["serial"],
          modelo: data["modelo"],
          tpEquipo: data["nomtpequipo"],
          respo: data["nomperso"],
          nombre: data["nomref"]
        });
          me.arrayDetMAct.push({
            id: data["ide"],
            serial: data["serial"],
            modelo: data["modelo"],
            tpEquipo: data["nomtpequipo"],
            respo: data["nomperso"],
            nombre: data["nomref"]
        });
      }
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
   
    mostrarActualizar(data = []) {
      let me = this;
      (this.idDet = data["id"]);      
      (this.idOficina = data["id_oficina"]);      
      (this.tipoAccion = 2), (me.listado = 0);
      this.listarDetalle();
    },
    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
    },
    listarRefE(page, buscar, criterio) {
      let me = this;
      var url =
        "/detoficinae?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayMain = respuesta.refe.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarDetalle() {
      let me = this;
      var url =
        "/detoficinae?buscar=" +
        this.idOficina 
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
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarRefE(page, buscar, criterio);
    },
    cambiarPaginaM(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarExEtapa(page, buscar,criterio);
    },
    getTpEquipo() {
      let me = this;

      var url = "/refequipo/selectRefEquipoComp";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTpEquipo = respuesta.refequipo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getMpio() {
      let me = this;
      var url = "/mpio/selectMpio/?buscar=" + this.idTpEquipo;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayMpios = respuesta.mpio;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    registrarM() {
      let me = this;

      axios
        .post("/detoficinae/registrar", {
          idOficina: this.idOficina,   
          data: this.arrayDetM
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarDetalle();
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarM() {
      let me = this;

      axios
        .put("/detoficinae/actualizar", {
          idOficina: this.idOficina,   
          data: this.arrayDetMAct
        })
        .then(function(response) {
          // me.ocultarDetalle();
          me.listarDetalle();
          me.clearForm();
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarEquipo(data = []) {
      swal({
        title: "Esta seguro de Eliminar el Equipo " + data["nombre"],
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
          this.idDet = data["id"];
          axios
            .post("/detoficinae/eliminar", {
              id: this.idDet
            })
            .then(function(response) {
              // me.ocultarDetalle();
              me.listarDetalle();
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
    this.getOficina();
    this.listarRefE(1, this.buscar, this.criterio);
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
.material-icons.Color2 { color: rgba(167, 142, 5, 0.849); }
.material-icons.Color3 { color: rgb(12, 170, 91); }
.material-icons.Color4 { color: rgba(228, 54, 54, 0.863); }
</style>
