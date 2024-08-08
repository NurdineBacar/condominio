<template>
    <div class="box rounded pt-3 pb-2 px-1 ">
      <div class="col-md-12 px-3 mb-1">
        <h5><i class="fa-solid fa-calendar-plus"></i> Reservas</h5>
        <span>Reservars marcadas para hoje</span>
        <p class="fs-6 fw-semibold amount">Quantidade: 12</p>
      </div>
      <div class="col-md-12 px-3 mb-1">
        <h5><i class="fa-solid fa-triangle-exclamation"></i> Avisos</h5>
        <span>Avisos para hoje</span>
        <p class="fs-6 fw-semibold amount">Quantidade: 12</p>
      </div>
      <div class="col-md-12 px-3 mb-1">
        <h5><i class="fa-regular fa-file-lines"></i> Documentos</h5>
        <span>Documentos publicados esta semana</span>
        <p class="fs-6 fw-semibold amount">Quantidade: 12</p>
      </div>
    </div>    
</template>

<style scoped>
    .box{
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
    }

    .amount, h5{
        color: var(--inactive-color);
    }
    
    span{
        font-size: 14px;
    }
</style>