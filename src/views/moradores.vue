<template>
  <div class="">
    <div class="row mt-1">
      <div class="col-md">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="morador" v-model="seletedUser" checked/>
          <label class="btn btnList" for="btnradio1">Moradores</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="seguranca" v-model="seletedUser" autocomplete="off"/>
          <label class="btn btnList" for="btnradio2">Segurancas</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" value="admin" v-model="seletedUser" autocomplete="off"/>
          <label class="btn btnList" for="btnradio3">Admins</label>
        </div>
      </div>
      <div class="col-md">
           <div class="d-flex gap-1 justify-content-end">
            <button class="btn fw-semibold" data-bs-toggle="modal" data-bs-target="#userModal"><i class="fa-solid fa-user-plus"></i> Novo</button>
            <inputs input-type="search" icon="fa-solid fa-magnifying-glass" pHolder="Morador e Nº casa..." v-model="search" />
            <cSelect :opts="sort" class="w-25"/>
           </div>
      </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12" id="table">
            <users class="w-100" :users="search.length>0? searcFiltre : filteredUsers"/>
        </div>
    </div>
    <uModal/>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import axios from 'axios';
import cSelect from "../components/cSelect.vue";
import users from "../components/tableUsers.vue";
import uModal from "../components/userModal.vue";
import inputs from "../components/inputs.vue";

const seletedUser = ref('morador'); // Correção da variável
let search=ref('')

const sort = [
  { val: "activo", name: 'activo' },
  { val: "inativo", name: 'inativo' }
];

const lusers = ref([]);

onMounted(async () => {
  try {
    const response = await fetch('http://localhost/condomino/src/backend/controllers/listUsers.php', { method: 'GET' });
    const json = await response.json();
    if (json.success) {
      lusers.value = json.data;
      console.log(lusers.value)
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }
});

// Computed property para filtrar os usuários
const filteredUsers = computed(() => {
  return lusers.value.filter(user =>
  seletedUser.value === '' || user.typeUser === seletedUser.value
  );
});

const searcFiltre= computed(()=>{
  return lusers.value.filter(user =>
  user.name_user.toLowerCase().includes(search.value.toLowerCase()) || search.value == user.nhouse || search.value ==''
  )
});

</script>

<style scoped>
    .btnList{
     border: 2px solid #114d4d;
     background: #114d4d;
     color: white;
     font-weight: 600;
    }

.btnList:hover{
    background: #269c9c;
}

#table{
    padding-top: 5px;
    padding-bottom: 5px;
    height: 80vh;
    overflow-y: auto;
    scrollbar-width: thin;
}

.btn{
    background: var(--inactive-color);
    color: var(--text-white);
  }

  .btn:hover{
    background: var(--active-color);
  }
</style>