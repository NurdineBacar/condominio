<template>
  <div class="container-sm">
    <div class="row justify-content-center">
      <div class="col-md-4 py-4 px-5 mt-5" id="box">
        <div class="row">
            <h6 class="text-center mt-3"><i class="fa-solid fa-building-columns fs-3"></i></h6>
            <h5 class="text-center">Vila Olimpica</h5>

          <div class="col-md-12 mt-3">
            <label for="" class="fw-bold mb-2 fs-5">Usuario</label>
            <inputs
              typeInput="text"
              pHolder="Usuario"
              icon="fa-solid fa-user"
              v-model="username"
            />
          </div>
          <div class="col-md-12 mt-3">
            <label for="" class="fw-bold mb-2 fs-5">Senha</label>
            <inputP
              pHolder="Senha"
              icon="fa-solid fa-key"
              v-model="password"
            />
          </div>
          <div class="col-md-12 mt-3">
            <div class="d-flex justify-content-end">
              <a href="/forgotPassword" class="">Esqueceu sua senha?</a>
            </div>
          </div>
          <div class="col-md-12 mt-4">
            <button
              type="submit"
              class="btn w-100 fw-semibold py-2"
              @click.prevent="login"
            >
              Entrar
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
import { ref,defineEmits } from "vue";
import { store } from "../store";
import { useRouter } from "vue-router";
import inputP from "../components/inputPassword.vue";
import axios from "axios";

const router = useRouter();
const username = ref("");
const password = ref("");
const emits = defineEmits(['userData']);

const login = async () => {
  try {
    const response = await axios.post(
      "http://localhost/condomino/src/backend/controllers/login.php",
      {
        username: username.value,
        password: password.value,
      }
    );

    const data = response.data; // Axios já faz o parsing do JSON
    if (data.success) {
      console.log(data.data);
      localStorage.setItem('user', JSON.stringify(data.data));
      emits('userData', data.data);
      const redirectPath = data.data.typeUser === "seguranca" ? '/security' : '/home';
      router.push(redirectPath);
    } else {
      console.error("Erro ao consultar usuário: ", data.message);
      alert("Email ou Senha Incorrecto")
    }
  } catch (error) {
    console.error("Erro ao verificar o usuário: ", error);
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