<template>
  <div class="">
    <div class="row">
      <div class="col-md-4">
        <div class="d-flex gap-2">
          <inputs
            input-type="search"
            icon="fa-solid fa-magnifying-glass"
            pHolder="Morador e Nº casa..."
            v-model="search"
          />
          <button class="btn">Procurar</button>
        </div>
      </div>
      <div class="col-md-4">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" v-model="selectedC" value="entrada" checked>
          <label class="btn btn-outline-primary" for="btnradio1"><i class="fa-solid fa-road-barrier"></i> Entrada</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" v-model="selectedC" value="saida">
          <label class="btn btn-outline-primary" for="btnradio2"><i class="fa-solid fa-person-walking-arrow-right"></i> Saída</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" v-model="selectedC" value="concluida">
          <label class="btn btn-outline-primary" for="btnradio3"><i class="fa-solid fa-check"></i> Verificadas</label>
        </div>
      </div>

      <div class="col-md">
        <div class="d-flex justify-content-end">
          <div class="d-flex gap-2">
            <button class="btn btn-success"><i class="fa-solid fa-user-plus"></i> Visita</button>
            <inputs input-type="date" v-model="selectedDate" />
            <!-- <button class="btn">Procurar</button> -->
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-md-12" id="table">
        <visits class="w-100" :lists="searcFiltre" />
      </div>
    </div>
  </div>
</template>

<script setup>
import cSelect from "../components/cSelect.vue";
import visits from "../components/tableVisits.vue";
import inputs from "../components/inputs.vue";
import { ref, onMounted, computed } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();

const listVisits = ref([]);
const search = ref('');
const selectedC = ref('entrada'); // Armazenar a seleção do tipo de visita
const selectedDate = ref(''); // Armazenar a data selecionada

onMounted(async () => {
  const storedUser = localStorage.getItem('user');
  if (storedUser) {
    user.value = JSON.parse(storedUser);
  }else{
    router.push('/');
  }
  try {
    const response = await fetch('http://localhost/condomino/src/backend/controllers/listVisits.php', { method: 'GET' });
    const json = await response.json();
    if (json.success) {
      listVisits.value = json.data;
      console.log(listVisits.value);
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }
});

const searcFiltre = computed(() => {
  return listVisits.value.filter(visita => {
    // Verifica se o nome da visita corresponde ao filtro de pesquisa
    const matchesSearch = visita.nome_visita.toLowerCase().includes(search.value.toLowerCase()) || search.value === '';

    // Verifica se a data da visita corresponde à data selecionada
    const matchesDate = selectedDate.value === '' || visita.data_visita === selectedDate.value; // Substitua 'data_visita' pelo nome correto da propriedade

    // Se "Entrada" estiver selecionado, apenas listar visitas sem hora de entrada
    if (selectedC.value === 'entrada') {
      return matchesSearch && matchesDate && !visita.hora_entrada; // Substitua 'hora_entrada' pelo nome correto da propriedade
    }

    // Se "Saída" estiver selecionado, apenas listar visitas com hora de entrada e sem hora de saída
    if (selectedC.value === 'saida') {
      return matchesSearch && matchesDate && visita.hora_entrada && !visita.hora_saida; // Verifica se hora_entrada está preenchida, mas hora_saida não
    }

    // Se "Concluídas" estiver selecionado, apenas listar visitas com hora de entrada e hora de saída preenchidas
    if (selectedC.value === 'concluida') {
      return matchesSearch && matchesDate && visita.hora_entrada && visita.hora_saida; // Verifica se ambos estão preenchidos
    }

    return matchesSearch && matchesDate; // Retornar visitas que correspondem à pesquisa e à data
  });
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

.btn {
  background: var(--inactive-color);
  color: var(--text-white);
}

.btn:hover {
  background: var(--active-color);
}
</style>
