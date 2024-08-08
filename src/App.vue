<script setup>
import { RouterLink, RouterView } from 'vue-router'
import sidebar from "./components/sidebar.vue";
import heade from "./components/header.vue";
import sign from "./views/sign.vue";
import { ref } from "vue";

let login= ref(false)

function logr(){
  login.value=true;
}

function logout(){
  login.value=false;
}

</script>

<template>
  <div class="container-fluid bg-light my-2 ">
   <!--Sign in-->
   <div class="row" v-show="login==false">
    <sign @logar="logr" />
   </div>

   <!--app-->
   <div class="row" v-show="login">
      <div class="col-md-auto">
        <sidebar  @logout="logout"/>
      </div>
      <div class="col-md">
        <div class="row">
          <div class="col-md-12">
            <heade page="Painel"/>
          </div>
          <div class="col-md-12">
            <RouterView/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
