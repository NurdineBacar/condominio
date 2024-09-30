<template>
    <div>
        <table>
            <thead>
                <tr>
                    <td>Ficheiro</td>
                    <td>Formato</td>
                    <td>Usuario</td>
                    <td>Data</td>
                    <td>Operacoes</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="doc in docs" :key="doc.id">
                    <td>
                        <div class="d-flex gap-1 justify-content-center">
                            <i class="fa-regular fa-file-pdf fs-4"></i>
                            <span>{{ doc.doc_name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg" >pdf</span>
                    </td>
                    <td class="" id="user-doc">
                        <span><i class="fa-solid fa-building fs-6 me-2"></i>Condomino</span><br>
                    </td>
                    <td>{{doc.data_registo}}
                    </td>
                    <td class="d-flex gap-1 justify-content-center">
                        <button class="btn" @click="downloadFile(doc.id)"><i class="fa-solid fa-download"></i></button>
                        <button class="btn" @click="deleteFile(doc.id)"  v-show="user.typeUser=='admin'"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref, onMounted, defineProps } from "vue";
import axios from "axios";

const props = defineProps(['docs']);
const lDocuments = ref(null);

const user = ref('');

onMounted(async () => {
  const storedUser = localStorage.getItem('user');
  if (storedUser) {
    user.value = JSON.parse(storedUser);
  } 
});

// Função para fazer download do arquivo
const downloadFile = async (docId) => {
  try {
    const response = await fetch(`http://localhost/condomino/src/backend/controllers/downloadFile.php?id=${docId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });
    if (response.ok) {
      const blob = await response.blob();
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = `file-${docId}.pdf`; // Altere conforme necessário
      document.body.appendChild(a);
      a.click();
      a.remove();
    } else {
      console.error('Erro ao fazer o download:', response.statusText);
    }
  } catch (error) {
    console.error('Erro ao buscar o arquivo:', error);
  }
};

// Função para excluir o arquivo
const deleteFile = async (docId) => {
  if (confirm('Tem certeza que deseja excluir este arquivo?')) {
    try {
      const response = await axios.post(`http://localhost/condomino/src/backend/controllers/deleteFile.php`, {
        id: docId, // Envie o ID como parte do corpo da requisição
      }, {
        headers: {
          'Content-Type': 'application/json',
        },
      });

      if (response.data.success) {
        alert(response.data.message); // Exiba a mensagem de sucesso
        // Atualize a lista de documentos removendo o documento excluído
        props.docs = props.docs.filter(doc => doc.id !== docId);
        location.href = '/documents'
      } else {
        console.error('Erro ao excluir o arquivo:', response.data.message);
        alert(response.data.message); // Exiba a mensagem de erro
      }
    } catch (error) {
      console.error('Erro ao excluir o arquivo:', error);
      alert('Ocorreu um erro ao excluir o arquivo.'); // Mensagem genérica de erro
    }
  }
};


</script>

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