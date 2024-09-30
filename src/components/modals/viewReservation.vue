<template>
    <div
      class="modal fade"
      id="view"
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
              <i class="fa-solid fa-house-medical"></i> Detalhes da Reserva
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
              <h5 class="text-center">{{ view.propose}}</h5>
              <hr />
              <div class="col-md-12 px-4">
                <table class="w-100">
                  <tr>
                    <td>
                      <h6>Proposito</h6>
                      <span class="">{{ view.propose }}</span>
                    </td>
                    <td>
                      <h6>Area</h6>
                      <span class="">{{ view.area }}</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h6>Aprovacao</h6>
                      <span
                      :class="'badge ' + (view.aprovation === 'aprovado' ? 'bg-success' : view.aprovation === 'pendente' ? 'bg-warning' : 'bg-danger')"
                        >{{ view.aprovation }}</span
                      >
                      
                    </td>
                    <td>
                      <h6>Estado</h6>
                      <span :class="'badge '+ (view.status === 'concluido'? 'bg-success': view.status === 'pendente'? 'bg-warning':'bg-danger')">{{ view.status }}</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h6>Data de registo</h6>
                      <span class="">{{ view.reg_date }}</span>
                    </td>
                    <td>
                      <h6>Data da Reserva</h6>
                      <span class="">{{ view.end_date }}</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h6>Hora de inicio</h6>
                      <span class="">{{ view.init_time }}</span>
                    </td>
                    <td>
                      <h6>Hora do Termino</h6>
                      <span class="">{{ view.end_time }}</span>
                    </td>
                  </tr>
                </table>
              </div>
              <hr />
              <div class="col-md-12 mb-1 ps-4">
                <h6>Descricao</h6>
                <span class="">
                  {{ view.details}}
                </span>
              </div>
              <div class="col-md-12 mt-1" v-show="access.typeUser == 'admin'">
                <div class="d-flex justify-content-end gap-2" v-if="view.aprovation !='rejeitado'">
                  <button class="btn btn-outline-dark" @click="rejectReservation(view.id)" v-show="view.aprovation !='aprovado'"> Rejeitar</button>
                  <button class="btn btn-success" @click="aproveReservation(view.id)" v-show="view.aprovation !='aprovado'"> Aprovar</button>
                  <button class="btn btn-danger" @click="cancelReservation(view.id)" v-show="view.aprovation =='aprovado' && view.status != 'cancelado'"> Cancelar Reserva</button>
                </div>
              </div>
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

  const aproveReservation = async (id) => {
    try{
      const response = await axios.post('http://localhost/condomino/src/backend/controllers/reservas/aproveReservation.php',{
        id:id,
      });

      if(response.data.success){
        location.href = '/reservation';
      }else{
        console.log(response.data.message);
      }
    }catch(error){
      console.log(error)
    }
  }


  const rejectReservation = async (id) => {
    try{
      const response = await axios.post('http://localhost/condomino/src/backend/controllers/reservas/rejectReservation.php',{
        id:id,
      });

      if(response.data.success){
        location.href = '/reservation';
      }else{
        console.log(response.data.message);
      }
    }catch(error){
      console.log(error)
    }
  }

  const cancelReservation = async (id) => {
    try{
      const response = await axios.post('http://localhost/condomino/src/backend/controllers/reservas/cancelReservation.php',{
        id:id,
      });

      if(response.data.success){
        location.href = '/reservation';
      }else{
        console.log(response.data.message);
      }
    }catch(error){
      console.log(error)
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