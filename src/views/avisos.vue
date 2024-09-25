<template>
    <div class="row">
      <div class="col-md-8">
        <div class="col-md-12">
          <div class="d-flex gap-2">
            <item icon="fa-brands fa-slack" evento="Todos" />
            <item icon="fa-solid fa-home" evento="Desta Semana" />
            <item icon="fa-solid fa-home" evento="Este Mês" />
          </div>
          <div class="col-md-12">
           <div class="row mt-2 p-1" id="box">
             <warnigs :warns="search.length>0? searcFiltre : listWarns "/>
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

const listWarns= ref([]);
const search = ref('');


onMounted(async () => {
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