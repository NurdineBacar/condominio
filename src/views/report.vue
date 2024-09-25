<template>
    <div class="row py-2 px-3" id="content">
      <div class="col-md-12 rounded pt-3 pb-5" id="box-1">
        <lineChart id="chart" />
      </div>
      <div class="col-md-12 mt-2">
        <div class="row">
          <div class="col-md rounded item py-3 px-2">
            <div class="d-flex justify-content-between">
              <h6><i class="fa-solid fa-list-check me-1"></i>Tarefas</h6>
              <div class="d-flex gap-2">
                <span class="fa-solid fa-filtre"></span>
                <cSelect
                  :opts="[{ name: 'asdasdasd' }, { name: 'asfsdf' }]"
                  id="select"
                />
              </div>
            </div>
            <hr />
            <according ac="task"/>
          </div>
          <div class="col-md rounded item py-3 px-2">
              <div class="d-flex justify-content-between">
                  <h6><i class="fa-solid fa-face-sad-tear me-1"></i>Relamacoes</h6>
              <div class="d-flex gap-2">
                <span class="fa-solid fa-filtre"></span>
                <cSelect
                  :opts="[{ name: 'asdasdasd' }, { name: 'asfsdf' }]"
                  id="select"
                />
              </div>
            </div>
            <hr />
            <according/>
          </div>
          <div class="col-md rounded item py-3 px-2">
              <div class="d-flex justify-content-between">
              <h6><i class="fa-solid fa-comment-dots me-1"></i>Comunicacoes</h6>
              <div class="d-flex gap-2">
                <span class="fa-solid fa-filtre"></span>
                <cSelect
                  :opts="[{ name: 'asdasdasd' }, { name: 'asfsdf' }]"
                  id="select"
                />
              </div>
            </div>
            <hr />
            <according/>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import lineChart from "../components/charts/lineReportChart.vue";
  import cSelect from "../components/cSelect.vue";
  import according from "../components/according.vue";
  </script>
  
  <style scoped>
  #chart {
    height: 320px;
  }
  
  #box-1 {
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
  }
  
  .item {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
  }
  
  .item:nth-child(2) {
    margin: 0 10px;
  }
  
  #select {
    font-size: 13px;
  }
  
  #content {
    height: 97vh;
    overflow-y: auto;
    scrollbar-width: thin;
  }
  </style>