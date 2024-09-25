<template>
  <div
    class="modal fade"
    id="view"
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
            <i class="fa-solid fa-house-medical"></i> Detalhes {{ view.reservation? "da Reserva" : "do Aviso" }}
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row gap-1">
            <h5 class="text-center">{{ view.reservation? view.propose : view.title }}</h5>
            <hr />
            <div class="col-md-12 px-4">
              <table class="w-100">
                <tr>
                  <td>
                    <h6>{{ view.reservation? "Proposito" : "Titulo" }}</h6>
                    <span class="">{{ view.reservation? view.area: view.title }}</span>
                  </td>
                  <td>
                    <h6>{{ view.reservation? "Area" : "Tipo" }}</h6>
                    <span class="">{{ view.reservation? view.area :view.type }}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h6>{{ view.reservation? "Aprovacao" : "Nivel de Prioridade" }}</h6>
                    <span
                      class="badge bg-warning"
                      >{{ view.reservation? view.aprovation : view.level }}</span
                    >
                    
                  </td>
                  <td>
                    <h6>Estado</h6>
                    <span class="badge bg-primary">{{ view.status }}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h6>Data de registo</h6>
                    <span class="">{{ view.reg_date }}</span>
                  </td>
                  <td>
                    <h6>{{ view.reservation? "Data da Reserva": "Data de Validade" }}</h6>
                    <span class="">{{ view.end_date }}</span>
                  </td>
                </tr>
                <tr v-show="view.reservation">
                  <td>
                    <h6>Hora de inicio</h6>
                    <span class="">{{ view.init_time }}</span>
                  </td>
                  <td>
                    <h6>Hora do Termino</h6>
                    <span class="">{{ view.end_time }}</span>
                  </td>
                </tr>
              </table>
            </div>
            <hr />
            <div class="col-md-12 mb-1 ps-4">
              <h6>Descricao</h6>
              <span class="">
                {{ view.details.length>0? view.details : "Sem descricao ..." }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
   
  <script setup>
import { defineProps, ref } from "vue";

const props = defineProps(["view"]);


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
tr td{
  padding-bottom: 8px;
}

h6{
  margin-bottom: 4px;
}
</style>