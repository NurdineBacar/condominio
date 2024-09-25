<script setup>
import { RouterLink, RouterView, useRoute } from "vue-router";
import sidebar from "./components/sidebar.vue";
import heade from "./components/header.vue";
import sign from "./views/sign.vue";
import { ref, computed } from "vue";
import notifications from "./components/notifications.vue";

const route = useRoute();
const isHomeOrForgotPassword = computed(() => {
  return route.path === '/' || route.path === '/forgotPassword';
});

</script>

<template>
  <div class="container-fluid bg-light my-2 ">
   <!--app-->
   <div class="row">
      <div class="col-md-auto" v-show="!isHomeOrForgotPassword">
        <sidebar/>
      </div>
      <div class="col-md">
        <div class="row">
          <div class="col-md-12" v-show="!isHomeOrForgotPassword">
            <heade page="Painel"/>
          </div>
          <div class="col-md-12">
            <RouterView/>
          </div>
    </div>
      </div>
  </div>
  <notifications/>
  </div>
</template>

<style scoped>
</style>
