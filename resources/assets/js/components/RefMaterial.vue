<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Gestión Referencias Materiales
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
                    <th>Código</th>
                    <th>Tipo de Material</th>
                    <th>Nombre</th>
                    <th>Und. Med.</th>
                    <th>Cant.</th>
                    <th>Valor Unitario</th>
                    <th>Opciones</th>
                    <!-- <th>Valor</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="objeto in arrayMain" :key="objeto.id">
                    <td v-text="objeto.nombre"></td>
                    <td v-text="objeto.nomE"></td>
                    <td v-text="objeto.nombre"></td>
                    <td v-text="objeto.und_med"></td>
                    <td v-text="objeto.cant"></td>
                    <td v-text="objeto.costo"></td>
                    <!-- <td v-text="objeto.valor"></td> -->
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
                <div class="md-layout-item md-size-35">
                  <md-field md-clearable>
                    <label>Tipo de Material</label>
                    <md-select v-model="idTpMaterial" md-dense>
                      <md-option
                        v-for="objeto in arrayTpMaterial"
                        :key="objeto.id"
                        :value="objeto.id"
                      >{{objeto.nombre}}</md-option>
                    </md-select>
                  </md-field>
                </div>&nbsp;&nbsp;&nbsp;
                
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
                    >Olvidaste ingresar el nombre del Material</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                </div>
                </div>
                <div class="md-layout">
                <div class="md-layout-item" md-clearable >
                  <md-field>
                    <label for="desc-name">Cantidad</label>
                    <md-input
                      name="desc-name"
                      id="desc-name"
                      autocomplete="given-name"
                      v-model="cant"
                      :disabled="sending"
                    />                                
                  </md-field>
                </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-15">
                    <md-field md-clearable>
                      <label>Und Medida</label>
                      <md-select v-model="undMed" md-dense>
                        <md-option
                          v-for="objeto in arrayUndMed"
                          :key="objeto.id"
                          :value="objeto.id"
                        >{{objeto.name}}</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                <div class="md-layout-item" md-clearable >
                  <md-field>
                    <label for="desc-name">Costo</label>
                     <span class="md-prefix">$</span>
                    <md-input
                      name="desc-name"
                      id="desc-name"
                      autocomplete="given-name"
                      v-model="costo"
                      :disabled="sending"
                    />                                
                  </md-field>
                </div>&nbsp;&nbsp;&nbsp;
                <div class="md-layout-item" md-clearable >
                  <md-field>
                    <label for="desc-name">Precio Venta</label>
                    <span class="md-prefix">$</span>
                    <md-input
                      name="desc-name"
                      id="desc-name"
                      autocomplete="given-name"
                      v-model="precio"
                      :disabled="sending"
                    />                                
                  </md-field>
                </div>
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
                @click="actualizarRefM()"
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
      idTpMaterial: 0,
      cant: 0,
      undMed: 0,
      costo: 0,
      precio: 0,
      idRefM: 0,

      arrayMain: [],
      arrayTpMaterial: [],
       arrayUndMed: [
        { id: "UNDS", name: "Unidades" },
        { id: "MTS", name: "Metros" },
        { id: "ML", name: "Mts. Lineales" },
        { id: "KG", name: "Kilogramos" },
        { id: "LT", name: "Litros" },
        { id: "G", name: "Galones" }
      ],
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

      if (!this.$v.$invalid) {
        this.registrarRefM();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
      this.form.descripcion = null;
    },
    getTpMaterial() {
      let me = this;

      var url = "/tpmaterial/selectTpMaterial";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTpMaterial = respuesta.tpmaterial;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    mostrarActualizar(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.idTpMaterial = data["id_tp_material"]),
        (this.idRefM = data["id"]);
      this.form.nombre = data["nombre"];
      this.cant = data["cant"];
      this.undMed = data["und_med"];
      this.costo = data["costo"];
      this.precio = data["valor"];
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
        "/refmaterial?page=" +
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
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarRefE(page, buscar, criterio);
    },
    registrarRefM() {
      let me = this;

      axios
        .post("/refmaterial/registrar", {
          idTpMaterial: this.idTpMaterial,
          nombre: this.form.nombre.toUpperCase(),
          cantidad: this.cant,
          und_med: this.undMed,
          costo: this.costo,
          valor: this.precio
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarRefE(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarRefM() {
      let me = this;

      axios
        .put("/refmaterial/actualizar", {
          id: this.idRefM,
          idTpMaterial: this.idTpMaterial,
          nombre: this.form.nombre.toUpperCase(),
          cantidad: this.cant,
          und_med: this.undMed,
          costo: this.costo,
          valor: this.precio
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarRefE(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarRefE(data = []) {
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
          this.idRefM = data["id"];
          axios
            .post("/refmaterial/eliminar", {
              id: this.idRefM
            })
            .then(function(response) {
              me.ocultarDetalle();
              me.listarRefE(1, "", "nombre");
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
    this.getTpMaterial();
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
