<template>
  <div class="row py-2 align-items-center">
    <div class="col-md">
        <!-- <h4>{{ page }}</h4> -->
    </div>
    <div class="col-md-auto  align-self-end">
      <div class="d-flex align-items-center">
        <!-- <span><i class="fa-regular fa-moon fs-5"></i></span> -->
        <button type="button" class="btn position-relative me-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <i class="fa-regular fa-bell fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
             +
            <span class="visually-hidden">unread messages</span>
          </span>
        </button>

        <div class="d-flex align-items-center">
            <span class="mx-2 badge text-dark">{{ dataUser.name_user }}</span>
            <img src="/img/profile/user-profile.png" class="rounded-circle" width="35px" height="35px" alt="">
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// import { store } from "../store";
import { ref, onMounted, defineProps } from "vue";

const props = defineProps(['page','dataUser'])
const user=ref('');

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

</script>

<style scoped>
    img{
        border: 1px solid var(--profile-border-color);
    }
</style>