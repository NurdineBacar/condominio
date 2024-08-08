<template>
    <div class="container-sm">
        <div class="row justify-content-center" >
           <div class="col-md-4 py-4 px-5 mt-5" id="box">
                <div class="row ">
                    <div class="col-md-12 d-flex justify-content-between">
                            <div>
                                <h4 class="">Entrar</h4>
                                <cite class="text-secondary w-25">Welcome back! Please login <br> to your account</cite>
                            </div>
                            <h4>LOGO</h4>
                    </div>
                    
                    <div class="col-md-12 mt-4">
                        <label for="" class="fw-bold mb-2 fs-5">Usuario</label>
                        <inputs typeInput="text" pHolder="Usuario" icon="fa-solid fa-user"/>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="" class="fw-bold mb-2 fs-5">Senha</label>
                        <inputs typeInput="password" pHolder="Senha" icon="fa-solid fa-key"/>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-flex justify-content-end">
                            <a href="" class="">Esqueceu sua senha?</a>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button class="btn w-100 fw-semibold py-2" @click="$emit('logar')">
                            Entrar
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> 
                        </button>
                    </div>
                    <div class="col-md-12 mt-4 text-center">
                        <span class="text-center">Nao tem conta? Cria a sua <a href="">clicando aqui</a></span>
                    </div>
                </div>
           </div>
        </div>
    </div>
</template>

<script>
import inputs from "../components/inputs.vue";

export default {
    name:"sign",
    components:{
        inputs,
    },
    methods:{

    },
    emits:['logar',],

}
</script>

<style scoped>
    #box{
        box-shadow: 0 0 8px rgba(0, 0, 0, .5);
        border-radius: 5px;
    }

    a{
        color: black;
    }

    a:hover{
        color: blue;
    }

    .btn{
        background: var(--inactive-color);
        color: var(--text-white);
    }

    .btn:hover{
        background: var(--active-color);
        color: var(--text-white);
    }
    
</style>