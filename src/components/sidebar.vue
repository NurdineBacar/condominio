<template>
    <div class="rounded py-3 position-relative bg-white" id="nav">
        <h3 class="text-center">LOGO</h3>
        <div class="row px-3 g-1 mt-4">
            <div class="col-md-12 my-2">
                <RouterLink to="/" class="navLink" :data-status="dash" @click="dash=active,limpar(e)"><i class="fa-solid fa-home me-2"></i>Painel</RouterLink>
            </div>
            <div class="col-md-12 my-2">
                <RouterLink to="/reservation" class="navLink" :data-status="reser" @click="reser='active'"><i class="fa-solid fa-calendar-plus me-2"></i>Reservas</RouterLink>
            </div>
            <div class="col-md-12 my-2">
                <RouterLink to="/warning" class="navLink" data-status=""><i class="fa-solid fa-triangle-exclamation me-2"></i>Avisos</RouterLink>
            </div>
            <div class="col-md-12 my-2">
                <RouterLink to="/security" class="navLink" data-status=""><i class="fa-solid fa-shield me-2"></i>Segurança</RouterLink>
            </div>
            <div class="col-md-12 my-2">
                <RouterLink to="/house" class="navLink" data-status=""><i class="fa-solid fa-house-user me-2"></i>Casas</RouterLink>
            </div>
            <div class="col-md-12 my-2">
                <RouterLink to="/profile" class="navLink" data-status=""><i class="fa-solid fa-user me-2"></i>Perfil</RouterLink>
            </div>
            <div class="col-md-12 my-2">
                <RouterLink to="/users" class="navLink" data-status=""><i class="fa-solid fa-users me-2"></i>Moradores</RouterLink>
            </div>
            <div class="col-md-12 my-2">
                <RouterLink to="/documents" class="navLink" data-status=""><i class="fa-solid fa-file-lines me-2"></i>Documentos</RouterLink>
            </div>
            <div class="col-md-12 my-2">
                <RouterLink to="/report" class="navLink" data-status=""><i class="fa-solid fa-chart-bar me-2"></i>Relatorios</RouterLink>
            </div>
        </div>

        <div class="row justify-content-center py-2 rounded" id="box1">
            <div class="col-md-10 ms-2 mb-2">
                <a href=""><i class="fa-solid fa-headset"></i> Suporte</a>
            </div>
            <div class="col-md-10 ms-2 mb-2">
                <a href="" class="" @click.prevent="$emit('logout')"><i class="fa-solid fa-right-from-bracket"></i> Terminar sessao</a>
            </div>    
            <div class="col-md-12 px-2">
                <span class="badge" id="badge">olindadacostaaa@gmail.com</span>      
            </div>   
        </div>
    </div>
</template>

<script>
import { RouterLink } from 'vue-router'

export default {
    name:"sidebar",
    data(){
        return{
            dash:"active",
            reser:"",
        }
    },
    emits:['logout',]
}
</script>

<style scoped>
    #nav{
        width: 220px;
        height: 97vh;
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
    }

    .navLink{
        text-decoration: none;
        font-weight: 600;
        padding-left: 15px;
        border-left: 2px solid white;
        padding-top: 5px;
        padding-bottom: 5px;
        color: var(--inactive-color);
    }

    .navLink[data-status="active"]{
        border-color: var(--active-color);
        color: var(--active-color);
    }

    .navLink:hover{
        color: var(--active-color);
    }

    #box1 a{
        text-decoration: none; 
        font-weight: 600;
        color: var(--text-white);
    }
    #box1 a:hover{
        color: var(--inactive-color);
    }

    #box1{
        position: absolute;
        bottom: 10px;
        left: 20px;
        width: 200px;
        background: var(--inactive-color);
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
    }

    #badge{
        background: var(--active-color);
    }

</style>