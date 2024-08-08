<template>
  <div>
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-auto">
            <item icon="fa-brands fa-slack" evento="Todos" />
          </div>
          <div class="col-md-auto">
            <item icon="fa-solid fa-calendar-plus" evento="Reservas" />
          </div>
          <div class="col-md-auto">
            <item icon="fa-solid fa-triangle-exclamation" evento="Avisos" />
          </div>
          <div class="col-md-auto">
            <item icon="fa-solid fa-person-circle-question" evento="Visitas" />
          </div>
          <div class="col-md">
            <button class="btn w-100 fw-semibold py-1" style="height: 100%;"><i class="fa-solid fa-plus fs-5"></i> Visita</button>
          </div>
        </div>

        <div class="row mt-2" id="boxList">
            <div class="col-md-12 ps-4 pe-2">
                <dashList/>
                <dashList/>
                <dashList/>
                <dashList/>
            </div>
        </div>
      </div>
      <div class="col-md">
        <div class="row">
          <div class="col-md-12">
            <mcalendar />
          </div>
          <div class="col-md-12 mt-2">
            <sEvent />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import item from "../components/cItem.vue";
import mcalendar from "../components/miniCalendar.vue";
import sEvent from "../components/statisticEvent.vue";
import dashList from "../components/dashList.vue";
</script>

<style scoped>
    #boxList{
        height: 72vh;
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .btn{
    background: var(--inactive-color);
    color: var(--text-white);
  }

  .btn:hover{
    background: var(--active-color);
  }
</style>