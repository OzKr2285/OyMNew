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
        <div class="md-subhead">Usuario</div>
        </md-card-header-text>
         <md-menu md-size="big" md-direction="bottom-end">
          <md-button class="md-icon-button" md-menu-trigger>
            <md-icon>more_vert</md-icon>
          </md-button>

          <md-menu-content>
            <md-menu-item @click="abrirModal" >
              <span>Cambio de Clave</span>
              <md-icon>vpn_key</md-icon>
            </md-menu-item>
            <md-menu-item @click="changeImg">
              <span>Cambio de Imagen</span>
              <md-icon>face</md-icon>
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
        <md-card md-with-hover>
      <md-ripple>
        <md-card-header>
          <div class="md-title">Información Personal</div>
          <div class="md-subhead">Actualice sus datos</div>
        </md-card-header>

        <md-card-content>

                  <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('nombres')">
                      <label for="first-name">Nombres</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nombres"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.nombres.required"
                      >Es necesario ingresar un Nombre</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('apellidos')">
                      <label for="first-ape">Apellidos</label>
                      <md-input
                        name="first-ape"
                        id="first-ape"
                        autocomplete="given-name"
                        v-model="form.apellidos"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.apellidos.required"
                      >Es necesario ingresar un Apellido</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>
                  </div>
                  <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label>Celular</label>
                      <span class="md-prefix">
                        <i class="material-icons">phone_iphone</i>
                      </span>
                      <md-input v-model="telefono" md-counter="10" maxlength="10"></md-input>
                    </md-field>
                  </div>
                  <div class="md-layout-item">
                    <md-datepicker
                      v-model="fecNac"
                      value="fecNac"
                      @input="toString"
                      md-immediately
                      :md-model-type="String"
                    >
                      <label>Fecha de Cumpleaños</label>
                    </md-datepicker>
                  </div>
                  </div>
                  <div class="md-layout">
                    <md-field md-clearable>
                      <label>Dirección</label>
                      <span class="md-prefix">
                        <i class="material-icons">house</i>
                      </span>
                      <md-input v-model="direccion"></md-input>
                    </md-field>
                  </div>
                  <div class="md-layout">
                    <md-field md-clearable :class="getValidationClass('email')">
                      <label>E-mail</label>
                      <span class="md-prefix">
                        <i class="material-icons">email</i>
                      </span>
                      <md-input v-model="form.email" md-counter="80"></md-input>
                      <span class="md-error" v-if="!$v.form.email.email">Email incorrecto</span>
                    </md-field>
                  </div>

        </md-card-content>

            <md-card-actions>
              <md-button
                type="submit"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="abrirModal()"
              >Actualizar</md-button>
            </md-card-actions>
      </md-ripple>
    </md-card>
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
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
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
              <md-button type="button" class="md-raised" @click="cerrarModal()">Cerrar</md-button>
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
  MdRipple,
  MdList
} from "vue-material/dist/components";
// import VueMaterial from 'vue-material'
// Vue.use(VueMaterial)
Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdRipple);
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
      direccion: "",
      telefono: "",
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
      fecNac: "",

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
            me.form.nombres = me.arrayPerso[0]["nombres"];
            me.form.apellidos = me.arrayPerso[0]["apellidos"];
            me.telefono = me.arrayPerso[0]["telefono"];
            me.direccion = me.arrayPerso[0]["direccion"];
            me.form.email = me.arrayPerso[0]["email"];

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
  .md-card {
    width: 45%;
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
