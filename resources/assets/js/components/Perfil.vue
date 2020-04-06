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
      <md-card>
        <md-card-header>
        <md-card-header-text>
          <div class="md-title">{{nombreFull}}</div>
        <div class="md-subhead">Subtitle here</div>
        </md-card-header-text>
         <md-menu md-size="big" md-direction="bottom-end">
          <md-button class="md-icon-button" md-menu-trigger>
            <md-icon>more_vert</md-icon>
          </md-button>

          <md-menu-content>
            <md-menu-item @click="changeImg" >
              <span>Cambio de Clave</span>
              <md-icon>phone</md-icon>
            </md-menu-item>
            <md-menu-item @click="changeImg">
              <span>Cambio de Imagen</span>
              <md-icon>phone</md-icon>
            </md-menu-item>

          </md-menu-content>
        </md-menu>
           </md-card-header>
      <md-card-media>
        <img :src="'img/avatars/'+ this.foto" alt="People" class="imgNew">
      </md-card-media>
      <md-card-expand>
        <md-card-actions md-alignment="space-between">
      

          <md-card-expand-trigger>
            <md-button class="md-icon-button">
              <md-icon>keyboard_arrow_down</md-icon>
            </md-button>
          </md-card-expand-trigger>
        </md-card-actions>

        <md-card-expand-content>
          <md-card-content>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio itaque ea, nostrum odio. Dolores, sed accusantium quasi non, voluptas eius illo quas, saepe voluptate pariatur in deleniti minus sint. Excepturi.
          </md-card-content>
        </md-card-expand-content>
      </md-card-expand>
    </md-card>
       <!-- <h1 :text="`${user}`"></h1> -->
          </div>
        </template>
        <template v-else-if="listado==0">
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
import { required, minLength } from "vuelidate/lib/validators";

export default {
  components: {
    Multiselect
  },
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
      arrayModelo: [],
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      nombreFull: "",

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

    //   nameWithLang ({ nombre, id }) {
    //   return `${nombre} — [${id}]`
    // },

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
    // onUpload() {
    //   let me = this;
    //   const formData = new FormData();

    //   this.files.forEach(file => {
    //     formData.append("images[]", file, file.name);
    //   });

    //   axios.put("/user/imagen", formData).then(response => {
    //     me.mensaje("Guardado", "Todas las imagenes se han almacenado ");
    //     // this.$toastr.s("All images uplaoded successfully");
    //     this.images = [];
    //     this.files = [];
    //   });
    // },

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
    validarDatos() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        this.registrarModelo();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
    },
    getMarca() {
      let me = this;

      var url = "/marca/selectMarca";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayMarca = respuesta.marca;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getModelo() {
      let me = this;

      var url = "/modelo/selectModelo?buscar=" + this.idMarca;
      axios
        .get(url)
        .then(function(response) {
          let respuesta = response.data;
          me.arrayModelo = respuesta.modelo;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    mostrarActualizar(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.arrayM.id = data["idMarca"]),
      (this.arrayM.nombre = data["nommarca"]),
        (this.modelo_id = data["id"]),
        (this.form.nombre = data["nombre"]);
    },
    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
    },
    listarDatos(page, buscar, criterio) {
      let me = this;
      var url =
        "/modelo?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayDatos = respuesta.datos.data;
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
      me.listarDatos(page, buscar, criterio);
    },
    registrarModelo() {
      let me = this;

      axios
        .post("/modelo/registrar", {
          idMarca: this.arrayM.id,
          nombre: this.form.nombre.toUpperCase()
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarDatos(1, "", "nombre");
          me.mensaje("Guardado", "Guardo ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarModelo() {
      let me = this;

      axios
        .put("/modelo/actualizar", {
          idMarca: this.arrayM.id,
          nombre: this.form.nombre.toUpperCase(),
          id: this.modelo_id
        })
        .then(function(response) {
          me.ocultarDetalle();
          me.listarDatos(1, "", "nombre");
          me.mensaje("Actualizado", "Actualizó ");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    eliminarModelo(data = []) {
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
          this.modelo_id = data["id"];
          axios
            .post("/modelo/eliminar", {
              id: this.modelo_id
            })
            .then(function(response) {
              me.ocultarDetalle();
              me.listarDatos(1, "", "nombre");
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
    this.getUsuario();
    this.getImg();
    this.listarDatos(1, this.buscar, this.criterio);
  }
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
  .md-card {
    width: 420px;
    margin: 4px;
    display: inline-block;
    vertical-align: top;
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
.uploader {
  width: 100%;
  background: #2196f3;
  color: #fff;
  padding: 40px 15px;
  text-align: center;
  border-radius: 10px;
  border: 3px dashed #fff;
  font-size: 20px;
  position: relative;
}
.uploader:dragging {
  background: #fff;
  color: #2196f3;
  border: 3px dashed #2196f3;
}

i.fa.fa-cloud-upload {
  font-size: 58px;
}
.file-input {
  width: 200px;
  margin: auto;
  height: 68px;
  position: relative;
}
.file-input label {
  background: #fff;
  color: #2196f3;
  width: 105%;
  position: absolute;
  left: 0;
  top: 0;
  padding: 10px;
  border-radius: 4px;
  margin-top: 7px;
  cursor: pointer;
}

.file-input input {
  opacity: 0;
  z-index: -2;
}

.images-preview {
  display: flex;
  flex-wrap: wrap;
  margin-top: 20px;
}

.img-wrapper {
  width: 160px;
  display: flex;
  flex-direction: column;
  margin: 10px;
  height: 150px;
  justify-content: space-between;
  background: #fff;
  box-shadow: 5px 5px 20px #3e3737;
}
.img {
  max-height: 105px;
}
.imgNew {
  max-height: 300px;
}
.details {
  font-size: 12px;
  background: #fff;
  color: #000;
  display: flex;
  flex-direction: column;
  align-items: self-start;
  padding: 3px 6px;
}
.name {
  overflow: hidden;
  height: 18px;
}

.upload-control {
  position: absolute;
  width: 100%;
  background: #fff;
  top: 0;
  left: 0;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
  padding: 10px;
  padding-bottom: 4px;
  text-align: right;
}
.upload-control button {
  background: #3ab458;
  border: 2px solid #3ab458;
  border-radius: 3px;
  color: #fff;
  font-size: 15px;
  cursor: pointer;
}
.upload-control label {
  background: #F5A528;
  border: 2px solid #F5A528;
  border-radius: 3px;
  color: #fff;
  font-size: 15px;
  cursor: pointer;
  padding: 2px 5px;
  margin-right: 10px;
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
