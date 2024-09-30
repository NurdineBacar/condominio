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
              <span class="fw-semibold mb-2">Título</span>
              <inputs input-type="text" icon="fa-solid fa-lines-leaning" pHolder="Titulo do aviso" v-model="titulo"/>
          </div>
          <div class="col-md-5 mb-2">
              <span class="fw-semibold mb-2">Tipo de Aviso</span>
              <cSelect :opts="typeWarnings" v-model="tipo"/>
          </div>
          <div class="col-md-5 mb-2">
              <span class="fw-semibold mb-2">Data de Expiração</span>
              <inputs input-type="date" icon="fa-regular fa-clock" v-model="data_validade"/>
          </div>
          <div class="col-md-5 mb-2">
              <span class="fw-semibold mb-2">Prioridade</span>
              <cSelect :opts="prioridade" v-model="nivel_prioridade"/>
          </div>
          <div class="col-md-10">
              <span class="fw-semibold mb-2">Observações</span>
              <textarea name="" id="" cols="30" rows="5" placeholder="Descrição do aviso ..." v-model="observacoes"></textarea>
          </div>
          <!-- <div class="col-md-10">
            <input type="file" name="anexo" id="anexo">
            <label for="anexo" id="anex"><i class="fa-solid fa-paperclip"></i> Anexo</label>
          </div> -->
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-outline-dark fw-semibold" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
         <button type="button" class="btn btn-success fw-semibold" @click="addWarning"><i class="fa-solid fa-check"></i> Adicionar</button>
       </div>
     </div>
   </div>
 </div>
 </template>
 
<script setup>
import inputs from "../components/inputs.vue";
import cSelect from "../components/cSelect.vue";
import { ref, onMounted } from "vue";
import axios from 'axios';

let typeWarnings=ref([
 {val:"Manutenção", name:"Manutenção"},
 {val:"Evento", name:"Evento"},
 {val:"Outros", name:"Outros"},
]);

let prioridade=ref([
  {val:"Alta", name:"Alta"},
  {val:"Média", name:"Média"},
  {val:"Baixa", name:"Baixa"},
]);

const titulo= ref(''),
      tipo=ref(''),
      nivel_prioridade=ref(''),
      data_validade=ref(''),
      observacoes=ref('');

const addWarning= async ()=>{
  try{
    const response = await axios.post("http://localhost/condomino/src/backend/controllers/addWarn.php",{
        titulo: titulo.value,
        tipo: tipo.value,
        nivel_prioridade: nivel_prioridade.value,
        data_validade: data_validade.value,
        observacoes: observacoes.value,
        id_user: user.value.id,
        type_not: 'aviso',
    });

    if(response.data.success){
      location.href='/warning'
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