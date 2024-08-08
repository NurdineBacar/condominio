<template>
  <div class="row">
    <div class="col-md-8">
      <div class="col-md-12">
        <div class="d-flex gap-2">
          <item icon="fa-brands fa-slack" evento="Todas" />
          <item icon="fa-solid fa-home" evento="Desta Semana" />
          <item icon="fa-solid fa-home" evento="Este Mês" />
        </div>
        <div class="col-md-12">
         <div class="row ps-4" id="box">
            <list/>
            <list/>
            <list/>
            <list/>
            <list/>
            <list/>
            <list/>
         </div>
        </div>
      </div>
    </div>
    <div class="col-md">
      <div class="row">
        <div class="col-md-12 mt-2">
          <div class="d-flex gap-2">
            <button class="btn btn-outline-success fw-semibold" data-bs-toggle="modal" data-bs-target="#reservationModal"><i class="fa-solid fa-plus"></i> Nova</button>
            <inputs icon="fa-solid fa-magnifying-glass" input-type="search" p-holder="Procurar Reserva"/>
          </div>
        </div>
        <div class="col-md-12 mt-3">
          <calendar/>
        </div>
        <div class="col-md-12 mt-2">
          <div class="dash rounded pt-3 pb-2 px-1 mt-2">
        <div class="col-md-12 px-3 mb-1">
          <h5><i class="fa-solid fa-calendar-plus"></i> Total Reservas</h5>
          <p class="fs-6 fw-semibold amount">Quantidade: 12</p>
        </div>
        <div class="col-md-12 px-3 mb-1">
          <h5><i class="fa-solid fa-triangle-exclamation"></i> Reservas desta semana</h5>
          <p class="fs-6 fw-semibold amount">Quantidade: 12</p>
        </div>
        <div class="col-md-12 px-3 mb-1">
          <h5><i class="fa-regular fa-file-lines"></i> Reservas de Hoje</h5>
          <p class="fs-6 fw-semibold amount">Quantidade: 12</p>
        </div>
      </div>
        </div>
      </div>
    </div>
    <rModal/>
  </div>
</template>

<script setup>
import item from "../components/cItem.vue";
import list from "../components/dashList.vue";
import inputs from "../components/inputs.vue";
import rModal from "../components/reservationModal.vue";
import calendar from "../components/calendar.vue";
</script>

<style scoped>

    #box{
        height: 75vh;
        overflow-y: auto;
        scrollbar-width: thin;
    }

.dash{
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
        0 0 5px rgba(163, 163, 163,.5);
    }

    .amount, h5{
        color: #003b41;
    }
    
    span{
        font-size: 14px;
    }

    .btn{
    background: var(--inactive-color);
    color: var(--text-white);
  }

  .btn:hover{
    background: var(--active-color);
  }
</style>