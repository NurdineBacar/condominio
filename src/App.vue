<script setup>
import { RouterLink, RouterView, useRoute } from "vue-router";
import sidebar from "./components/sidebar.vue";
import heade from "./components/header.vue";
import sign from "./views/sign.vue";
import { ref, computed, onMounted } from "vue";
import notifications from "./components/notifications.vue";

const route = useRoute();
const dataUser = ref({});

const isHomeOrForgotPassword = computed(() => {
  return route.path === '/' || route.path === '/forgotPassword' || route.path === '/reset-password';
});

const handleUser = (data) => {
    dataUser.value = data;
};

// Carregar os dados do usuário ao montar o componente
onMounted(() => {
  const storedUser = localStorage.getItem('user');
  if (storedUser) {
    dataUser.value = JSON.parse(storedUser);
  }
});
</script>

<template>
  <div class="container-fluid bg-light my-2 ">
   <!--app-->
   <div class="row">
      <div class="col-md-auto" v-show="!isHomeOrForgotPassword">
        <sidebar :dataUser="dataUser"/>
      </div>
      <div class="col-md">
        <div class="row">
          <div class="col-md-12" v-show="!isHomeOrForgotPassword">
            <heade :dataUser="dataUser"/>
          </div>
          <div class="col-md-12">
            <RouterView @userData="handleUser"/>
          </div>
    </div>
      </div>
  </div>
  <notifications/>
  </div>
</template>

<style scoped>
</style>
