<template>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item" v-for="menu in menus">
      <router-link :to="menu.title" class="nav-link">{{ menu.title }}</router-link>
    </li>

  </ul>
  

</template>
<script>
    import axios from "axios";
    export default {
        data(){
            return {
              menus:[],
              role_id:""
            }
        },
        mounted() {
          axios({ method: "GET", "url": "getRoleId" }).then(result => {
            //debugger;
             this.menus.push({title:'clientes'});
             if(result.data == 1)
             this.menus.push({title:'users'});
              console.log(this.role_id);
          }, error => {
              console.error(error);
          });



        },
        methods: {

        }
    }
</script>
