<template>
  <div class="row rounded" id="box">
    <div class="col-md-5 ">
      <div
        class="radios"
      >
        <input
          type="radio"
          class="tp"
          name="btnradio"
          id="btnradio1"
          autocomplete="off"
          value="visitas"
          v-model="seletedData"
          checked
        />
        <label class="btn btnList" for="btnradio1">Visitas</label>

        <input
          type="radio"
          class="tp"
          name="btnradio"
          id="btnradio2"
          value="reservas"
          v-model="seletedData"
          autocomplete="off"
        />
        <label class="btn btnList" for="btnradio2">Reservas</label>
      </div>
    </div>
    <hr class="w-100 bg-secondary" />
    <div class="col-md-12" id="item" v-show="seletedData == 'visitas'">
      <table class="w-100 fw-semibold">
            <tbody>
                <tr v-for="list in filtereVisits" :key="list.visita_id">
                    <td class="">
                        <span><i class="fa-solid fa-house-user me-2"></i>
                            {{ list.name_user }}</span>
                    </td>
                    <td>
                        {{ list.nome_visita }}
                    </td>
                    <td>
                        <span class="fw-semibold">Nº {{ list.nhouse }}</span>
                    </td>
                    <td>
                       {{ list.data_visita }}
                    </td>
                    <td>
                        {{ list.hora }}
                    </td>
                    <td class="py-2">
                        <div class="d-flex gap-3 justify-content-center">
                           <button class="btn btn-danger rounded-circle" @click="deleteVisit(list.visita_id)"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <div class="col-md-12" id="item" v-show="seletedData == 'reservas'">
      <table class="w-100">
            <tbody>
                <tr v-for="reserv in filteredReservations" :key="reserv.id" class="fw-semibold">
                    <td class="ps-4 py-2">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-calendar fs-2"></i>
                           <h6><a href="fs-6 fw-bold">{{ reserv.proposito }}</a></h6>
                        </div>
                    </td>
                    <td class="fw-semibold">
                       {{ reserv.detalhes.length>20? reserv.detalhes.slice(0,35)+"...": reserv.detalhes }}
                    </td>
                    <td>
                        {{ reserv.data_reserva }}
                    </td>
                    <td>
                        {{ reserv.hora_inicio }}
                    </td>
                    <td class="ps-2">
                        <span class="badge bg-primary" >{{ reserv.estado }}</span> 
                    </td>
                    <td class="px-2">
                        <div class="d-flex gap-3 justify-content-center">
                            <i class=""></i>
                            <a href="" @click.prevent="showReservation(reserv.id)"  data-bs-toggle="modal" data-bs-target="#view"><i class="fa-solid fa-up-right-from-square fs-6"></i></a>
                            <a href="" @click.prevent="deleteReservation(reserv.id)"><i class="fa-solid fa-trash fs-6"></i></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <mView :view="dataView"/>
    </div>
  </div>
</template>

<script setup>
import { defineProps, onMounted, ref, computed } from "vue";
import mView from "../components/modals/viewReservation.vue";
import axios from "axios";

const props = defineProps(["user_id"]);
const user = ref("");
const listVisits = ref([]),
  listReservation = ref([]);
const seletedData = ref("visitas");
const dataView=ref([]);

// Carrega os dados do usuário ao montar o componente
onMounted(async () => {
  console.log(filtereVisits);
  const storedUser = localStorage.getItem("user");

  if (storedUser) {
    user.value = JSON.parse(storedUser);
  } else {
    // Se o usuário não estiver logado, redireciona para a página de login
    router.push("/");
  }

  try {
    const response_1 = await fetch(
      "http://localhost/condomino/src/backend/controllers/listVisits.php",
      { method: "GET" }
    );
    const json_1 = await response_1.json();
    const response_2 = await fetch(
      "http://localhost/condomino/src/backend/controllers/listReservation.php",
      { method: "GET" }
    );
    const json_2 = await response_2.json();
    if (json_1.success && json_2.success) {
      listVisits.value = json_1.data;
      listReservation.value = json_2.data;
      // console.log(listVisits.value);
      console.log(listReservation.value);
      // console.log(12);
      
    } else {
      console.error("Erro na resposta:", json.message);
    }
  } catch (error) {
    console.log("Erro ao consultar dados na bd");
  }
});

const filteredReservations = computed(() => {
  return listReservation.value.filter((reserv) => Number(reserv.id_user) === user.value.id);
});

const filtereVisits = computed(() => {
  return listVisits.value.filter((visits) => 
  visits.user === user.id && visits.hora_entrada ==null);
});

const deleteVisit = async (visit)=>{
    try{
      const response = await axios.post('http://localhost/condomino/src/backend/controllers/visitas/deleteVisita.php',{
        id: visit,
      });

      if(response.data.success){
        location.href = '/profile';
      }else{
        console.log(response.data.message);
      }
    }catch(error){
      console.log(error)
    }
}

const deleteReservation = async (visit)=>{
    try{
      const response = await axios.post('http://localhost/condomino/src/backend/controllers/deleteReservation.php',{
        id: visit,
      });

      if(response.data.success){
        location.href = '/profile';
      }else{
        console.log(response.data.message);
      }
    }catch(error){
      console.log(error)
    }
}

function showReservation(id) {
  const selectedReservation = listReservation.value.find(reserv => reserv.id === id);
  if (selectedReservation) {
    dataView.value = {
      id: selectedReservation.id,
      propose: selectedReservation.proposito,
      area: selectedReservation.area,
      aprovation: selectedReservation.aprovacao,
      reg_date: selectedReservation.data_registo,
      end_date: selectedReservation.data_reserva,
      int_time: selectedReservation.hora_inicio,
      end_time: selectedReservation.hora_fim,
      details: selectedReservation.detalhes,
      status: selectedReservation.estado,
    };
    
  } else {
    console.error('Reserva não encontrada.');
  }
}

</script>

<style scoped>
#box {
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3), 0 0 5px rgba(163, 163, 163, 0.5);
  overflow: hidden;
}

a {
  text-decoration: none;
  padding: 8px 5px;
  color: var(--inactive-color);
}

a:hover {
  color: var(--active-color);
}

tbody tr{
  border-bottom: 1px solid gray;
}

tbody tr:last-child{
  border-bottom: none;
}

h5 {
  font-size: 15px;
  margin-bottom: 0px;
}
p {
  font-size: 13px;
}

#info {
  border-bottom: 1px solid gray;
}

#info:last-child {
  border: none;
}

#item {
  height: 61vh;
  overflow-y: auto;
  scrollbar-width: thin;
  /* scrollbar-color: transparent transparent; */
}

label{
  font-weight: 600;
  /* background: red; */
  border-radius: 0;
  padding: 4px 40px;
}

input:checked + label{
  background: var(--inactive-color);
  color: white;
}

input:not(:checked) + label:hover{
  background: var(--active-color);
  color: white;
  transition: .2s ease;
}

input{
  display: none;
}

.radios{
  margin-left: -12px;
}
</style>