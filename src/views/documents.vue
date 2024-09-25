<template>
  <div class="row mt-1">
    <div class="col-md-6">
      <div class="d-flex gap-2">
        <inputs input-type="search" p-holder="Nome do documento" icon="fa-solid fa-magnifying-glass" class="w-100"/>
        <button class="btn fw-semibold">Procurar</button>
      </div>
    </div>
    <div class="col-md">
      <div class="d-flex gap-4 align-items-center justify-content-end">
        <div class="d-flex gap-2 align-items-center">
            <span class="fw-semibold">Formato: </span>
            <cSelect :opts="docList" class="w-50" />
        </div>
        <div class="d-flex gap-2 align-items-center">
          <span class="fw-semibold">Data: </span>
          <inputs input-type="date" icon="fa-solid fa-calendar" class="" />
        </div>
      </div>
    </div>

    <div class="col-md-12 mt-2" v-show="user.typeUser === 'admin'">
        <inputFile/>
    </div>

    <div class="col-md-12 mt-2" id="box">
        <tableDocs/>
    </div>
  </div>
</template>

<script setup>
import inputs from "../components/inputs.vue";
import cSelect from "../components/cSelect.vue";
import inputFile from "../components/inputFile.vue";
import tableDocs from "../components/tables/tableDocs.vue";
import { ref, onMounted } from "vue";

const user = ref('');
  
  // Carrega os dados do usuário ao montar o componente
  onMounted( async() => {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
      user.value = JSON.parse(storedUser);
    } 
    try{
        
    }catch(error){
        console.log("Erro ao buscar dados", error);
    }
  });

let docList = ref([
  { val: ".docx", name: ".docx" },
  { val: ".pdf", name: ".pdf" },
  { val: ".txt", name: ".txt" },
]);
</script>

<style scoped>

    #box{
    padding-top: 5px;
    padding-bottom: 5px;
    height: 59vh;
    overflow-y: auto;
    scrollbar-width: thin;
    }

    .btn{
      background: var(--inactive-color);
      color: var(--text-white);
    }

    .btn:hover{
      background: var(--active-color);
        color: var(--text-white);
    }
</style>