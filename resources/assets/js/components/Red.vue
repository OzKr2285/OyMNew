<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Gestion Redes
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
                    <th>Nombre</th>
                    <th>Mercado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="red in arrayRed" :key="red.id">

                    <td v-text="red.nombre"></td>
                    <td v-text="red.nomMercado"></td>
                    <td>
                      <button
                        type="button"
                        @click="mostrarActualizar(red)"
                        class="btn btn-warning btn-sm"
                        data-tooltip
                        title="Actualizar"
                      >
                        <i class="icon-pencil"></i>
                      </button>
                      &nbsp;
                      <template>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          data-tooltip
                          title="Eliminar"
                          @click="eliminarRed(red)"
                        >
                          <i class="icon-trash"></i>
                        </button>
                      </template>
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
                    <md-field md-clearable>
                      <label for="first-name">Ingrese el nombre de la Red</label>
                      <br>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="nombre"
                        :disabled="sending"
                      />
                    </md-field>
                  </div>
                  <div class="md-layout">
                  <!-- <div class="md-layout-item">
                    <span class="md-caption">Mercado</span>
                    <multiselect
                      v-model="arrayMer"
                      :options="arrayMercado"
                      placeholder="Seleccione un Mercado"
                      :custom-label="nameWithNombre"
                      @input="listarDetalle()"
                      label="nombre"
                      track-by="nombre"
                    ></multiselect>
                </div>&nbsp;&nbsp;&nbsp; -->
                  <div class="md-layout-item">
                  <md-field md-clearable>
                    <label>Seleccione el Mercado</label>
                    <md-select v-model="idMercado" md-dense @input="listarDetalle()">
                      <md-option
                        v-for="objeto in arrayMercado"
                        :key="objeto.id"
                        :value="objeto.id"
                      >{{objeto.nombre}}</md-option>
                    </md-select>
                  </md-field>
                </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                  <md-field md-clearable>
                    <label>Seleccione un Municipio</label>
                    <md-select v-model="idMp" md-dense>
                      <md-option
                        v-for="objeto in arrayDetM"
                        :key="objeto.id"
                        :value="objeto.id"
                      >{{objeto.nombre}}</md-option>
                    </md-select>
                  </md-field>
                </div>
                  <!-- <div class="md-layout-item">
                    <span class="md-caption">Municipio</span>
                    <multiselect
                      v-model="arrayDet"
                      :options="arrayDetM"
                      placeholder="Seleccione un Municipio"
                      :custom-label="nameWithNombre"
                      label="nombre"
                      track-by="nombre"
                    ></multiselect>
                </div> -->
                </div>
                <div class="md-layout">
                <md-field>
                  <label>Descripción</label>
                  <md-textarea v-model="obs"></md-textarea>
                  <md-icon>description</md-icon>
                </md-field>
              </div>
                <div class="md-layout-item">
                  <md-field md-clearable>
                    <label>Manual de la Red</label>
                    <md-file v-model="planoC" placeholder="Seleccione el manual de la Red"/>
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
                @click="actualizarRed()"
              >Actualizar</md-button>
            </md-card-actions>
          </div>
        </template>
      </div>

      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
 

    <!-- /.modal-dialog -->

    <!--Fin del modal-->
  </main>
</template>

