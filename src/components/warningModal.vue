<template>
  <div class="modal modal-lg fade" id="warningModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-triangle-exclamation"></i> Novo Aviso</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <div class="row gap-1 justify-content-center ">
          <div class="col-md-5 mb-2">
              <span class="fw-semibold mb-2">Titulo</span>
              <inputs input-type="text" icon="fa-solid fa-lines-leaning" pHolder="Titulo do aviso"/>
          </div>
          <div class="col-md-5 mb-2">
              <span class="fw-semibold mb-2">Tipo de Aviso</span>
              <cSelect :opts="typeWarnings"/>
          </div>
          <div class="col-md-5 mb-2">
              <span class="fw-semibold mb-2">Data de Expiracao</span>
              <inputs input-type="date" icon="fa-regular fa-clock" />
          </div>
          <div class="col-md-5 mb-2">
              <span class="fw-semibold mb-2">Prioridade</span>
              <cSelect :opts="prioridade"/>
          </div>
          <div class="col-md-10">
              <span class="fw-semibold mb-2">Observacoes</span>
              <textarea name="" id="" cols="30" rows="5" placeholder="Descricao do aviso ..."></textarea>
          </div>
          <div class="col-md-10">
            <input type="file" name="anexo" id="anexo">
            <label for="anexo" id="anex"><i class="fa-solid fa-paperclip"></i> Anexo</label>
          </div>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-outline-dark fw-semibold" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
         <button type="button" class="btn btn-success fw-semibold"><i class="fa-solid fa-check"></i> Adicionar</button>
       </div>
     </div>
   </div>
 </div>
 </template>
 
<script setup>
import inputs from "../components/inputs.vue";
import cSelect from "../components/cSelect.vue";
import { ref } from "vue";

let typeWarnings=ref([
 {val:"", name:"Seleciona"},
 {val:"manutencao", name:"MANUTENCAO"},
 {val:"evento", name:"evento"},
 {val:"Graducao", name:"Graducao"},
 {val:"Outros", name:"Outros"},
]);

let prioridade=ref([
 {val:"", name:"seleciona"},
 {val:"baixa", name:"baixa"},
 {val:"media", name:"media"},
 {val:"alta", name:"alta"},
 {val:"emergencia", name:"emergencia"},
]);
</script>

 <style scoped>
  cite{
      font-size: 13px;
  }

  textarea{
      width: 100%;
      border: 1px solid var(--inactive-color);
      border-radius: 5px;
      outline: none;
      padding: 10px;
      font-weight: 500;
  }

  #anexo{
    display: none;
  }
  #anex{
    text-decoration: underline;
    font-weight: 600;
    color: var(--active-house);
    cursor: pointer;
  }
 </style>