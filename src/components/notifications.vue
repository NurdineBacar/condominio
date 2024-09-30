<template>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Notificacoes</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
      <div class="row">
        <div class="col-md-12 ps-3 mb-2">
          <a href="" class="d-flex align-items-center gap-3 justify-content-center p-2 rounded" v-for="notification in lnotifications" :key="notification.id">
            <img src="/public//img/profile/user-profile.png" width="45px" height="45px" class="rounded-circle" alt="" v-show="notification.typeUser=='morador'">
            <span id="icon"><i class="fa-solid fa-building fs-2" v-show="notification.typeUser =='admin'"></i></span>
            <span><b>{{ notification.typeUser =='admin'? 'Condominio': notification.usuario_nome  }}</b> {{ notification.typeUser =='admin'? 'publicou um aviso sobre': 'fez um pedido de rerva'  }} <b>{{ notification.tipo }}</b> <span class="hora text-secondary">{{ notification.data_criacao }}</span></span>          
          </a>
        </div>
      </div>
  </div>
</div>
</template>

<script setup>
import { ref,onMounted } from "vue";

const lnotifications = ref([]);
onMounted(async () => {
  try {
    const response = await fetch('http://localhost/condomino/src/backend/controllers/notf/listNotification.php', { method: 'GET' });
    const json = await response.json();
    if (json.success) {
      lnotifications.value = json.data;
      console.log(lnotifications.value)
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }

});
</script>


<style scoped>
    a{
      text-decoration: none;
      color: black;
    }

    a:hover, .notification:hover{
      background: rgb(233, 231, 231);
      transition: .2s ease-in;
      cursor: pointer;
    }
 
    #icon{
      color: var(--active-color);
    }

    .btn{
      font-size: 12px;
      font-weight: 600;
    }

    .hora{
      font-size: 13px;
      font-weight: 700;
    }
</style>