<template>
  <div class="">
    <div class="row">
      <div class="col-md-6">
        <div class="d-flex gap-2">
          <inputs
            input-type="search"
            icon="fa-solid fa-magnifying-glass"
            pHolder="Morador e Nº casa..."
            v-model="search"
          />
          <button class="btn ">Procurar</button>
        </div>
      </div>
      <div class="col-md">
        <div class="d-flex justify-content-end gap-2">
          <div class="d-flex gap-2 w-100 align-items-center">
            <h6 class="d-flex gap-1 align-items-center"><i class="fa-solid fa-clock"></i> Hora</h6>
            <cSelect class=""/>
            <button class="btn ">Procurar</button>
          </div>
          <div class="d-flex gap-2">
            <inputs input-type="date" />
            <button class="btn ">Procurar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-md-12" id="table">
        <visits class="w-100" :lists="search.length>0? searcFiltre : listVisits"/>
      </div>
    </div>
  </div>
</template>
  
  <script setup>
import cSelect from "../components/cSelect.vue";
import visits from "../components/tableVisits.vue";
import inputs from "../components/inputs.vue";
import { ref, onMounted,computed } from "vue";

let sort = [
  { val: "", name: "Filtro" },
  { val: "activo", name: "activo" },
  { val: "inativo", name: "inativo" },
];

const listVisits = ref([]);
const search= ref('')

onMounted(async () => {
  try {
    const response = await fetch('http://localhost/condomino/src/backend/controllers/listVisits.php', { method: 'GET' });
    const json = await response.json();
    if (json.success) {
      listVisits.value = json.data;
      console.log(listVisits.value)
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }
});

// Computed property para filtrar os usuários
// const filteredUsers = computed(() => {
//   return listVisits.value.filter(visits =>
//   seletedUser.value === '' || visits.typeUser === seletedUser.value
//   );
// });

const searcFiltre= computed(()=>{
  return listVisits.value.filter(visits =>
  visits.nome_visita.toLowerCase().includes(search.value.toLowerCase()) || search.value ==''
  )
});
</script>
  
  <style scoped>
.btnList {
  border: 2px solid #114d4d;
  background: #114d4d;
  color: white;
  font-weight: 600;
}

.btnList:hover {
  background: #269c9c;
}

#table {
  padding-top: 5px;
  padding-bottom: 5px;
  height: 80vh;
  overflow-y: auto;
  scrollbar-width: thin;
}

cite {
  font-size: 11px;
}

.btn{
    background: var(--inactive-color);
    color: var(--text-white);
  }

  .btn:hover{
    background: var(--active-color);
  }
</style>