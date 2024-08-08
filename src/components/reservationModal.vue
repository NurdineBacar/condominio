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
                <span class="fw-semibold mb-2">Area da Reserva</span>
                <cSelect :opts="area" />
            </div>
            <div class="col-md-5 mb-2">
                <span class="fw-semibold mb-2">Proposito</span>
                <cSelect :opts="proposito"/>
            </div>
            <div class="col-md-5 mb-2">
                <span class="fw-semibold mb-2">Data e Hora</span>
                <inputs input-type="datetime-local" icon="fa-regular fa-clock" />
            </div>
            <div class="col-md-5 mb-2">
                <span class="fw-semibold mb-2">Duração</span>
                <div class="d-flex">
                    <div>
                        <inputs input-type="time"/>
                        <cite class="text-secondary">* Incio</cite>
                    </div> 
                    <span class="mx-2 fw-bold">_</span>
                    <div>
                        <inputs input-type="time" />
                        <cite class="text-secondary">* Fim</cite>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <span class="fw-semibold mb-2">Observacoes</span>
                <textarea name="" id="" cols="30" rows="5" placeholder="Descricao do que se prentende no evento ..."></textarea>
            </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-outline-dark fw-semibold" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
           <button type="button" class="btn btn-success fw-semibold"><i class="fa-solid fa-paper-plane"></i> Enviar pedido</button>
         </div>
       </div>
     </div>
   </div>
   </template>
   
<script setup>
import inputs from "../components/inputs.vue";
import cSelect from "../components/cSelect.vue";
import { ref } from "vue";

let proposito=ref([
   {val:"Aniversario", name:"Aniversario"},
   {val:"Casamento", name:"Casamento"},
   {val:"Graducao", name:"Graducao"},
   {val:"Outros", name:"Outros"},
]);

let area=ref([
   {val:"salão", name:"Salao"},
   {val:"estacionamento", name:"estacionamento"},
   {val:"quadra", name:"Quadra esportiva"},
]);
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
   </style>