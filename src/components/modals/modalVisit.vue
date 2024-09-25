<template>
    <div
      class="modal fade"
      id="addVisit"
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
              <i class="fa-solid fa-user-plus me-2"></i> Visita
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
                <span class="fw-semibold mb-2">Nome do Visitante</span>
                <inputs
                  input-type="text"
                  icon="fa-solid fa-lines-leaning"
                  pHolder="Nome do Visitante"
                  v-model="name_visit"
                />
              </div>
              <div class="col-md-10 mb-2">
                <span class="fw-semibold mb-2">Data</span>
                <inputs
                  input-type="date"
                  icon="fa-solid fa-calendar"
                  v-model="date_visit"
                />
              </div>
              <div class="col-md-10 mb-2">
                <span class="fw-semibold mb-2">Hora</span>
                <inputs
                  input-type="time"
                  icon="fa-solid fa-clock"
                  pHolder="Nome da casa"
                  v-model="time_visit"
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
              @click="addVisit"
            >
              <i class="fa-solid fa-check"></i> Adicionar
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
     
    <script setup>
  import inputs from "../inputs.vue";
  import { useRoute } from "vue-router";
  import { ref } from "vue";
  import axios from "axios";
  
  const name_visit=ref(''),
        date_visit=ref(''),
        time_visit=ref('');
const router= useRoute();

  const addVisit = async () => {
    try {
      const storedUser = localStorage.getItem('user');
      const user = JSON.parse(storedUser);
      const response = await axios.post(
        "http://localhost/condomino/src/backend/controllers/addVisit.php",
        {
          nome_visita: name_visit.value,
          data: date_visit.value,
          hora: time_visit.value,
          user_id: user.id,
        }
      );
  
      if (response.data.success) {
        console.log("Casa adicionado com sucesso:", response.data.message);
        location.href = router.name;
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