<template>
    <div class="row mt-2 px-2">
        <div class="col-md-7">
           <ul class="d-flex gap-5 align-items-center">
            <li class="fw-semibold">Casas: <span class="py-1 px-2 rounded-circle text-white text-center" data-state="all">{{ listHouses.length }}</span></li>
            <!-- <li class="fw-semibold">Activos: <span class="py-1 px-2 rounded-circle text-white text-center" data-state="active">4</span></li>
            <li class="fw-semibold">Inativos: <span class="py-1 px-2 rounded-circle text-white text-center" data-state="inactive">4</span></li> -->
           </ul>
        </div>
        <div class="col-md-5 align-self-end">
            <div class="d-flex gap-2 justify-content-end">
                <button class="btn" id="nova" data-bs-toggle="modal" data-bs-target="#houseModal"><i class="fa-solid fa-house-medical"></i> Nova</button>
                <inputs input-type="search"  p-holder="Nº casa ou Morador" icon="fa-solid fa-magnifying-glass" v-model="search"/>
                <!-- <cSelect class="w-25" :opts="filtro"/> -->
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="row" id="houses">
                <div class="col-md-3 mb-3" v-for="house in searcFiltre" :key="house.id">
                    <house :home="house" @update-house="handleDataHouse"/>
                </div>
                <div class="col-md-3 mb-3">
                    <addHouse/>
                </div>
                
            </div>
        </div>
        <houseModal/>
        <userModal/>
        <userListModal :house="selectedHouse" v-if="selectedHouse" />
        <mviewlh :view="dataHouse"/>
    </div>
</template>

<script setup>
import inputs from "../components/inputs.vue";
import cSelect from "../components/cSelect.vue";
import house from "../components/house.vue";
import addHouse from "../components/addHouse.vue";
import houseModal from "../components/houseModal.vue";
import userModal from "../components/userModal.vue";
// import UserListModal from "../components/UserListModal.vue";
// import userList from "../components/modals/userListModal.vue";
import mviewlh from "../components/modals/modalViewUsersHouse.vue";
import { ref, onMounted, computed } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();

const listHouses= ref([]);
const search = ref('');
const dataHouse= ref({
    casa: '',
});


onMounted(async () => {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
      user.value = JSON.parse(storedUser);
    } else {
      // Se o usuário não estiver logado, redireciona para a página de login
      router.push('/');
    }

  try {
    const response = await fetch('http://localhost/condomino/src/backend/controllers/listHouse.php', { method: 'GET' });
    const json = await response.json();
    if (json.success) {
      listHouses.value = json.data;
      console.log(listHouses.value)
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }

  console.log(listHouses)
});

// const filteredReservation = computed(() => {
//   return listReservation.value.filter(reserva =>
//   seletedUser.value === '' || user.typeUser === seletedUser.value
//   );
// });

const searcFiltre= computed(()=>{
  return listHouses.value.filter(house =>
  house.nhouse.toLowerCase().includes(search.value.toLowerCase()) || search.value == house.casa || search.value ==''
  )
});

let filtro=[
    {val:"activo",name:"activo"},
    {val:"inactivo",name:"intativo"},
]

const handleDataHouse = (data) => {
    console.log(data);
    dataHouse.value = 
    dataHouse.value = data;
}
</script>

<style scoped>
ul{
    padding: 0;
}
    ul li{
        list-style: none;
    }

    ul li span{
        font-size: 12px;
    }

    #houses{
        padding: 5px 2px;
        height: 78vh;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: transparent transparent;
    }

    #nova{
        height: 40px;
        padding: auto;
        width: 100px;
    }

    span[data-state="active"]{
        background: var(--active-house);
    }
    span[data-state="inactive"]{
        background: var(--inactive-house);
    }
    span[data-state="all"]{
        background: var(--inactive-color);
    }

    .btn{
    background: var(--inactive-color);
    color: var(--text-white);
  }

  .btn:hover{
    background: var(--active-color);
  }
</style>