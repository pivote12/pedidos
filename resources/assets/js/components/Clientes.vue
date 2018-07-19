<style media="screen">
.fullwidth {
  width: 100%;
}
</style>

<template>
  <main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Clientes</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-primary btn-lg" v-on:click="createCliente()" v-if="role_id == 1">Crear Cliente</button>
      </div>
    </div>
    <div class="container">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
          <div class="mdl-card mdl-shadow--12dp" style="    width: 100%;">
            </div>
            <div class="mdl-card__supporting-text">
              Lista de clientes

            </div>
            <div class="mdl-card__supporting-text">
              <div class="table-responsive">
                <table class="table table-striped table-sm" style="width: 100%;">
                <thead>
                  <tr>
                    <th>id</th>
                    <th class="">Nombre</th>
                    <th>Cantidad De Pedidos</th>
                    <th class="">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cliente in clientes">
                    <td>{{cliente.id}}</td>
                    <td class="">{{cliente.name}}</td>
                    <td>{{cliente.pedidos_count}}</td>
                    <td>
                      <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"
                      v-on:click="getPedidos(cliente)">
                        <i class="material-icons">eject</i>
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"
                      v-on:click="editCliente(cliente)">
                        <i class="material-icons">edit</i>
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"
                      v-on:click="DeleteClientes(cliente.id)">
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


      <!-- Modal Show Pedidos-->
      <div class="modal fade" id="showpedidos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="width: 600px;">
            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel">Pedidos de {{pedidos.name}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table id="example" class="table table-striped table-sm" style="width:100%">
                <thead>
                  <tr>
                    <th class="">id</th>
                    <th class="" >Descripcion</th>
                    <th class="">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <div class="alert alert-danger" v-if="errors.length > 0">
                      <ul>
                          <li v-for="error in errors">{{ error }}</li>
                      </ul>
                  </div>
                  <tr class="createPedido" style="display:none;">
                    <td></td>
                    <td><div class="form-group text" >
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                      <button type="button" class="btn btn-primary btn-sm" style="margin-left: 36%;"v-on:click="sendCreatePedido($event)"><i class="material-icons">check</i></button>
                      <button type="button" class="btn btn-danger btn-sm" style="margin-left: 4%;" v-on:click="cancelcreatePedido($event)"><i class="material-icons">cancel</i></button>
                    </div></td>
                    <td></td>

                  </tr>
                  <tr v-for="pedido in pedidos.pedidos">
                      <td>{{pedido.id}}</td>
                    <td class=""><div class="showText">
                      {{pedido.descripcion}}
                    </div>
                      <div class="form-group text" style="display:none;">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{pedido.descripcion}}</textarea>
                        <button type="button" class="btn btn-primary btn-sm" style="margin-left: 36%;"v-on:click="sendEditPedido($event)"><i class="material-icons">check</i></button>
                        <button type="button" class="btn btn-danger btn-sm" style="margin-left: 4%;" v-on:click="cancelEditPedido($event)"><i class="material-icons">cancel</i></button>
                      </div>
                    </td>
                    <td>


                      <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"
                      v-on:click="editPedido(pedidos,pedido,$event)">
                        <i class="material-icons">edit</i>
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"
                      v-on:click="deletePedido(pedidos,pedido,$event)">
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" style="margin-left: 36%;"v-on:click="showCreatePedido($event)">Crear Nuevo Pedido</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Edit CLiente-->
      <div class="modal fade" id="editarcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <div class="input-group mb-3">
                <div class="input-group-prepend">

                  <span class="input-group-text" id="basic-addon1">Nombre</span>
                </div>
                <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1"
                v-model="clienteName">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button v-on:click="ClientEditSend()" type="button" class="btn btn-primary" >Guardar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal delete CLiente-->
      <div class="modal fade" id="showdeleteclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                  <span class="input-group-text" id="basic-addon1">ESTA SEGURO QUE DESEA BORRAR EL CLIENTE?</span>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button v-on:click="sendDeleteClient()" type="button" class="btn btn-primary" >Guardar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Create CLiente-->
      <div class="modal fade" id="createcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="width: 600px;">
            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel">Crear</h5>
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

                  <span class="input-group-text" id="basic-addon1">Nombre</span>
                </div>
                <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="createclientname">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button v-on:click="sendCreateClient()" type="button" class="btn btn-primary" >Guardar</button>
            </div>
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
                clientes: [],
                errors: [],
                pedidos:[],
                client_id : "",
                clienteName:"",
                role_id:"",
                pedido_id:"",
                result:[]
            }
        },
        mounted() {
            axios({ method: "GET", "url": "clientes" }).then(result => {
                this.clientes = result.data;
            }, error => {
                console.error(error);
            });
            axios({ method: "GET", "url": "getRoleId" }).then(result => {
                this.role_id = result.data;
                console.log(this.role_id);
            }, error => {
                console.error(error);
            });
        },
        methods: {
            DeleteClientes(id)
            {
                this.errors = [];
                this.client_id = id;
                console.log(this.client_id);
                $('#showdeleteclient').modal('show');
            },
            getPedidos(cliente)
            {
                this.errors = [];
                this.pedidos = cliente;
                this.client_id = cliente.id;
                $('#showpedidos').modal('show');
            },

            editCliente(cliente)
            {
             this.errors = [];
             this.clienteName = cliente.name;
             this.client_id = cliente.id;
             $('#editarcliente').modal('show');
            },
            ClientEditSend()
            {
                this.errors = [];
                if(!/^[A-Za-z\s]+$/.test(this.clienteName)){
                  this.errors.push('Tiene caracteres no correspondidos');
                  return false;
                }
                let ClientName = this.clienteName;

                axios.put('clientes/'+this.client_id, {
                    name: ClientName,
                })
                    .then(response => {

                        this.clientes = response.data;
                        $('#editarcliente').modal('hide');
                        this.exito('Editado');
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
            editPedido(clientes,pedido,e)
            {
              $($($(e.target).parents('tr').children()[1]).children()[0]).hide();
              $($($(e.target).parents('tr').children()[1]).children()[1]).show();

              this.pedido_id = pedido.id;

            },
            sendEditPedido(e){
              let descripcion = $(e.target).parents('.text').children('textarea').val();
              if(this.isEmpty(descripcion)){
                this.errors.push('No puede estar vacio');
                return false;
              }
              var me = this;
              axios.put('pedidos/'+this.pedido_id, {
                  client_id: this.client_id,
                  descripcion:descripcion
              })
                  .then(response => {

                      this.clientes = response.data;
                      this.pedidos = response.data[me.client_id-1];
                      $($($(e.target).parents('tr').children()[1]).children()[0]).show();
                      $($($(e.target).parents('tr').children()[1]).children()[1]).hide();
                      this.exito('Editado');
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
            cancelEditPedido(e){

              $($($(e.target).parents('tr').children()[1]).children()[0]).show();
              $($($(e.target).parents('tr').children()[1]).children()[1]).hide();
            },
            cancelcreatePedido(e){

              $(e.target).parents('tr').hide();
            },
            deletePedido(clientes,pedido,e){
                var me = this;
              axios.delete('pedidos/'+pedido.id, {})
                  .then(response => {

                      this.clientes = response.data;
                      this.pedidos = me.searchMethod(response.data,me.client_id);
                      //$(e.target).parents('tr').remove();
                      this.exito('Eliminado');
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
            sendDeleteClient(){
              var me = this;
              axios.delete('clientes/'+this.client_id, {})
                  .then(response => {
                      if(response.data == 'false'){
                        this.errors.push('No se pudo eliminar Tiene pedidos');
                        return false;
                      }
                      this.clientes = response.data;
                      //$(e.target).parents('tr').remove();
                      this.exito('Eliminado');
                      $('#showdeleteclient').modal('hide');
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

            showCreatePedido(e){
              $(e.target).parents('.modal-content').children('.modal-body').find('tr.createPedido').show();
              //debugger;
            },
            sendCreatePedido(e){
              let descripcion = $(e.target).parents('.text').children('textarea').val();
              if(this.isEmpty(descripcion)){
                this.errors.push('No puede estar vacio');
                return false;
              }
              var me = this;
              axios.post('pedidos', {
                  descripcion: descripcion,
                  client_id:this.client_id
              })
                  .then(response => {

                      this.clientes = response.data;
                      this.pedidos = me.searchMethod(response.data,me.client_id);
                      $(e.target).parents('tr').hide();
                      $(e.target).parents('.text').children('textarea').val('');
                      this.exito('Creado');
                      //let id = me.client_id;

                      //console.log(response);

                  })
                  .catch(error => {
                      this.errors = [];
                      if (error.response.data.errors.email) {
                          this.errors.push(error.response.data.errors.name[0]);
                      }

                      if (error.response.data.errors.description) {
                          this.errors.push(error.response.data.errors.description[0]);
                      }
                  });
            },
            createCliente(){
              $('#createcliente').modal('show');
            },
            sendCreateClient(){
              let name = $('#createclientname').val();
              axios.post('clientes', {
                  name: name
              })
                  .then(response => {

                      this.clientes = response.data;

                      this.exito('Creado');
                        $('#createcliente').modal('hide');
                      //let id = me.client_id;

                      //console.log(response);

                  })
                  .catch(error => {
                      this.errors = [];
                      if (error.response.data.errors.email) {
                          this.errors.push(error.response.data.errors.name[0]);
                      }

                      if (error.response.data.errors.description) {
                          this.errors.push(error.response.data.errors.description[0]);
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
            isEmpty(str)
            {
              if(str=='')
                return true;

              return false;
            },
            searchMethod(objects,client_id){
              for(var i=0; i<objects.length; i++) {
                if(objects[i].id == client_id)
                  return objects[i];
              }
            }
        }
    }
</script>
