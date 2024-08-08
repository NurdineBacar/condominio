<template>
   <form action="" method="post">
    <label for="file" class="d-flex flex-column"> 
        <input type="file" ref="inputFile" name="file" id="docs" accept=".docx,.pdf" @change="inputF" hidden>
        <button class="btn fw-semibold w-25 mx-auto" @click.prevent="btnClick"><i class="fa-solid fa-upload"></i> Escolher Documento</button>
        <p></p>
        <p class="fw-semibold text-center mt-2 item">Coloque o Ficheiro Aqui</p>
        <!-- <img src="../php/upload.php" alt=""> -->
    </label>
   </form>
</template>

<script setup>
    import { ref } from "vue";

    const inputFile=ref(null);

    function btnClick(){
        inputFile.value.click();
    }

    function inputF({target}){
        let file= target.files[0];
        if(file){
            let filename=file.name;
            upload(filename);
        }
    }


    function upload(name){
        let form= document.querySelector('form');

        let xhr= new XMLHttpRequest();      // criando novo xml ajax
        xhr.open("POST","/php/upload.php");    // enviando a solicitacao para  a Url especificada
        xhr.upload.addEventListener("progress", e =>{
            console.log(e);
        });
        let formData= new FormData(form);   //form data e um objecto que facilita o envio de formularios
        xhr.send(formData);     //enviando o formdata para o php
    }
     
</script>

<style scoped>

    button{
        font-size: 13px;
        background: var(--inactive-color);
        color: var(--text-white);
    }

    button:hover{
        background: var(--active-color);
        color: var(--text-white);
    }

    label{
        border: 2px solid gray;
        border-style: dashed;
        border-radius: 10px;
        padding-top: 20px;
        padding-bottom: 5px;
        background: rgb(230, 228, 228);
    }

    p{
        font-size: 13px;
    }
</style>