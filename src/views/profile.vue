<template>
  <div class="row mt-1">
    <div class="col-md-3 py-4" id="data-profile">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="position-relative" id="img-profile">
            <button class=" btn rounded-circle" data-bs-toggle="modal" data-bs-target="#editU"><i class="fa-solid fa-pen"></i></button>
            <img :src="'img/profile/'+user.photo" width="110px" height="110px" class="rounded-circle mx-auto" alt=""/>
          </div>
          <h6 class="text-center mt-2">{{ user.name_user }}</h6>
          <span class="badge" id="typeUser">{{ user.typeUSer }}</span>
          
        </div>
      </div>
      <div class="row gap-2 justify-content-center mt-3">
        <div class="col-md-10 rounded-pill text-center py-1 user-data">
          <h6>Nome</h6>
          <span class="">{{ user.name_user }}</span>
        </div>
        <div class="col-md-10 rounded-pill text-center py-1 user-data">
          <h6>Contacto</h6>
          <span class="">{{ user.telephone }}</span>
        </div>
        <div class="col-md-10 rounded-pill text-center py-1 user-data">
          <h6>Email</h6>
          <span class="">{{ user.email }}</span>
        </div>
        <div class="col-md-10 rounded-pill text-center py-1 user-data" v-show="user.typeUSer =='morador'">
          <h6>Casa</h6>
          <span class="">Nº {{ user.nhouse }}</span>
        </div>
      </div>
    </div>

    <div class="col-md" v-show="user.typeUser=='morador'">
        <div class="container gap-2">
            <div class="row">
              <div class="col-md-6">
               <div class="d-flex gap-3">
                <uItem :val="listVisits.length" title="Visitas"/>
                <uItem :val="listReservation.length" title="Reservas" />
               </div>
            </div>
            <div class="col-md">
            <div class="d-flex gap-2 aligm-items-center" style="height: 100%;">
              <button class="btn w-100  fw-semibold py-1" style="height: 100%;" id="visit"  data-bs-toggle="modal" data-bs-target="#addVisit"><i class="fa-solid fa-plus fs-5"></i> Visita</button>
              <button class="btn w-100  fw-semibold py-1" style="height: 100%;" id="visit" @click="ficha"><i class="fa-solid fa-plus fs-5"></i> Ficha</button>
            </div>
            </div>
            </div>
            <div class="col-md-12 mt-3">
                <tProfile :user_id="user_id"/>
            </div>
        </div>
        <mVisit/>
    </div>
    <userEditModal />
  </div>
</template>

<script setup>
import uItem from "../components/uItem.vue";
import tProfile from "../components/tableProfile.vue";
import userEditModal from "../components/modals/modalEditProfile.vue";
import mVisit from "../components/modals/modalVisit.vue";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const user = ref('');
const user_id =ref(0);
const router = useRouter();
const listVisits=ref([]),
      listReservation=ref([]);
  

  const ficha = ()=>{
    router.push('/document');
  }

  const dataUser =ref(null);
  // Carrega os dados do usuário ao montar o componente
  onMounted(async () => {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
      user.value = JSON.parse(storedUser);
    } else {
      // Se o usuário não estiver logado, redireciona para a página de login
      router.push('/');
    }


    try{
    const response_1 = await fetch('http://localhost/condomino/src/backend/controllers/listVisits.php', { method: 'GET' });
    const json_1 = await response_1.json();
    const response_2 = await fetch('http://localhost/condomino/src/backend/controllers/listReservation.php', { method: 'GET' });
    const json_2 = await response_2.json();
    if (json_1.success && json_2.success) {
      listVisits.value = json_1.data;
      listReservation.value = json_2.data;
      console.log(listVisits.value)
      console.log(listReservation.value)
      console.log(user.value.id)
      user_id.value=user.value.id;
    } else {
      console.error('Erro na resposta:', json.message);
    }
    }catch(error){
      console.log("Erro ao consultar dados na bd");
    }
  });
</script>

<style scoped>
img {
  border: 2px solid rgba(128, 128, 128, 0.8);
  position: relative;
  left: 65px;
}

#data-profile{
    box-shadow: 0 0 5px rgba(0, 0, 0,.3),
    0 0 5px rgba(163, 163, 163,.5);
    background: white;
    border-radius: 10px;
    height: 440px;
}

#typeUser{
    margin-left: 90px;
    margin-top: 10px;
    background: var(--active-color);
}


#img-profile button {
  position: absolute;
  left: 140px;
  padding: 10px 12px;
  font-size: 13px;
  background: white;
  color: grayt;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3), 
                0 0 5px rgba(163, 163, 163, 0.5);
  z-index: 1;
}

#img-profile button:hover{
    transition: .32;
    background: rgb(231, 230, 230);
}

.user-data {
  border: 1px solid gray;
  background: rgba(218, 218, 218, 0.2);
  font-size: 13px;
}

.user-data h6{
    font-size: 13px;
    margin-bottom: -1px;
}


#visit{
    background: var(--inactive-color);
    color: var(--text-white);
  }

  #visit:hover{
    background: var(--active-color);
  }
</style>