<template>
    <div id="box" class="rounded py-3 px-2">
        <div class="d-flex justify-content-between align-items-center">
            <h6>Casa nº {{ home.nhouse }}</h6>
            <div class="d-flex gap-1">
                <span id="icon"><i class="fa-solid fa-home"></i></span>
                <span class="badge" data-status="active">Activo</span>
            </div>
        </div>
        <span class="badge mb-2"  id="moradores">Moradores</span>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex" id="users">
                <img src="/img/profile/user-profile.png" alt="" width="35px" height="35px" class="rounded-circle">
                <img src="/img/profile/user-profile.png" alt="" width="35px" height="35px" class="rounded-circle">
                <div class="nUsers rounded-circle">
                    <span class="fw-semibold text-white">+5</span>
                </div>
                <button class="rounded-circle mt-1 text-secondary" id="btn" data-bs-toggle="modal" data-bs-target="#userModal"><i class="fa-solid fa-plus"></i></button>
            </div>
            <div class="d-flex">
                <a href="" class=""><i class="fa-solid fa-eye"></i></a>
                <a href="" class=""><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="" class=""><i class="fa-solid fa-trash"></i></a>
            </div>
        </div>
        
    </div>
</template>


<script setup>
import { ref, defineProps,defineEmits } from "vue";

const props= defineProps(['home'])
</script>

<style scoped>
    #box{
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
    }

    img{
        border: 2px solid var(--text-white);
    }
    img:nth-child(2){
        position: relative;
        left: -10px;
    }

    #users{
        position: relative;
    }

   .nUsers{
        background: rgb(173, 172, 172);
        border: 2px solid var(--text-white);
        width: 35px;
        height: 35px;
        position: relative;
        left: -20px;
    }

    span[data-status="active"]{
        background: var(--active-house);
    }

    span[data-status="inactive"]{
        background: var(--inactive-house);
    }

    .nUsers span{
        position: relative;
        top: 4px;
        left: 5px;
    }

    #btn{
        border-style: dashed;
        border-color: gray;
        height: 30px;
        width: 30px;
        margin-left: -13px;
        transition: .2s;
    }

    #btn:hover{
        background: rgba(179, 177, 177, 0.4);
    }

    #moradores{
        background: var(--active-color);
        color: var(--text-white);
    }

    a{
        text-decoration: none;
        margin-right: 10px;
    }

    #icon,a{
        color: var(--inactive-color);
    }

    a:hover{
        color: var(--active-color);
    }
</style>