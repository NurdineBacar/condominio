<template>
    <div>
        <table >
            <thead>
                <tr>
                    <td>Nome do Morador</td>
                    <td>Nome do Visitante</td>
                    <td>Casa</td>
                    <td>Data</td>
                    <td>Hora</td>
                    <td>Hora de Entrada</td>
                    <td>Hora de Saida</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="list in lists" :key="list.visita_id">
                    <td>
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
                        {{ list.hora_visita }}
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="d-flex gap-3 justify-content-center">
                           <button class="btn btn-danger rounded-circle"><i class="fa-solid fa-xmark"></i></button>
                           <button class="btn rounded-circle" id="visit-check" @click="acceptVisit(list)"><i class="fa-solid fa-check"></i></button>
                        </div>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import axios from 'axios';

const props = defineProps(['lists']);


const acceptVisit = async (visit)=>{
    try{
        
    }catch(error){
        console.log(error);
    }
}

</script>

<style scoped>
    button{
        width: 35px;
        height: 35px;
        text-align: center;
        border: 1px solid var(--border-color);
        padding: 5px;
    }
    table{
        border-collapse: collapse;
        font-size: 16px;
        text-align: center;
        font-weight: 600;
        width: 100%;
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
        border-radius: 5px;
    }

    table thead tr{
        text-align: center;
        border-bottom: 1px solid var(--border-color);
    }

    tbody tr td{
        padding: 10px 0;
    }

    tbody tr{
        border-bottom: 1px solid var(--border-color);
    }
    tbody tr:last-child{
        border-bottom: none;
    }

    #visit-check{
        background: var(--inactive-color);
        color: var(--text-white);
    }

    a{
        text-decoration: none;
        color: var(--inactive-color);
    }
     a:hover{
        color: var(--active-color);
     }
</style>