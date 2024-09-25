<template>
  <div class="row">
    <div class="col-md-8">
      <div class="col-md-12">
        <div class="d-flex gap-2">
          <item icon="fa-brands fa-slack" evento="Todas" />
          <item icon="fa-solid fa-home" evento="Desta Semana" />
          <item icon="fa-solid fa-home" evento="Este Mês" />
        </div>
        <div class="col-md-12 mt-3">
          <list :reservs="search.length>0? searcFiltre : listReservation " />
        </div>
      </div>
    </div>
    <div class="col-md">
      <div class="row">
        <div class="col-md-12 mt-2">
          <div class="d-flex gap-2">
            <button class="btn btn-outline-success fw-semibold" data-bs-toggle="modal" data-bs-target="#reservationModal"><i class="fa-solid fa-plus"></i> Nova</button>
            <inputs icon="fa-solid fa-magnifying-glass" input-type="search" p-holder="Procurar Reserva" v-model="search"/>
          </div>
        </div>
        <div class="col-md-12 mt-3">
          <!-- <calendar/> -->
        </div>
        <div class="col-md-12 mt-2">
          <div class="dash rounded pt-3 pb-2 px-1 mt-2">
        <div class="col-md-12 px-3 mb-1">
          <h5><i class="fa-solid fa-calendar-plus"></i> Total Reservas</h5>
          <p class="fs-6 fw-semibold amount">Quantidade: {{ listReservation.length }}</p>
        </div>
        <div class="col-md-12 px-3 mb-1">
          <h5><i class="fa-solid fa-triangle-exclamation"></i> Reservas desta semana</h5>
          <p class="fs-6 fw-semibold amount">Quantidade: 12</p>
        </div>
        <div class="col-md-12 px-3 mb-1">
          <h5><i class="fa-regular fa-file-lines"></i> Reservas de Hoje</h5>
          <p class="fs-6 fw-semibold amount">Quantidade: 12</p>
        </div>
      </div>
        </div>
      </div>
    </div>
    <rModal/>
  </div>
</template>

<script setup>
import item from "../components/cItem.vue";
import list from "../components/tableReservation.vue";
import inputs from "../components/inputs.vue";
import rModal from "../components/reservationModal.vue";
import calendar from "../components/calendar.vue";

import { ref, onMounted, computed } from "vue";

const listReservation= ref([]);
const search = ref('');


onMounted(async () => {
  try {
    const response = await fetch('http://localhost/condomino/src/backend/controllers/listReservation.php', { method: 'GET' });
    const json = await response.json();
    if (json.success) {
      listReservation.value = json.data;
      console.log(listReservation.value)
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }

  console.log(new Date())
});

// const filteredReservation = computed(() => {
//   return listReservation.value.filter(reserva =>
//   seletedUser.value === '' || user.typeUser === seletedUser.value
//   );
// });

const searcFiltre= computed(()=>{
  return listReservation.value.filter(reserva =>
  reserva.proposito.toLowerCase().includes(search.value.toLowerCase()) || search.value == reserva.area || search.value ==''
  )
});

// Função para obter o primeiro e último dia da semana atual
function getWeekStartAndEnd() {
  const today = new Date();
  const firstDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay())); // Domingo
  const lastDayOfWeek = new Date(today.setDate(firstDayOfWeek.getDate() + 6)); // Sábado

  return {
    start: firstDayOfWeek,
    end: lastDayOfWeek
  };
}

// Função para gerar uma lista de datas desta semana
function getDatesOfThisWeek() {
  const { start, end } = getWeekStartAndEnd();
  const dates = [];

  let currentDate = new Date(start);
  while (currentDate <= end) {
    dates.push(currentDate.toLocaleDateString()); // Formato ajustável
    currentDate.setDate(currentDate.getDate() + 1);
  }

  return dates;
}



</script>

<style scoped>

    #box{
        height: 75vh;
        overflow-y: auto;
        scrollbar-width: thin;
    }

.dash{
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
        0 0 5px rgba(163, 163, 163,.5);
    }

    .amount, h5{
        color: #003b41;
    }
    
    span{
        font-size: 14px;
    }

    .btn{
    background: var(--inactive-color);
    color: var(--text-white);
  }

  .btn:hover{
    background: var(--active-color);
  }
</style>