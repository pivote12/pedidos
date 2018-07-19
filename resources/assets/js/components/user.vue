<template>
  <main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Usuarios</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-primary btn-lg" v-on:click="createUsuario()">Crear Usuario</button>
      </div>
    </div>
    <div class="container">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
          <div class="mdl-card mdl-shadow--12dp" style="    width: 100%;">
            </div>
            <div class="mdl-card__supporting-text">
              Lista de Usuarios

            </div>
            <div class="mdl-card__supporting-text">
              <div class="table-responsive">
                <table class="table table-striped table-sm" style="width: 100%;">
                <thead>
                  <tr>
                    <th>id</th>
                    <th class="">Nombre</th>

                    <th>Correo</th>
                    <th>Rol</th>
                    <th class="">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="usuario in usuarios">
                    <td>{{usuario.id}}</td>
                    <td class="">{{usuario.name}}</td>
                    <td class="">{{usuario.email}}</td>
                    <td>{{usuario.roles.name}}</td>
                    <td>

                      <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"
                      v-on:click="editUsuario(usuario)">
                        <i class="material-icons">edit</i>
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"
                      v-on:click="deleteUsuario(usuario.id)">
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>

                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Create Usuario-->
      <div class="modal fade" id="createUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="width: 600px;">
            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger" v-if="errors.length > 0">
                  <ul>
                      <li v-for="error in errors">{{ error }}</li>
                  </ul>
              </div>
              <form id="form">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email"required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">nombre</label>
                    <input type="text" class="form-control" id="name" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputState">role</label>
                    <select id="rol" class="form-control" required>
                      <option v-for="rol in roles" :value="rol.id">{{rol.name}}</option>

                    </select>
                  </div>

                </div>


              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button v-on:click="sendCreateUser()" type="button" class="btn btn-primary" >Guardar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Edit Usuario-->
      <div class="modal fade" id="editusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="width: 600px;">
            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger" v-if="errors.length > 0">
                  <ul>
                      <li v-for="error in errors">{{ error }}</li>
                  </ul>
              </div>
              <form id="formEdit">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="emailEdit" placeholder="Email" :value="usuario.email" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="passwordEdit" placeholder="Password" :value="usuario.password" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">nombre</label>
                    <input type="text" class="form-control" id="nameEdit" :value="usuario.name" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputState">role</label>
                    <select id="rolEdit" class="form-control" v-model="role_id" required>
                      <option v-for="rol in roles" :value="rol.id">{{rol.name}}</option>

                    </select>
                  </div>

                </div>


              </form>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button v-on:click="ClientEditSend()" type="button" class="btn btn-primary" >Guardar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal delete Usuario-->
      <div class="modal fade" id="deleteusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="width: 600px;">
            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger" v-if="errors.length > 0">
                  <ul>
                      <li v-for="error in errors">{{ error }}</li>
                  </ul>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">

                  <span class="input-group-text" id="basic-addon1">ESTA SEGURO QUE DESEA BORRAR EL USUARIO?</span>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button v-on:click="sendDeleteUser()" type="button" class="btn btn-primary" >Guardar</button>
            </div>
          </div>
        </div>
      </div>

  </main>


</template>
<script>
    import axios from "axios";
    export default {
        data(){
            return {
              usuarios:[],
              usuario:[],
              roles:[],
              errors : [],
              role_id:"",
              user_id : ""
            }
        },
        mounted() {
          axios({ method: "GET", "url": "user" }).then(result => {
            //debugger;

              this.usuarios=result.data;

          }, error => {
              console.error(error);
          });
          axios({ method: "GET", "url": "getRoles" }).then(result => {
            //debugger;

              this.roles=result.data;

          }, error => {
              console.error(error);
          });


        },
        methods: {
          deleteUsuario(id)
          {
              this.errors = [];
              this.user_id = id;

              $('#deleteusuario').modal('show');
          },
          sendDeleteUser(){
            var me = this;
            axios.delete('user/'+this.user_id, {})
                .then(response => {

                    this.usuarios = response.data;
                    //$(e.target).parents('tr').remove();
                    this.exito('Eliminado');
                    $('#deleteusuario').modal('hide');
                    //console.log(response);

                })
                .catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.name) {
                        this.errors.push(error.response.data.errors.name[0]);
                    }

                    if (error.response.data.errors.description) {
                        this.errors.push(error.response.data.errors.description[0]);
                    }
                });
          },
          createUsuario(){
            $('#createUsuario').modal('show');

          },
          sendCreateUser(){
            let email = $('#email').val();
            let password = $('#password').val();
            let name = $('#name').val();
            let rol = $('#rol').val();
            let data = {
              email:email,
              password:password,
              name:name,
              rol:rol
            }
            axios.post('user', data)
                .then(response => {

                    this.usuarios = response.data;
                    //$(e.target).parents('tr').remove();
                    this.exito('Creado');
                     $('#email').val('');
                     $('#password').val('');
                    $('#name').val('');
                    $('#rol').val('');
                    $('#createUsuario').modal('hide');
                    //console.log(response);

                })
                .catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.name) {
                        this.errors.push(error.response.data.errors.name[0]);
                    }
                    if (error.response.data.errors.email) {
                        this.errors.push(error.response.data.errors.email[0]);
                    }
                    if (error.response.data.errors.password) {
                        this.errors.push(error.response.data.errors.password[0]);
                    }

                    if (error.response.data.errors.rol) {
                        this.errors.push(error.response.data.errors.rol[0]);
                    }
                });

          },
          editUsuario(usuario){
            this.usuario = usuario;
            this.role_id = usuario.roles.id;
            $('#editusuario').modal('show');
          },
          ClientEditSend(){
            let email = $('#emailEdit').val();
            let password = $('#passwordEdit').val();
            let name = $('#nameEdit').val();
            let rol = $('#rolEdit').val();
            let data = {
              email:email,
              password:password,
              name:name,
              rol:rol
            }
            axios.put('user/'+this.usuario.id, data)
                .then(response => {

                    this.usuarios = response.data;
                    //$(e.target).parents('tr').remove();
                    this.exito('Editado');
                    $('#editusuario').modal('hide');

                    //console.log(response);

                })
                .catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.name) {
                        this.errors.push(error.response.data.errors.name[0]);
                    }
                    if (error.response.data.errors.email) {
                        this.errors.push(error.response.data.errors.email[0]);
                    }
                    if (error.response.data.errors.password) {
                        this.errors.push(error.response.data.errors.password[0]);
                    }

                    if (error.response.data.errors.rol) {
                        this.errors.push(error.response.data.errors.rol[0]);
                    }
                });
          },
          exito(message)
          {
            swal({
              title: "",
              text: message+" Con Exito",
              icon: "success",
            });
          },
        }
    }
</script>
