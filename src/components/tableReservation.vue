<template>
    <div>
        <table>
            <!-- <thead>
                <tr>
                    <td>Foto</td>
                    <td>Nome</td>
                    <td>Telefone</td>
                    <td>Email</td>
                    <td>Casa</td>
                    <td>Estado</td>
                    <td>Operacoes</td>
                </tr>
            </thead> -->
            <tbody>
                <tr v-for="reserv in reservs" :key="reserv.id">
                    <td class="ps-4">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-calendar fs-2"></i>
                           <h6><a href="fs-6 fw-bold">{{ reserv.proposito }}</a></h6>
                        </div>
                    </td>
                    <td>
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
                            <a href="" @click.prevent="deleteReservation(reserv.id)" v-show="access.typeUser =='admin'"><i class="fa-solid fa-trash fs-6"></i></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <mView :view="dataView"/>
    </div>
</template>

<script setup>
import mView from "../components/modals/viewReservation.vue";
import { defineProps, ref, onMounted } from "vue";
import axios from "axios";

const props= defineProps(['reservs']);
const dataView=ref([]);
const listReservation=ref('');
const access= ref('');

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

onMounted(async () => {
    const storedUser = localStorage.getItem('user');
    access.value = JSON.parse(storedUser);
  try {
    const response = await fetch('http://localhost/condomino/src/backend/controllers/listReservation.php', { method: 'GET' });
    const json = await response.json();
    if (json.success) {
      listReservation.value = json.data;
      console.log(listReservation.value)
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }
});

function showReservation(id) {
  const selectedReservation = listReservation.value.find(reserv => reserv.id === id);
  if (selectedReservation) {
    dataView.value = {
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
    table{
        border-collapse: collapse;
        font-size: 14px;
        text-align: center;
        font-weight: 500;
        width: 100%;
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
        border-radius: 5px;
    }

    table thead tr{
        text-align: center;
        border-bottom: 1px solid rgb(179, 177, 177);
    }

    tbody tr td{
        padding: 10px 0;
    }

    tbody tr{
        border-bottom: 1px solid rgb(179, 177, 177);
    }
    tbody tr:last-child{
        border-bottom: none;
    }



    a{
        text-decoration: none;
        color: var(--inactive-color);
    }
     a:hover{
        color: var(--active-color);
     }
</style>