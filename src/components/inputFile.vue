<template>
    <form @submit.prevent="uploadFile">
      <label for="file" class="d-flex flex-column"> 
        <input type="file" ref="inputFile" name="file" id="file" accept=".docx,.pdf" @change="handleFileChange" hidden>
        <button class="btn fw-semibold w-25 mx-auto" @click.prevent="btnClick">
          <i class="fa-solid fa-upload"></i> Escolher Documento
        </button>
        
        <p v-if="fileName" class="fw-semibold text-center mt-2">{{ fileName }}</p>
  
        <button v-if="fileName" class="btn btn-success w-25 mx-auto mt-3" type="submit">Enviar Documento</button>
  
        <p class="fw-semibold text-center mt-2 item">{{ uploadMessage }}</p>
        
        <div v-if="uploading" class="progress mt-2">
          <div class="progress-bar" role="progressbar" :style="{ width: progress + '%' }">{{ progress }}%</div>
        </div>
      </label>
    </form>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
import router from '@/router';
  
  const inputFile = ref(null);
  const fileName = ref('');
  const progress = ref(0);
  const uploading = ref(false);
  const uploadMessage = ref('Coloque o Ficheiro Aqui');
  const selectedFile = ref(null);
  
  function btnClick() {
    inputFile.value.click();
  }
  
  function handleFileChange(event) {
    const file = event.target.files[0];
    if (file) {
      fileName.value = file.name;
      selectedFile.value = file;  // Armazena o arquivo selecionado
    }
  }
  
  async function uploadFile() {
    if (!selectedFile.value) {
      alert('Escolha um documento antes de enviar!');
      return;
    }
  
    let formData = new FormData();
    formData.append('file', selectedFile.value);
    formData.append('fileName', fileName.value);  // Envia o nome do arquivo
  
    uploading.value = true;
    progress.value = 0;
  
    try {
      // Envia o arquivo
      const response = await axios.post('http://localhost/condomino/src/backend/controllers/addDocument.php', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        },
        onUploadProgress: event => {
          if (event.lengthComputable) {
            progress.value = Math.round((event.loaded * 100) / event.total);
          }
        }
      });
  
      // Exibe a mensagem de sucesso
      uploadMessage.value = response.data.message || 'Upload Concluído';
  
      // Chama a função para armazenar o nome do arquivo na base de dados
      await storeFileName(fileName.value);
      
      // Limpa o nome do arquivo após o upload
      fileName.value = '';
      selectedFile.value = null; // Reseta o arquivo selecionado
      location.href= '/documents';
    } catch (error) {
      uploadMessage.value = 'Erro ao fazer upload: ' + (error.response?.data?.message || 'Erro desconhecido');
      console.error(error);
    } finally {
      uploading.value = false;
    }
  }
  
  async function storeFileName(name) {
    try {
      const response = await axios.post('http://localhost/condomino/src/backend/controllers/storeFileName.php', {
        fileName: name,
      });

      console.log(response.data.message)
  
      console.log('Nome do arquivo armazenado:', response.data);
    } catch (error) {
      console.error('Erro ao armazenar o nome do arquivo:', error);
    }
  }
  
  </script>
  
  <style scoped>
  /* Estilos para o formulário e botão */
  button {
    font-size: 13px;
    background: var(--inactive-color);
    color: var(--text-white);
  }
  
  button:hover {
    background: var(--active-color);
    color: var(--text-white);
  }
  
  label {
    border: 2px solid gray;
    border-style: dashed;
    border-radius: 10px;
    padding-top: 20px;
    padding-bottom: 5px;
    background: rgb(230, 228, 228);
  }
  
  p {
    font-size: 13px;
  }
  
  .progress {
    height: 20px;
    background-color: #f3f3f3;
    border-radius: 5px;
    overflow: hidden;
  }
  
  .progress-bar {
    background-color: var(--active-color);
    height: 100%;
    text-align: center;
    color: white;
  }
  </style>
  