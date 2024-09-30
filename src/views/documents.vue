<template>
  <div class="row mt-1">
    <div class="col-md-6">
      <div class="d-flex gap-2">
        <inputs input-type="search" p-holder="Nome do documento" icon="fa-solid fa-magnifying-glass" class="w-100" v-model="search"/>
      </div>
    </div>
    <div class="col-md">
      <div class="d-flex gap-4 align-items-center justify-content-end">
        <!-- <div class="d-flex gap-2 align-items-center">
          <span class="fw-semibold">Data: </span>
          <inputs input-type="date" icon="fa-solid fa-calendar" class="" v-model="searchDate" />
        </div> -->
      </div>
    </div>

    <div class="col-md-12 mt-2" v-show="user.typeUser =='admin'">
        <inputFile/>
    </div>

    <div class="col-md-12 mt-2" id="box" :style="'height: '+ (user.typeUser == 'morador'? '80vh;':'59vh;')">
        <!-- A tabela agora filtra documentos com base no nome e na data -->
        <tableDocs :docs="filterDocs" />
    </div>
  </div>
</template>

<script setup>
import inputs from "../components/inputs.vue";
import inputFile from "../components/inputFile.vue";
import tableDocs from "../components/tables/tableDocs.vue";
import { ref, onMounted, computed } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();

const user = ref('');
const search = ref('');
const searchDate = ref('');
const lDocuments = ref(null);

// Carrega os dados do usuário ao montar o componente
onMounted(async () => {
  const storedUser = localStorage.getItem('user');
  if (storedUser) {
    user.value = JSON.parse(storedUser);
  }else{
    router.push('/');
  }
  try {
    const response = await fetch('http://localhost/condomino/src/backend/controllers/listDocuments.php', { method: 'GET' });
    const json = await response.json();
    if (json.success) {
      lDocuments.value = json.data;
      console.log(lDocuments.value);
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }
});

// Filtragem dos documentos por nome e data
const filterDocs = computed(() => {
  return lDocuments.value?.filter(docs => {
    const matchesSearch = docs.doc_name.toLowerCase().includes(search.value.toLowerCase()) || search.value === '';
    const matchesDate = searchDate.value === '' || docs.data_registo === searchDate.value; // Use o nome correto da propriedade da data
    return matchesSearch && matchesDate;
  }) || [];
});
</script>

<style scoped>
  #box {
    padding-top: 5px;
    padding-bottom: 5px;
    overflow-y: auto;
    scrollbar-width: thin;
  }

  .btn {
    background: var(--inactive-color);
    color: var(--text-white);
  }

  .btn:hover {
    background: var(--active-color);
    color: var(--text-white);
  }
</style>
