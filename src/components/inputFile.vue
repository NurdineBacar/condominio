<template>
    <form @submit.prevent="uploadFile">
        <label for="file" class="d-flex flex-column"> 
            <input type="file" ref="inputFile" name="file" id="docs" accept=".docx,.pdf" @change="handleFileChange" hidden>
            <button class="btn fw-semibold w-25 mx-auto" @click.prevent="btnClick"><i class="fa-solid fa-upload"></i> Escolher Documento</button>
            
            <!-- Exibe o nome do arquivo selecionado -->
            <p v-if="fileName" class="fw-semibold text-center mt-2">{{ fileName }}</p>

            <!-- Botão de envio só aparece quando o arquivo é selecionado -->
            <button v-if="fileName" class="btn btn-success w-25 mx-auto mt-3" type="submit">Enviar Documento</button>

            <p class="fw-semibold text-center mt-2 item">{{ uploadMessage }}</p>
            
            <!-- Barra de progresso -->
            <div v-if="uploading" class="progress mt-2">
                <div class="progress-bar" role="progressbar" :style="{ width: `${progress}%` }">{{ progress }}%</div>
            </div>
        </label>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

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

function uploadFile() {
    if (!selectedFile.value) {
        alert('Escolha um documento antes de enviar!');
        return;
    }

    let formData = new FormData();
    formData.append('file', selectedFile.value);

    uploading.value = true;
    progress.value = 0;

    axios.post('http://localhost/condomino/src/backend/controllers/addDocument.php', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        onUploadProgress: event => {
            if (event.lengthComputable) {
                progress.value = Math.round((event.loaded * 100) / event.total);
            }
        }
    })
    .then(response => {
        uploadMessage.value = 'Upload Concluído';
        fileName.value = '';  // Limpa o nome do arquivo após o upload
    })
    .catch(error => {
        uploadMessage.value = 'Erro ao fazer upload';
        console.error(error);
    })
    .finally(() => {
        uploading.value = false;
    });
}
</script>

<style scoped>
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
