<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Gestion Ficha  Redes
          <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
          <button title="Agregar" type="button" @click="abrirModal()" class="btn btn-ttc btn-sm">
            <i class="fas fa-map-marked"></i>&nbsp;
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
                    <th>Tipo Red</th>
                    <th>Total</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="red in arrayFRed" :key="red.id">
                    <td v-text="red.nombre"></td>
                    <td v-text="red.nomMercado"></td>
                    <td>
                        <template v-if="red.tp_red==1">
                          <span>Urbana</span>
                        </template>
                        <template else v-if="red.tp_red==2">
                          <span>Rural</span>
                        </template>
                        <template else v-if="red.tp_red==3">
                          <span>Troncal</span>
                        </template>
                    </td>
                    <td v-text="red.total"></td>
                    <td>
                      <button
                        type="button"
                        @click="mostrarActualizar(red)"
                        class="btn btn-success btn-sm"
                        data-tooltip
                        title="Actualizar"
                      >
                        <i class="icon-pencil"></i>
                      </button>
                      &nbsp;
                      <!-- <template>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          data-tooltip
                          title="Eliminar"
                          @click="eliminarDetRed(red)"
                        >
                          <i class="icon-trash"></i>
                        </button>
                      </template> -->
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
                    <label>Seleccione Red</label>
                      <md-select v-model="idRed" md-dense @input="listarDetalle()">
                      <md-option
                        v-for="objeto in arrayRed"
                        :key="objeto.id"
                        :value="objeto.id"
                      >{{objeto.nombre}}</md-option>
                    </md-select>
                  </md-field>
                </div>
                
                <div class="table-responsive col-md-12">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Canalización</th>
                        <th>Tubería</th>
                        <th>Tipo Red</th>
                        <th>Longitud</th>
                        <th>Observación</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody v-if="arrayDetRed.length">
                      <tr v-for="(objeto, index)  in arrayDetRed" :key="`objeto-${index}`">
                        <td v-text="objeto.material"></td>
                        <td v-text="objeto.tuberia"></td>
                        <td>
                        <template v-if="objeto.tp_red==1">
                          <span>Urbana</span>
                        </template>
                        <template else v-if="objeto.tp_red==2">
                          <span>Rural</span>
                        </template>
                        <template else v-if="objeto.tp_red==3">
                          <span>Troncal</span>
                        </template>
                    </td>
                        <td v-text="objeto.longitud"></td>
                        <td v-text="objeto.obs">mts</td>
                        <td>
                          <md-button
                            class="md-icon-button md-primary"
                            @click="mostrarActualizarModal(objeto)"
                            title="editar"
                          >
                            <i class="material-icons Color3">edit</i>
                          </md-button>
                          <md-button
                            class="md-icon-button md-primary"
                            @click="eliminarDetRed(objeto)"
                            title="Eliminar"
                          >
                            <i class="material-icons Color4">delete</i>
                          </md-button>
                        </td>
                      </tr>
                    <tr style="background-color: #d0d2dd;">
                        <!-- <td colspan="1"></td> -->
                        <td colspan="3" align="right"><strong>Total:</strong></td>
                        <td>{{parseFloat(calcularTotal)}} mts</td>
                        <!-- <td>{{total=calcularTotal}} mts</td> -->
                        <td colspan="2"></td>
                      </tr>

        
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="6">NO hay Detalles de la red</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- <div class="md-layout">
                  <md-field>
                    <label>Descripción</label>
                    <md-textarea v-model="descripcion"></md-textarea>
                  </md-field>
                </div>-->
                <!-- <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Plano Georeferenciado</label>
                      <md-file v-model="planoG" placeholder="Seleccione el plano Georeferenciado"/>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>ARCGIS</label>
                      <md-file v-model="planoA" placeholder="Seleccione Excel ARCGIS"/>
                    </md-field>
                  </div>
                </div>-->
                <!-- <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Manual de Construcción</label>
                      <md-file v-model="planoC" placeholder="Seleccione el manual de Construcción"/>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Plano Polivalvulas</label>
                      <md-file v-model="planoP" placeholder="Seleccione el plano POLIVALVULAS"/>
                    </md-field>
                  </div>
                </div>-->
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
                @click="actualizarTramoRed()"
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
      :class="{ mostrar: modal }"
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
        
              <div class="md-layout">
                <span class="md-body">Tubería</span>
                <multiselect
                  v-model="arrayT"
                  :options="arrayTub"
                  placeholder="Seleccione un tipo de Tubería"
                  :custom-label="nameWithTub"
                  label="nombre"
                  track-by="nombre"
                ></multiselect>
              </div>
              <div class="md-layout">
                <span class="md-body">Canalización</span>
                <multiselect
                  v-model="arrayMat"
                  :options="arrayMaterial"
                  placeholder="Seleccione un Material"
                  :custom-label="nameWithNombre"
                  label="nombre"
                  track-by="nombre"
                ></multiselect>
              </div>&nbsp;&nbsp;&nbsp;
               <div class="md-layout">
               <div class="md-layout-item">
                  <span class="md-caption">Tipo de Red</span>
                    <multiselect
                      v-model="arrayTR"
                      :options="arraytpRed"
                      placeholder="Seleccione un Tipo de Red"
                      :custom-label="nameWithNombre"
                      label="nombre"
                      track-by="nombre"
                    ></multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                <div class="md-layout-item">
                <md-field>
                  <label>Longitud</label>
                  <md-input v-model="longitud" type="number"></md-input>
                </md-field>
                </div> &nbsp;&nbsp;&nbsp;
                <div class="md-layout-item">
                <span class="md-body">Fecha Operación</span>
                <datepicker
                  @input="toString2"
                  v-model="fecN"
                  value="fecN"
                  format="yyyy-MM-dd"
                  placeholder="Seleccione Fecha"
                ></datepicker>
              </div> 
              </div>
              <div class="md-layout">
                <md-field>
                  <label>Observación</label>
                  <md-textarea v-model="obs"></md-textarea>
                  <md-icon>description</md-icon>
                </md-field>
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
              <md-button
              v-if="tipoAccion==1"
                type="submit"                
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="registrarTramoRed()"
              >Agregar</md-button>           
              <md-button
                v-if="tipoAccion2==1"
                type="submit"                
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="actualizarTramoRed()"
              >Actualizar</md-button>           
          </div>
        </div>
      </div>
    </div>

    <!-- /.modal-dialog -->

    <!--Fin del modal-->
  </main>
