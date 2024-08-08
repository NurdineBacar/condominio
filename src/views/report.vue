<template>
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
      <div class="col-md-12 mt-2">
            <div>
                <barchart/>
            </div>
      </div>
    </div>
</template>

<script setup>
import barchart from "../components/barchart.vue";
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
</style>