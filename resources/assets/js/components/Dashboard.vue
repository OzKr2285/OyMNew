<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Perfil de Usuario
          <!-- <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button> -->
        </div>
        <template v-if="listado==1">
          <div class="card-body">
            <!-- <div class="md-layout">
              <div class="md-layout-item">
                <md-field md-clearable>
                  <label>Qué desea Buscar</label>
                  <md-input v-model="buscar" @keypress="listarDatos(1,buscar,criterio)"></md-input>
                </md-field>
              </div>&nbsp;&nbsp;&nbsp;
              <div class="md-layout-item">
                <br />
                <md-button
                  class="md-icon-button md-dense md-raised md-primary"
                  @click="listarDatos(1,buscar,criterio)"
                >
                  <md-icon>search</md-icon>
                </md-button>
              </div>
            </div> -->
            <!-- <label >Bienvenido! {{`${user}`}}</label> -->
            <!-- <label >Bienvenido! {{doc}}</label> -->
    
        <img src="img/logoEnercer.png" class="imgNew2">
        <br>
     <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mantenimientos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">40</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Gasto Insumos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Actividades</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Peticiones Pdtes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    <div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Solicitudes</h6>
        </div>
        <div class="card-body">
          <h4 class="small font-weight-bold">Cambio de Medidor<span class="float-right">20%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Cambio de Regulador <span class="float-right">40%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Conexión <span class="float-right">60%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Instalacion <span class="float-right">80%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Traslado <span class="float-right">Complete!</span></h4>
          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
              </div>
              </div>
  <div class="col-xl-6 col-md-6 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Solicitudes</h6>
        </div>
        <div class="card-body">
          <h4 class="small font-weight-bold">Cambio de Medidor<span class="float-right">20%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Cambio de Regulador <span class="float-right">40%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Conexión <span class="float-right">60%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Instalacion <span class="float-right">80%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Traslado <span class="float-right">Complete!</span></h4>
          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
              </div>
              </div>

          </div>


       <!-- <h1 :text="`${user}`"></h1> -->
          </div>
        </template>
        <template v-else-if="listado==0">
          <div>
               <button type="button" class="close" @click="abrirList" aria-label="Close">
              <span aria-hidden="true">X</span>
            </button>
          </div>
  <div
          class="uploader"
          @dragenter="OnDragEnter"
          @dragleave="OnDragLeave"
          @dragover.prevent
          @drop="onDrop"
          :class="{ dragging: isDragging }"
        >
          <div class="upload-control" v-show="images.length">
            <!-- <label for="file">Anexar otra Imágen</label> -->
            <button @click="upload">Cambiar</button>
            <button @click="abrirList">Cancelar</button>
          </div>

          <div v-show="!images.length">
            <i class="fa fa-cloud-upload"></i>
            <p>Arrastra tus imágenes aquí</p>
            <div>O</div>
            <div class="file-input">
              <label for="file">Selecciona una Imágen</label>
              <input type="file" id="file" @change="onInputChange" multiple>
            </div>
         
          </div>

          <div class="images-preview" v-show="images.length">
            <div class="img-wrapper" v-for="(image, index) in images" :key="index">
              <img :src="image" :alt="`Image Uplaoder ${index}`">
              <div class="details">
                <span class="name" v-text="files[index].name"></span>
                <span class="size" v-text="getFileSize(files[index].size)"></span>
              </div>
            </div>
          </div>
        </div>
        </template>
      </div>

      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->

    <!-- /.modal-dialog -->
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
            <button type="button" class="close" @click="cerrarModal2()" aria-label="Close">
              <span aria-hidden="true">X</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <md-card-content>
                <md-field>
                <label>Password</label>
                <md-input v-model="password" type="password" :disabled="sending"></md-input>
                </md-field>

                <md-field>
                <label>Confirme su Password</label>
                <md-input v-model="password2" type="password" :disabled="sending"></md-input>
                </md-field>
                <span
                class="md-error"
                v-if="!$v.password2.sameAspassword2"
                >El password NO coincide</span>
              </md-card-content>
            </form>
          </div>
          <div class="modal-footer">
            <md-card-actions>
              <md-button type="button" class="md-raised" @click="cerrarModal2()">Cerrar</md-button>
            </md-card-actions>
            <md-card-actions>
              <md-button
                type="submit"               
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="actualizarPw()"
              >Actualizar</md-button>
            </md-card-actions>

          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
  </main>
</template>

<script>
let user = document.head.querySelector('meta[name="user"]');
// console.log(user.content);
import { validationMixin } from "vuelidate";
// importar libreria
import Multiselect from "vue-multiselect";
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
import { required, minLength, email, sameAs } from "vuelidate/lib/validators";

