<template>
  <div
    class="modal fade"
    id="houseModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
            <i class="fa-solid fa-house-medical"></i> Nova Casa
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row gap-1 justify-content-center">
            <div class="col-md-10 mb-2">
              <span class="fw-semibold mb-2">Nº da Casa</span>
              <inputs
                input-type="text"
                icon="fa-solid fa-list-ol"
                pHolder="Nº da casa"
                v-model="nhouse"
              />
            </div>
            <div class="col-md-10 mb-2">
              <span class="fw-semibold mb-2">Nome da Casa</span>
              <inputs
                input-type="text"
                icon="fa-solid fa-house-chimney-crack"
                pHolder="Nome da casa"
                v-model="nome_casa"
              />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-outline-dark fw-semibold"
            data-bs-dismiss="modal"
          >
            <i class="fa-solid fa-xmark"></i> Cancelar
          </button>
          <button
            type="button"
            class="btn btn-success fw-semibold"
            @click="addHouse"
          >
            <i class="fa-solid fa-check"></i> Adicionar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
   
  <script setup>
import inputs from "../components/inputs.vue";
import cSelect from "../components/cSelect.vue";
import { ref } from "vue";
import axios from "axios";

let typeWarnings = ref([
  { val: "", name: "Seleciona" },
  { val: "manutencao", name: "MANUTENCAO" },
  { val: "evento", name: "evento" },
  { val: "Graducao", name: "Graducao" },
  { val: "Outros", name: "Outros" },
]);

let prioridade = ref([
  { val: "", name: "seleciona" },
  { val: "baixa", name: "baixa" },
  { val: "media", name: "media" },
  { val: "alta", name: "alta" },
  { val: "emergencia", name: "emergencia" },
]);

const nhouse=ref(''),
      nome_casa=ref('');

const addHouse = async () => {

  nome_casa.value= nome_casa.value.length>0? nome_casa.value: "casa";
  try {
    const response = await axios.post(
      "http://localhost/condomino/src/backend/controllers/addHouse.php",
      {
        nhouse: nhouse.value,
        nome_casa: nome_casa.value,
  
      }
    );

    if (response.data.success) {
      console.log("Casa adicionado com sucesso:", response.data.message);
      location.href = "/house";
      // Resetar campos ou fechar modal se necessário
    } else {
      console.log("Erro ao adicionar casa:", response.data.message);
    }
  } catch (error) {
    console.error("Erro ao adicionar casa:", error);
  }
};
</script>
  
   <style scoped>
cite {
  font-size: 13px;
}

textarea {
  width: 100%;
  border: 1px solid var(--inactive-color);
  border-radius: 5px;
  outline: none;
  padding: 10px;
  font-weight: 500;
}

#anexo {
  display: none;
}
#anex {
  text-decoration: underline;
  font-weight: 600;
  color: var(--active-house);
  cursor: pointer;
}
</style>