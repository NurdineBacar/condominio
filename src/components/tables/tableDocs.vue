<template>
    <div>
        <table>
            <thead>
                <tr>
                    <td>Ficheiro</td>
                    <td>Formato</td>
                    <td>Tamanho</td>
                    <td>Usuario</td>
                    <td>Data</td>
                    <td>Operacoes</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex gap-1 justify-content-center">
                            <i class="fa-regular fa-file-pdf fs-4"></i>
                            <span>Regulamento do Condomínio</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg" >pdf</span>
                    </td>
                    <td>
                        4 MB
                    </td>
                    <td class="" id="user-doc">
                        <span>Marcelo Administrador</span><br>
                        <span>marceloadministrador@gmail.com</span>
                    </td>
                    <td>
                        20/09/2024
                    </td>
                    <td class="d-flex gap-1 justify-content-center">
                        <button class="btn"><i class="fa-solid fa-download"></i></button>
                        <button class="btn" v-show="user.typeUser == 'admin'"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { ref,onMounted } from "vue";

const user = ref('');
  onMounted( async() => {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
      user.value = JSON.parse(storedUser);
    } 
    try{
        
    }catch(error){
        console.log("Erro ao buscar dados", error);
    }
  });</script>

<style scoped>
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
        border-bottom: 1px solid rgb(179, 177, 177);
    }

    tbody tr td{
        padding: 10px 0;
        text-align: center;
    }

    tbody tr{
        border-bottom: 1px solid rgb(179, 177, 177);
    }
    tbody tr:last-child{
        border-bottom: none;
    }


    #user-doc{
        font-size: 13px;
    }
   
    .badge{
        background: var(--inactive-color);
    }

   .btn{
    background: rgba(163, 163, 163,.3);
    border: 1px solid gray;
    color: var(--inactive-color);
   }

   .btn:hover{
    background: rgba(163, 163, 163,.6);
   }
</style>