export default {
  components: {
    Multiselect
  },
  mixins: [validationMixin],

  data() {
    return {

      form: {
        nombres: "",
        apellidos: "",
        email: "",
        email2: ""
      },
      demo: 0,
      tipoAccion: 1,
      listado: 1,
      sending: false,
      idMarca: 0,
      foto: "nn.png",
      modelo_id: 0,
      //variables imagen
      selectedFile: null,
      isDragging: false,
      dragCount: 0,
      files: [],
      images: [],

      arrayDatos: [],
      arrayImg: [],
      arrayPerso: [],
      arrayM: { id: 0, nombre: "" },
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      nombreFull: "",
      password: "",
      password2: "",

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
    password2: {
      sameAspassword2: sameAs("password")
    },
form: {
      nombres: {
        required
      },
      apellidos: {
        required
      },
      email: {
        email
      },
      email2: {
        sameAsemail2: sameAs("email")
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
      changeImg() {
        this.listado=0;
      },
      abrirList() {
        this.listado=1;
      },
      OnDragEnter(e) {
      e.preventDefault();

      this.dragCount++;
      this.isDragging = true;

      return false;
    },
    OnDragLeave(e) {
      e.preventDefault();
      this.dragCount--;

      if (this.dragCount <= 0) this.isDragging = false;
    },
    onInputChange(e) {
      const files = e.target.files;

      Array.from(files).forEach(file => this.addImage(file));
    },
    onDrop(e) {
      e.preventDefault();
      e.stopPropagation();

      this.isDragging = false;

      const files = e.dataTransfer.files;

      Array.from(files).forEach(file => this.addImage(file));
    },
    addImage(file) {
      if (!file.type.match("image.*")) {
        this.$toastr.e(`${file.name} is not an image`);
        return;
      }

      this.files.push(file);

      const img = new Image(),
        reader = new FileReader();

      reader.onload = e => this.images.push(e.target.result);

      reader.readAsDataURL(file);
    },
    getFileSize(size) {
      const fSExt = ["Bytes", "KB", "MB", "GB"];
      let i = 0;

      while (size > 900) {
        size /= 1024;
        i++;
      }
      return `${Math.round(size * 100) / 100} ${fSExt[i]}`;
    },
      getImage(event) {
      //Asignamos la imagen a  nuestra data
      // console.log(event)
      this.selectedFile = event.target.files[0];
      // this.upload();
    },
    onInputChange(e) {
      const files = e.target.files;

      Array.from(files).forEach(file => this.addImage(file));
    },
    upload() {
      let me = this;
      const formData = new FormData();

      this.files.forEach(file => {
        formData.append("images[]", file, file.name);
      });

      axios.post("/user/imagen", formData).then(response => {
        this.listado=1;
        this.getImg();
        me.mensaje("Guardado", "Todas las imagenes se han almacenado ");
       
        // this.$toastr.s("All images uplaoded successfully");
        this.images = [];
        this.files = [];
      });
    },
      getUsuario(buscar) {
      let me = this;
    
      var url = "/persona/getusuario?buscar=" + user.content;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayPerso = respuesta.perso;

            me.nombreFull = me.arrayPerso[0]["nombreFull"];

        })
        .catch(function(error) {
          console.log(error);
        });
    },
      getImg() {
      let me = this;
    
      var url = "/user/getImg?buscar=" + user.content;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayImg = respuesta.user;

            me.foto = me.arrayImg[0]["img"];

        })
        .catch(function(error) {
          console.log(error);
        });
    },
      actualizarPw() {
      let me = this;

      axios
        .put("/user/actualizarPw", {
          id: user.content,
          password: this.password
        
        })
        .then(function(response) {
          me.cerrarModal();
          me.mensaje("Actualizado", "Actualizó ");
          // me.listarPersona(1, "", "nombre");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
 
    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
    },
       abrirModal() {
      // this.idRefE=data["idref"];

      this.modal = 1;
      this.tituloModal = "Asigne un Password para "+ this.nombreFull;
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
    },
    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
    },

    mensaje(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    }
  },

  mounted() {
    this.getUsuario();
    this.getImg();

  }
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.col-auto {
  flex: 0 0 auto;
  width: auto;
  max-width: 100%;
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
.border-left-primary {
  border-left: 0.25rem solid #4e73df !important;
}

.border-bottom-primary {
  border-bottom: 0.25rem solid #4e73df !important;
}

.border-left-secondary {
  border-left: 0.25rem solid #858796 !important;
}

.border-bottom-secondary {
  border-bottom: 0.25rem solid #858796 !important;
}

.border-left-success {
  border-left: 0.25rem solid #1cc88a !important;
}

.border-bottom-success {
  border-bottom: 0.25rem solid #1cc88a !important;
}

.border-left-info {
  border-left: 0.25rem solid #36b9cc !important;
}

.border-bottom-info {
  border-bottom: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
  border-left: 0.25rem solid #f6c23e !important;
}

.border-bottom-warning {
  border-bottom: 0.25rem solid #f6c23e !important;
}

.border-left-danger {
  border-left: 0.25rem solid #e74a3b !important;
}

.border-bottom-danger {
  border-bottom: 0.25rem solid #e74a3b !important;
}

.border-left-light {
  border-left: 0.25rem solid #f8f9fc !important;
}

.border-bottom-light {
  border-bottom: 0.25rem solid #f8f9fc !important;
}

.border-left-dark {
  border-left: 0.25rem solid #5a5c69 !important;
}

.border-bottom-dark {
  border-bottom: 0.25rem solid #5a5c69 !important;
}
.text-gray-300 {
  color: #dddfeb !important;
}


.imgNew2 {
  max-height: 15%;
  max-width: 15%;
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