<script>
import { validationMixin } from "vuelidate";
import format from "date-fns/format";
import {
  MdButton,
  MdContent,
  MdField,
  MdCard,
  MdMenu,
  MdSwitch,
  MdDivider,
  MdList
} from "vue-material/dist/components";
import Multiselect from "vue-multiselect";
import Datepicker from 'vuejs-datepicker';
// import VueMaterial from 'vue-material'
// Vue.use(VueMaterial)
Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdSwitch);
Vue.use(MdDivider);
Vue.use(MdList);
import { required, minLength } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],
  components: {
    Multiselect,
    Datepicker
  },
  data() {
    let dateFormat = this.$material.locale.dateFormat || "yyyy-MM-dd";
    let now = new Date();

    return {
      demo: 0,
      fecCrea: now,
      tpRed: 0,
      cantP: 0,
      cbx: 1,

      idDpto: 0,
      idMp: 0,
      idMp2: 0,
      idRed: 0,
      tpDiam: 0,
      fecN: format(now, dateFormat),
      fecN2: "",

      planoG: "",
      planoC: "",
      planoA: "",
      planoP: "",
      nombre: "",
      descripcion: "",
      obs: "",
      longitud: "",
      idMercado: "",

      tipoAccion: 1,
      listado: 1,
      sending: false,
      idTpEstacion: 0,
      idRed: 0,

      arrayDpto: [],
      arrayDetRed: [],
      arrayMpio: [],
      arrayM: { id: 0, nombre: "", nomDpto: "" },

      arrayRed: [],
      arrayMercado: [],
      arrayDetM: [],
  

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
      criterio: "nombre",
      buscar: ""
    };
  },

  validations: {},

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
    },
    dateFormat() {
      return this.$material.locale.dateFormat || "yyyy-MM-dd";
      // return moment(date).format('LL')
    },
    mdType() {
      switch (this.mdTypeValue) {
        case "fecCrea":
          return String;
      }
    }
  },
  methods: {
    setCbx() {
      if (this.tpRed == "Rural") {
        this.cbx = 0;
      } else {
        this.cbx = 1;
      }
    },
    toDate() {
      switch (this.type) {
        case "null":
          this.fecCompra = null;
          break;

        case "fecCrea":
          this.fecCrea = parse(this.fecCrea, this.dateFormat, new Date());
          break;
      }
    },

    toString() {
      this.toDate();
      this.fecCrea = this.fecCrea && format(this.fecCrea, this.dateFormat);
    },
    toString2() {
      this.fecN2 = this.fecN && format(this.fecN, this.dateFormat);
      //  this.fecN = moment(this.fecN).format("YYYY-MM-DD");
    },
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
        this.registrarRed();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.tpRed = "";
      this.tpDiam = "";
      this.idRed = "";
      this.id_mpio = "";
      this.fecCrea = "";
      this.cantP = "";
      this.desc = "";

    },
    nameWithMpio({ nombre, nomDpto }) {
      return `${nombre} — [${nomDpto}]`;
    },
    nameWithNombre({ nombre }) {
      return `${nombre}`;
    },

    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    getDpto() {
      let me = this;

      var url = "/dpto/selectDpto";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayDpto = respuesta.dpto;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarDetalle() {
      let me = this;
      var url =
        "/detmercado/detalle?buscar=" +
        this.idMercado 
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDetM = respuesta.refe;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getMaterial() {
      let me = this;

      var url = "/tpmaterialred/selectTpMaterial";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayMaterial = respuesta.tpmaterial;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
      getMercado() {
      let me = this;

      var url = "/mercado/selectMercado";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayMercado = respuesta.mercado;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    getMpio() {
      let me = this;
      var url = "/mpio/selectMpio";
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayMpio = respuesta.mpio;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    mostrarActualizar(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      this.nombre = data["nombre"];
      this.obs = data["desc"];
      this.idRed = data["id"];
      this.idMercado = data["idMer"];
      this.idMp = data["id_mpio"];
      this.listarDetalle();
      this.idMp2 = data["id_mpiofin"];

    },

    ocultarDetalle() {
      this.listado = 1;
    },
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetRed.length; i++) {
        if (this.arrayDetRed[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    agregarSecRed(data = []) {
      let me = this;
      if (me.encuentra(data["idticket"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "La Disponibilidad seleccionada ya se encuentra agregado!"
        });
      } else {
        me.arrayDetRed.push({
          id: data["idticket"],
          fecha: data["fecha"],
          desc: data["desc"]
        });
      }
    },
    listarRed(page, buscar, criterio) {
      let me = this;
      var url =
        "/fichared?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayRed = respuesta.fichared.data;
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
      me.listarRed(page, buscar, criterio);
    },
    registrarRed() {
      let me = this;

      axios
        .post("/fichared/registrar", {
          id_mpio: this.idMp,
          nombre: this.nombre.toUpperCase(),
          desc: this.obs,
          plano_g: this.planoG,
          plano_a: this.planoA,
          plano_c: this.planoC,
          plano_p: this.planoP
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarRed(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    actualizarRed() {
      let me = this;

      axios
        .put("/fichared/actualizar", {
          id_mpio: this.idMp,
          nombre: this.nombre.toUpperCase(),
          desc: this.obs,
          id: this.idRed
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarRed(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarRed(data = []) {
      swal({
        title: "Esta seguro de Eliminar la Red " + data["nombre"],
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
          this.idRed = data["id"];
          axios
            .post("/estacion/eliminar", {
              id: this.idRed
            })
            .then(function(response) {
              me.ocultarDetalle();
              me.listarRed(1, "", "nombre");
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
    this.getMpio();
    this.getMercado();
    // this.getDpto();
    // this.getRed();
    // this.getDiam();
    this.listarRed(1, this.buscar, this.criterio);
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
</style>
