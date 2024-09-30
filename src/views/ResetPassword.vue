<template>
    <div class="container-sm">
      <div class="row justify-content-center mt-5">
        
        <div class="col-md-4 py-4 px-5 mt-5" id="box">
            <h6 class="text-center mt-3"><i class="fa-solid fa-building-columns fs-3"></i></h6>
          <h5 class="text-center">Redefinir Senha</h5>
          <div class="col-md-12 mt-4">
            <label for="" class="fw-bold mb-2 fs-5">Código OTP</label>
            <input type="text" v-model="otp" class="form-control" placeholder="Digite o código OTP" />
          </div>
          <div class="col-md-12 mt-4">
            <label for="" class="fw-bold mb-2 fs-5">Nova Senha</label>
            <input type="password" v-model="newPassword" class="form-control" placeholder="Digite a nova senha" />
          </div>
          <div class="col-md-12 mt-4">
            <button class="btn w-100 fw-semibold py-2" @click.prevent="resetPassword">
              Redefinir Senha
              <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import axios from "axios";
  import { useRouter } from "vue-router";
  
  const router = useRouter();
  const otp = ref('');
  const newPassword = ref('');
  
  const resetPassword = async () => {
    try {
      const response = await axios.post('http://localhost/condomino/src/backend/controllers/resetPassword.php', {
        otp: otp.value,
        newPassword: newPassword.value,
      });
  
      // Adicione um log para verificar a resposta
      console.log(response.data); 
  
      if (response.data.success) {
        alert(response.data.message);
        router.push('/'); // Redireciona para a página de login
      } else {
        alert(response.data.message); // Mensagem de erro
      }
    } catch (error) {
      console.error('Erro ao redefinir a senha:', error);
      alert('Ocorreu um erro ao redefinir a senha.');
    }
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
  