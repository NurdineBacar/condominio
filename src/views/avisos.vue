<template>
    <div class="row">
      <div class="col-md-8">
        <div class="col-md-12">
          <div class="d-flex gap-2">
          <item
            icon="fa-brands fa-slack"
            evento="Todas"
            value="todas"
            v-model:selected="selectedFilter"
          />
          <item
            icon="fa-solid fa-home"
            evento="Desta Semana"
            value="semana"
            v-model:selected="selectedFilter"
          />
          <item
            icon="fa-solid fa-home"
            evento="Este Mês"
            value="mes"
            v-model:selected="selectedFilter"
          />
        </div>
          <div class="col-md-12">
           <div class="row mt-2 p-1" id="box">
             <warnigs :warns="search.length>0? searcFiltre : filteredWarns "/>
           </div>
          </div>
        </div>
      </div>
      <div class="col-md">
        <div class="row">
          <div class="col-md-12 mt-2">
            <div class="d-flex gap-2">
              <button class="btn fw-semibold" data-bs-toggle="modal" data-bs-target="#warningModal"><i class="fa-solid fa-plus"></i> Novo</button>
              <inputs icon="fa-solid fa-magnifying-glass" input-type="search" p-holder="Procurar Aviso" v-model="search"/>
            </div>
          </div>
          <div class="col-md-12 mt-3">
          <!-- <calendar/> -->
        </div>
          <div class="col-md-12 mt-2">
            <div class="dash rounded pt-3 pb-2 px-1 mt-2">
          <div class="col-md-12 px-3 mb-1">
            <h5><i class="fa-solid fa-calendar-plus"></i> Total Avisos</h5>
            <p class="fs-6 fw-semibold amount">Quantidade: {{ listWarns.length }}</p>
          </div>
          <div class="col-md-12 px-3 mb-1">
            <h5><i class="fa-solid fa-triangle-exclamation"></i> Avisos desta semana</h5>
            <p class="fs-6 fw-semibold amount">Quantidade: 12</p>
          </div>
          <div class="col-md-12 px-3 mb-1">
            <h5><i class="fa-regular fa-file-lines"></i> Avisos de Hoje</h5>
            <p class="fs-6 fw-semibold amount">Quantidade: 12</p>
          </div>
        </div>
          </div>
        </div>
      </div>
      <wModal/>
    </div>
  </template>
  
  <script setup>
  import item from "../components/cItem.vue";
  import warnigs from "../components/tables/tableWarnig.vue";
  import inputs from "../components/inputs.vue";
  import wModal from "../components/warningModal.vue";
  import calendar from "../components/calendar.vue";
  import { ref, onMounted, computed } from "vue";
  import { useRouter } from "vue-router";
const router = useRouter();

const listWarns= ref([]);
const search = ref('');
const selectedFilter = ref('Todos');



onMounted(async () => {
  const storedUser = localStorage.getItem('user');
  if (storedUser) {
    user.value = JSON.parse(storedUser);
  }else{
    router.push('/');
  }
  try {
    const response = await fetch('http://localhost/condomino/src/backend/controllers/listWarnings.php', { method: 'GET' });
    const json = await response.json();
    if (json.success) {
      listWarns.value = json.data;
      console.log(listWarns.value)
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }

  console.log(listWarns)
});

// const filteredReservation = computed(() => {
//   return listReservation.value.filter(reserva =>
//   seletedUser.value === '' || user.typeUser === seletedUser.value
//   );
// });

const searcFiltre= computed(()=>{
  return listWarns.value.filter(warn =>
  warn.titulo.toLowerCase().includes(search.value.toLowerCase()) || search.value == warn.tipo || search.value ==''
  )
});

// Função que filtra os avisos com base na seleção e no tipo de usuário
const filteredWarns = computed(() => {
  if (search.value) {
    return listWarns.value.filter(
      (warn) =>
        warn.titulo.toLowerCase().includes(search.value.toLowerCase()) ||
        warn.tipo.toLowerCase().includes(search.value.toLowerCase())
    );
  }

  const { start: weekStart, end: weekEnd } = getWeekStartAndEnd();
  const { start: monthStart, end: monthEnd } = getMonthStartAndEnd();

  return listWarns.value.filter((warn) => {
    const warnDate = new Date(warn.data_validade); // Supondo que a data do aviso seja armazenada em 'data_aviso'

    if (selectedFilter.value === "semana") {
      return warnDate >= weekStart && warnDate <= weekEnd;
    } else if (selectedFilter.value === "mes") {
      return warnDate >= monthStart && warnDate <= monthEnd;
    }

    return true; // "Todos" os avisos
  });
});

// Função para obter o primeiro e último dia da semana atual
function getWeekStartAndEnd() {
  const today = new Date();
  const firstDayOfWeek = new Date(
    today.setDate(today.getDate() - today.getDay())
  );
  const lastDayOfWeek = new Date(firstDayOfWeek);
  lastDayOfWeek.setDate(firstDayOfWeek.getDate() + 6);

  return { start: firstDayOfWeek, end: lastDayOfWeek };
}

// Função para obter o mês atual
function getMonthStartAndEnd() {
  const today = new Date();
  const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
  const lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);

  return { start: firstDayOfMonth, end: lastDayOfMonth };
}

  </script>
  
  <style scoped>
  
      #box{
          height: 74vh;
          overflow-y: auto;
          scrollbar-width: thin;
      }
  
  .dash{
          box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                      0 0 5px rgba(163, 163, 163,.5);
      }
  
      .amount, h5{
          color: var(--inactive-color);
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