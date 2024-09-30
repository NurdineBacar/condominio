<template>
    <div class="modal modal-lg fade" id="reservationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-calendar-day me-1"></i> Pedido de Reserva</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <div class="row gap-1 justify-content-center ">
            <div class="col-md-5 mb-2">
                <span class="fw-semibold mb-2">Aréa da Reserva</span>
                <cSelect :opts="listArea" v-model="area"/>
            </div>
            <div class="col-md-5 mb-2">
                <span class="fw-semibold mb-2">Propósito</span>
                <cSelect :opts="proposito" v-model="reason"/>
            </div>
            <div class="col-md-5 mb-2">
                <span class="fw-semibold mb-2">Data</span>
                <inputs input-type="date" icon="fa-regular fa-clock" v-model="date_reservation"/>
            </div>
            <div class="col-md-5 mb-2">
                <span class="fw-semibold mb-2">Duração</span>
                <div class="d-flex flex-wrap">
                    <div>
                        <inputs input-type="time" v-model="initTime" class="time"/>
                        <cite class="text-secondary">* Incio</cite>
                    </div> 
                    <span class="mx-2 fw-bold">_</span>
                    <div>
                        <inputs input-type="time" v-model="endTime" class="time"/>
                        <cite class="text-secondary">* Fim</cite>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <span class="fw-semibold mb-2">Observações</span>
                <textarea name="" id="" cols="30" rows="5" placeholder="Descrição do que se prentende no evento ..." v-model="details"></textarea>
            </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-outline-dark fw-semibold" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
           <button type="button" class="btn btn-success fw-semibold" @click="askReservation"><i class="fa-solid fa-paper-plane"></i> Enviar pedido</button>
         </div>
       </div>
     </div>
   </div>
   </template>
   
<script setup>
import inputs from "../components/inputs.vue";
import cSelect from "../components/cSelect.vue";
import { ref, onMounted } from "vue";
import axios from "axios";


let proposito=ref([
   {val:"Aniversário", name:"Aniversário"},
   {val:"Casamento", name:"Casamento"},
   {val:"Graduação", name:"Graduação"},
   {val:"Outros  Eventos", name:"Outros Eventos"},
]);

let listArea=ref([
   {val:"Campo de Futebol", name:"Campo de Futebol"},
   {val:"Campo de Futsal", name:"Campo de Futsal"},
   {val:"Campo de Basquete", name:"Campo de Basquete"},
   {val:"Salão de Eventos", name:"Salão de Eventos"},
]);


const area=ref(''),
      reason=ref(''),
      date_reservation=ref(''),
      initTime=ref(''),
      endTime=ref(''),
      details=ref('');

const askReservation = async ()=>{
   try{
    const response = await axios.post("http://localhost/condomino/src/backend/controllers/addReserva.php",{
        area: area.value,
        reason:reason.value,
        dateTime: date_reservation.value,
        initTime: initTime.value,
        endTime: endTime.value,
        details: details.value,
        id_user: user.value.id,
        type_not: 'reserva',
    });

    if(response.data.success){
      console.log("Criacao de pedidode reservarealizado com sucesso");
      location.href='/reservation'
    }else{
      console.log("Erro: ",response.data.message)
    }
   }catch(error){
    console.log("Erro ao inserir dados", error)
   }


}

const user = ref(null)
onMounted(async ()=>{
  const storedUser = localStorage.getItem("user");

  if (storedUser) {
    user.value = JSON.parse(storedUser);
    console.log(user.value)
  } 
})
</script>

   <style scoped>
    cite{
        font-size: 13px;
    }

    textarea{
        width: 100%;
        border: 1px solid black;
        border-radius: 5px;
        outline: none;
        padding: 10px;
        font-weight: 500;
    }

    .time{
      font-size: 15px;
    }
   </style>