<template>
    <div
      class="modal fade"
      id="viewlh"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">
              <i class="fa-solid fa-house-medical"></i> Detalhes da Casa
            </h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="row gap-1">
              <h5 class="text-center"><i class="fa-solid fa-house"></i> Casa nº {{ view.casa}}</h5>
              <hr />
              <div class="col-md-12 px-4">
                <table class="w-100">
                  <tr v-for="users in view.data" :key="users.id">
                    <td class="fw-semibold"><i class="fa-solid fa-user"></i> {{ users.name_user }}</td>
                    <td><a href="" @click.prevent="deleteUser(users.id)"><i class="fa-solid fa-trash"></i></a></td>
                  </tr>
                </table>
              </div>
             
              <!-- <div class="col-md-12 mt-1" v-show="access.typeUser == 'admin'">
                <div class="d-flex justify-content-end gap-2" v-if="view.aprovation !='rejeitado'">
                  <button class="btn btn-outline-dark" @click="rejectReservation(view.id)" v-show="view.aprovation !='aprovado'"> Rejeitar</button>
                  <button class="btn btn-success" @click="aproveReservation(view.id)" v-show="view.aprovation !='aprovado'"> Aprovar</button>
                  <button class="btn btn-danger" @click="cancelReservation(view.id)" v-show="view.aprovation =='aprovado' && view.status != 'cancelado'"> Cancelar Reserva</button>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
     
    <script setup>
  import { defineProps, ref, onMounted } from "vue";
  import axios from 'axios';
  
  const props = defineProps(["view"]);
  const access = ref('');
  
  onMounted(()=>{
    const storedUser =localStorage.getItem('user');
    access.value =JSON.parse(storedUser);
  });

  const deleteUser =  async (id_user)=>{
    try{
        const response = await axios.post("http://localhost/condomino/src/backend/controllers/deleteUser.php", {
            id: id_user,
        });

        if(response.data.success){
            console.log("Usuario elimidao com, sucesso")
        }else{
            console.log("errro ao deltar o usaurio: ", response.data.message)
        }
    }catch(error){
        console.log("Erro ao buscadar dados: ",error)
    }
}
  </script>
    
     <style scoped>
  cite {
    font-size: 13px;
  }
  
  textarea {
    width: 100%;
    border: 1px solid var(--inactive-color);
    border-radius: 5px;
    outline: none;
    padding: 10px;
    font-weight: 500;
  }
  
  #anexo {
    display: none;
  }
  #anex {
    text-decoration: underline;
    font-weight: 600;
    color: var(--active-house);
    cursor: pointer;
  }
  tr td{
    padding-bottom: 8px;
  }
  
  h6{
    margin-bottom: 4px;
  }
  </style>