</template>

<script>
import { validationMixin } from "vuelidate";
import Toasted from 'vue-toasted';
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
Vue.use(Toasted,  {
    iconPack : 'material' // set your iconPack, defaults to material. material|fontawesome|custom-class
});
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

      tipoAccion: 1,
      listado: 1,
      sending: false,
      idTpEstacion: 0,
      idDetRed: 0,

      arrayDpto: [],
      arrayDetRed: [],
      arrayMpio: [],
      arrayM: { id: 0, nombre: "", nomDpto: "" },
      arrayMat: { id: 0, nombre: ""},
      arrayT: { id: 0, nombre: ""},
      arrayTR: { id: 0, nombre: ""},
      arraytpRed: [
        { id: "1", nombre: "URBANA" },
        { id: "2", nombre: "RURAL" },
        { id: "3", nombre: "TRONCAL" }
      ],
      arrayRed: [],
      arrayFRed: [],
      arrayDiam: [],
      arrayMaterial: [],
      arrayTub: [],

      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      tipoAccion2: 0,

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
    calcularTotal: function(){
        var resultado=0;
        for(var i=0;i<this.arrayDetRed.length;i++){
            resultado=resultado+(parseInt(this.arrayDetRed[i].longitud))
        }
        return resultado;
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
      this.plano_g = "";
      this.plano_a = "";
      this.plano_c = "";
      this.plano_p = "";
    },
    nameWithMpio({ nombre, nomDpto }) {
      return `${nombre} — [${nomDpto}]`;
    },
    nameWithNombre({ nombre }) {
      return `${nombre}`;
    },
    nameWithTub({ nombre }) {
      return `${nombre}`;
    },
    abrirModal(data = []) {
      // this.idRefE=data["idref"];
      // this.ticket_id = data["idticket"];
      this.tipoAccion2 = 0;
      this.tipoAccion = 1;
      this.getDiametro();
      this.getMaterial();
      this.modal = 1;
      this.tituloModal = "Registrar sección de Red ";

    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
    },
    mostrarDetalle() {
      this.tipoAccion2=0;
      this.tipoAccion=1;
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
    getDiametro() {
      let me = this;

      var url = "/diametro/selectDiametro";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTub = respuesta.diametro;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getFRed() {
      let me = this;

      var url = "/fichared/selectRed";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayRed = respuesta.fichared;
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
    // getRed() {
    //   let me = this;

    //   var url = "/red/selectRed";
    //   axios
    //     .get(url)
    //     .then(function(response) {
    //       //console.log(response);
    //       var respuesta = response.data;
    //       me.arrayRed = respuesta.red;
    //     })
    //     .catch(function(error) {
    //       console.log(error);
    //     });
    // },
    getDiam() {
      let me = this;

      var url = "/diametro/selectDiametro";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayDiam = respuesta.diametro;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    mostrarActualizar(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      this.id = data["id"];
      this.idRed = data["id"];
      this.listarDetalle();

    },
    mostrarActualizarModal(data = []) {
      let me = this;
      this.tituloModal = "Actualizar sección de Red ";
      this.getDiametro();
      this.getMaterial();
      (this.tipoAccion = 0);
      (this.tipoAccion2 = 1);
      this.idDetRed = data["idDet"];
      this.longitud = data["longitud"];
      this.obs = data["obs"];
      this.arrayT.id = data["idTub"];
      this.arrayT.nombre = data["tuberia"];
      this.arrayMat.id = data["idMat"];
      this.arrayMat.nombre = data["material"];
      this.fecN = data["fec_opera"];
      if(data["tp_red"]==1){
        this.arrayTR.id ="1";
        this.arrayTR.nombre ="URBANA";
      }else if(data["tp_red"]==2){
        this.arrayTR.id ="2";
        this.arrayTR.nombre ="RURAL";
      }else{
        this.arrayTR.id ="3";
        this.arrayTR.nombre ="TRONCAL";
      }
      this.modal = 1;

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
    listarDatos(page, buscar, criterio) {
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
          me.arrayFRed = respuesta.fichared.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
      listarDetalle(page, buscar, criterio) {  
      let me = this;
      this.tipoAccion2=0;
      var url =
        "/detred/detalle?page=" +
        page +
        "&buscar=" +
        this.idRed +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDetRed = respuesta.detred;
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
      me.listarDatos(page, buscar, criterio);
    },
    registrarRed() {
      let me = this;

      axios
        .post("/fichared/registrar", {
         
          id_mpio: this.arrayM.id,
          nombre: this.nombre,
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
    registrarTramoRed() {
      let me = this;
      axios
        .post("/detred/registrar", {
          id_red: this.idRed,
           tp_red: this.arrayTR.id,
          id_material: this.arrayMat.id,
          id_diametro: this.arrayT.id,
          fec_opera: this.fecN2,
          obs: this.obs,
          longitud: this.longitud
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarDetalle();
           me.mensajeToast("Agregado","bubble","check","success");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarTramoRed() {
      let me = this;
      axios
        .put("/detred/actualizar", {
          id: this.idDetRed,
          id_red: this.idRed,
          tp_red: this.arrayTR.id,
          id_material: this.arrayMat.id,
          id_diametro: this.arrayT.id,
          fec_opera: this.fecN2,
          obs: this.obs,
          longitud: this.longitud
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarDetalle();
           me.mensajeToast("Actualizado","bubble","check","success");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarDetRed(data = []) {
      swal({
        title: "Esta seguro de Eliminar el tramo de Red " + data["obs"],
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
        let me = this;
        this.idDetRed = data["idDet"];
        if (result.value) {
          axios
            .post("/detred/eliminar", {
              id: this.idDetRed
            })
            .then(function(response) {
              me.listarDetalle();
              // me.listarRed(1, "", "nombre");
              me.mensajeToast("Eliminado","bubble","check","danger");
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
    mensajeToast(msj,tema,icono,tp){
                let toast = this.$toasted.show(msj, { 
            theme: tema, 
            type: tp, 
            position: "top-right", 
            icon: icono, 
            duration : 2000
          });
    },
    mensaje(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    }
  },

  mounted() {

    this.getMpio();
    this.getFRed();
    this.listarDatos(1, this.buscar, this.criterio);
    // this.getDpto();
    // this.getRed();
    // this.getDiam();
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
  color: rgba(255, 162, 23, 0.849);
}
.material-icons.Color3 {
  color: rgb(12, 170, 91);
}
.material-icons.Color4 {
  color: rgba(228, 54, 54, 0.863);
}
</style>
