<template>
  <div class="">
    <div class="row mt-1">
      <div class="col-md">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked/>
          <label class="btn btnList" for="btnradio1">Moradores</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"/>
          <label class="btn btnList" for="btnradio2">Segurancas</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off"/>
          <label class="btn btnList" for="btnradio3">Admins</label>
        </div>
      </div>
      <div class="col-md">
           <div class="d-flex gap-1 justify-content-end">
            <button class="btn fw-semibold" data-bs-toggle="modal" data-bs-target="#userModal"><i class="fa-solid fa-user-plus"></i> Novo</button>
            <inputs input-type="search" icon="fa-solid fa-magnifying-glass" pHolder="Morador e Nº casa..." />
            <cSelect :opts="sort" class="w-25"/>
           </div>
      </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12" id="table">
            <users class="w-100"/>
        </div>
    </div>
    <uModal/>
  </div>
</template>

<script setup>
import cSelect from "../components/cSelect.vue";
import users from "../components/tableUsers.vue";
import uModal from "../components/userModal.vue";
import inputs from "../components/inputs.vue";
import { ref } from "vue";

let sort= [
    {val:"",name:'Filtro'},
    {val:"activo",name:'activo'},
    {val:"inativo",name:'inativo'},
]
</script>

<style scoped>
    .btnList{
     border: 2px solid #114d4d;
     background: #114d4d;
     color: white;
     font-weight: 600;
    }

.btnList:hover{
    background: #269c9c;
}

#table{
    padding-top: 5px;
    padding-bottom: 5px;
    height: 80vh;
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