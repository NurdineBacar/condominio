<template>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Notificacoes</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
      <div class="row">
        <div class="col-md-12 ps-3 mb-2">
          <a href="" class="d-flex align-items-center gap-3 justify-content-center p-2 rounded">
            <img src="/public//img/profile/user-profile.png" width="45px" height="45px" class="rounded-circle" alt="">
            <span><b>Olinda da Costa</b> Fez o pedido de reserva.</span>
          </a>
         
        </div>
        <div class="col-md-12 ps-3 mb-2">
          <a href="" class="d-flex align-items-center gap-3 justify-content-center p-2 rounded">
            <!-- <img src="/public//img/profile/user-profile.png" width="45px" height="45px" class="rounded-circle" alt=""> -->
            <span id="icon"><i class="fa-solid fa-building fs-2"></i></span>
            <span><b>Condominio</b> publicou um aviso sobre <b>Corte de Energia</b></span>
          </a>
        </div>
      </div>
  </div>
</div>
</template>

<script setup>

</script>


<style scoped>
    a{
      text-decoration: none;
      color: black;
    }

    a:hover, .notification:hover{
      background: rgb(233, 231, 231);
      transition: .2s ease-in;
      cursor: pointer;
    }
 
    #icon{
      color: var(--active-color);
    }

    .btn{
      font-size: 12px;
      font-weight: 600;
    }
</style>