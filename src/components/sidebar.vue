<template>
  <div class="rounded py-3 position-relative bg-white" id="nav">
    <h6 class="text-center mt-3">
      <i class="fa-solid fa-building-columns fs-3"></i>
    </h6>
    <h5 class="text-center">Vila Olimpica</h5>
    <div class="row px-3 g-1 mt-3">
      <div class="col-md-12 my-2" v-show="dataUser.typeUser != 'seguranca'">
        <RouterLink
          to="/home"
          class="navLink"
          @click="limpar(e)"
          ><i class="fa-solid fa-home me-2"></i>Painel</RouterLink
        >
      </div>
      <div class="col-md-12 my-2" v-show="dataUser.typeUser != 'seguranca'">
        <RouterLink to="/reservation" class="navLink" @click="reser = 'active'"
          ><i class="fa-solid fa-calendar-plus me-2"></i>Reservas</RouterLink
        >
      </div>
      <div class="col-md-12 my-2" v-show="dataUser.typeUser != 'seguranca'">
        <RouterLink to="/warning" class="navLink" data-status=""
          ><i class="fa-solid fa-triangle-exclamation me-2"></i
          >Avisos</RouterLink
        >
      </div>
      <div class="col-md-12 my-2" v-show="dataUser.typeUser != 'morador'">
        <RouterLink to="/security" class="navLink" data-status=""
          ><i class="fa-solid fa-shield me-2"></i>Segurança</RouterLink
        >
      </div>
      <div class="col-md-12 my-2" v-show="dataUser.typeUser == 'admin'">
        <RouterLink to="/house" class="navLink" data-status=""
          ><i class="fa-solid fa-house-user me-2"></i>Casas</RouterLink
        >
      </div>
      <div class="col-md-12 my-2" v-show="dataUser.typeUser != 'seguranca'">
        <RouterLink to="/profile" class="navLink" data-status=""
          ><i class="fa-solid fa-user me-2"></i>Perfil</RouterLink
        >
      </div>
      <div class="col-md-12 my-2" v-show="dataUser.typeUser == 'admin'">
        <RouterLink to="/users" class="navLink" data-status=""
          ><i class="fa-solid fa-users me-2"></i>Usuários</RouterLink
        >
      </div>
      <div class="col-md-12 my-2" v-show="dataUser.typeUser != 'seguranca'">
        <RouterLink to="/documents" class="navLink" data-status=""
          ><i class="fa-solid fa-file-lines me-2"></i>Documentos</RouterLink
        >
      </div>
    </div>

    <div class="row justify-content-center py-3 rounded flex-wrap" id="box1">
      <div class="col-md-10 ms-2 mb-2">
        <a href="" @click.prevent="logout" id="logout"
          ><i class="fa-solid fa-right-from-bracket"></i> Terminar sessão</a
        >
      </div>
      <div class="col-md-12 px-2">
        <span class="badge" id="badge">{{ dataUser.email }}</span>
      </div>
    </div>
  </div>
</template>
  
  <script setup>
import { RouterLink, useRouter } from "vue-router";
import { ref, onMounted, defineProps } from "vue";

const router = useRouter();
const user = ref("");
const props = defineProps(["dataUser"]);

// Carrega os dados do usuário ao montar o componente
onMounted(async () => {
  const storedUser = localStorage.getItem("user");
  if (storedUser) {
    user.value = JSON.parse(storedUser);
  }
  try {
  } catch (error) {
    console.log("Erro ao buscar dados", error);
  }
});

const logout = () => {
  localStorage.removeItem("user"); // Remove o usuário do localStorage
  user.value = null; // Limpa a ref do usuário
  router.push("/"); // Redireciona para a página de login
};
</script>
  
  <style scoped>
#nav {
  width: 220px;
  height: 97vh;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(163, 163, 163, 0.5);
}

.navLink {
  text-decoration: none;
  font-weight: 600;
  padding-left: 15px;
  border-left: 2px solid white;
  padding-top: 5px;
  padding-bottom: 5px;
  color: var(--inactive-color);
}

.router-link-active.navLink {
  border-color: var(--active-color);
  color: var(--active-color);
}

.navLink:hover {
  color: var(--active-color);
}

#box1 a {
  text-decoration: none;
  font-weight: 600;
  color: var(--text-white);
}

#box1 a:hover {
  color: var(--active-color);
}

#box1 {
  position: absolute;
  bottom: 10px;
  left: 20px;
  width: 200px;
  background: var(--inactive-color);
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(163, 163, 163, 0.5);
}

#badge {
  background: var(--active-color);
  text-wrap: wrap;
}
</style>
  