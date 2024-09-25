<template>
  <div>
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <!-- Item "Reservas" será selecionado por padrão -->
          <div class="col-md-auto">
            <item icon="fa-solid fa-calendar-plus" evento="Reservas" value="reserva" v-model:selected="selectedItem"/>
          </div>
          <div class="col-md-auto">
            <item icon="fa-solid fa-triangle-exclamation" evento="Avisos" value="aviso" v-model:selected="selectedItem"/>
          </div>
          <div class="col-md">
            <button class="btn w-100 fw-semibold py-1" style="height: 100%;" data-bs-toggle="modal" data-bs-target="#addVisit">
              <i class="fa-solid fa-plus fs-5"></i> Visita
            </button>
          </div>
        </div>

        <div class="row mt-2 p-1" id="boxList">
          <!-- Mostra a tabela de reservas se o item selecionado for 'reserva' -->
          <tableReservation v-if="selectedItem === 'reserva'" :reservs="listReservation"/>
          <!-- Mostra a tabela de avisos se o item selecionado for 'aviso' -->
          <tableWarnig v-if="selectedItem === 'aviso'" :warns="listWarns"/>
        </div>
      </div>
      <div class="col-md">
        <div class="row">
          <div class="col-md-12">
            <!-- <mcalendar /> -->
          </div>
          <div class="col-md-12 mt-2">
            <sEvent />
          </div>
        </div>
      </div>
    </div>
    <mVisit/>
  </div>
</template>

<script setup>
import item from "../components/cItem.vue";
import mcalendar from "../components/miniCalendar.vue";
import sEvent from "../components/statisticEvent.vue";
import dashList from "../components/dashList.vue";
import mVisit from "../components/modals/modalVisit.vue";
import tableReservation from "../components/tableReservation.vue";
import tableWarnig from "../components/tables/tableWarnig.vue";
import { ref, onMounted } from "vue";

const listReservation = ref([]);
const listWarns = ref([]);
const selectedItem = ref('reserva'); // Inicializa com 'reserva' para ser o valor padrão

onMounted(async () => {
  try {
    const response_1 = await fetch('http://localhost/condomino/src/backend/controllers/listReservation.php', { method: 'GET' });
    const json_1 = await response_1.json();
    if (json_1.success) {
      listReservation.value = json_1.data;
      console.log(listReservation.value);
    } else {
      console.error('Erro na resposta:', json_1.message);
    }

    const response_2 = await fetch('http://localhost/condomino/src/backend/controllers/listWarnings.php', { method: 'GET' });
    const json_2 = await response_2.json();
    if (json_2.success) {
      listWarns.value = json_2.data;
      console.log(listWarns.value);
    } else {
      console.error('Erro na resposta:', json_2.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }
});
</script>

<style scoped>
  #boxList {
    height: 72vh;
    overflow-y: auto;
    scrollbar-width: thin;
  }

  .btn {
    background: var(--inactive-color);
    color: var(--text-white);
  }

  .btn:hover {
    background: var(--active-color);
  }
</style>
