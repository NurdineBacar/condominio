<template>
    <div class="container-sm">
      <div class="row justify-content-center mt-5">
        <div class="col-md-4 py-4 px-5 mt-5" id="box">
          <div class="row">
              <h6 class="text-center mt-3"><i class="fa-solid fa-building-columns fs-3"></i></h6>
              <h5 class="text-center">Vila Olimpica</h5>
            
            <div class="col-md-12 mt-3 ps-3">
                <span id="info" class="">Digite o endereço de e-mail 
                    verificado
                    e lhe enviaremos um link de redefinição
                     de senha.</span>
            </div>
            <div class="col-md-12 mt-1">
              <label for="" class="fw-bold mb-2 fs-5">Email</label>
              <inputs typeInput="text" pHolder="Email" icon="fa-solid fa-user" v-model="email"
              />
            </div>
            <div class="col-md-12 mt-4">
              <button type="submit" class="btn w-100 fw-semibold py-2" @click.prevent="verifyEmail">
                Verificar
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
              </button>
            </div>
            <div class="col-md-12 mt-4 text-center">
              <!-- <span class="text-center">Nao tem conta? Cria a sua <a href="">clicando aqui</a></span> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import { store } from "../store";
  import { useRouter } from "vue-router";
  import axios from "axios";
  
  const router = useRouter();
  const email = ref(''); // Corrigido o nome da variável

const verifyEmail = async () => {
  try {
    const response = await axios.post('http://localhost/condomino/src/backend/controllers/sendOtp.php', {
      email: email.value,
    });

    if (response.data.success) {
      alert(response.data.message);
      router.push('/reset-password'); // Redireciona para a página de redefinição de senha
    } else {
      alert(response.data.message);
    }
  } catch (error) {
    console.error('Erro ao verificar o email:', error);
    alert('Ocorreu um erro ao verificar o email.');
  }
};

  
  </script>
  
  <script>
  import inputs from "../components/inputs.vue";
  
  export default {
    name: "sign",
    data() {
      return {};
    },
    components: {
      inputs,
    },
    methods: {},
  };
  </script>
  
  <style scoped>
  #box {
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
    border-radius: 5px;
  }
  
  a {
    color: black;
  }

  #info {
    font-size: 13px;
  }
  
  a:hover {
    color: blue;
  }
  
  .btn {
    background: var(--inactive-color);
    color: var(--text-white);
  }
  
  .btn:hover {
    background: var(--active-color);
    color: var(--text-white);
  }
  </style>