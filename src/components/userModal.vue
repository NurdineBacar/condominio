<template>
    <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-user-plus"></i> Novo Usuario</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <div class="row gap-1 justify-content-center ">
            <div class="col-md-10 mb-2">
                <span class="fw-semibold mb-2">Nome Completo</span>
                <inputs input-type="text" icon="fa-solid fa-lines-leaning" pHolder="Nome Completo" v-model="user_name"/>
            </div>
            <div class="col-md-10 mb-2">
                <span class="fw-semibold mb-2">Telefone</span>
                <inputs input-type="number" icon="fa-solid fa-phone" pHolder="Telefone" v-model="telephone"/>
            </div>
            <div class="col-md-10 mb-2">
                <span class="fw-semibold mb-2">Email</span>
                <inputs input-type="email" icon="fa-regular fa-envelope" p-holder="Email" v-model="email"/>
            </div>
            <div class="col-md-10 mb-2">
                <span class="fw-semibold mb-2">Tipo de Usuario</span>
                <cSelect :opts="listTypeUser" v-model="typeUser"/>
            </div>
            <div class="col-md-10 mb-2" v-show="typeUser =='morador'">
                <span class="fw-semibold mb-2">Casa</span>
                <cSelect :opts="listHouses" v-model="nhouse"/>
            </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-outline-dark fw-semibold" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
           <button type="button" class="btn btn-success fw-semibold" @click="addUser"><i class="fa-solid fa-check"></i> Adicionar</button>
         </div>
       </div>
     </div>
   </div>
   </template>
   
  <script setup>
  import inputs from "../components/inputs.vue";
  import cSelect from "../components/cSelect.vue";
  import { ref,onMounted,defineEmits } from "vue";
  import axios from 'axios';
  import { useRouter } from "vue-router";

  const emit = defineEmits(['userAdded']);

  let listHouses = ref([]);
  let user_name = ref(''),
      telephone = ref(''),
      email = ref(''),
      nhouse=ref(null),
      typeUser=ref('');
let listTypeUser=ref([
  {val:"morador", name:'Morador'},
  {val:"seguranca", name:'Segurança'},
  {val:"admin", name:'Administrador'},
]);
  

      const addUser = async () => {
    try {
        const response = await axios.post('http://localhost/condomino/src/backend/controllers/addUser.php', {
            user_name: user_name.value,
            telephone: telephone.value,
            email: email.value,
            nhouse: nhouse.value,
            typeUser: typeUser.value,
        });

        if (response.data.success) {
            console.log("Usuário adicionado com sucesso:", response.data.message);
           location.href='/users'
            // Resetar campos ou fechar modal se necessário
        } else {
            console.log("Erro ao adicionar usuário:", response.data.message);
        }
    } catch (error) {
        console.error("Erro ao adicionar usuário:", error);
    }
};

  onMounted(async ()=>{

    try{
      const response = await fetch("http://localhost/condomino/src/backend/controllers/selectNHouses.php", {
      method: "GET"
    });
      const json= await response.json();
      if(json.success){
        listHouses.value = json.data.map(house => ({
            val: house.id,  
            name: 'Nº '+house.nhouse 
      }));
      }else{
        console.log("erro na resposta: ", json.message);
      }
    }catch(error){
      console.log("Erro ao buscar dados: ",error)
    }
  });
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