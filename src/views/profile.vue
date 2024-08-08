<template>
  <div class="row mt-1">
    <div class="col-md-3 py-4" id="data-profile">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="position-relative" id="img-profile">
            <button class=" btn rounded-circle" data-bs-toggle="modal" data-bs-target="#userEditModal"><i class="fa-solid fa-pen"></i></button>
            <img src="/img/cat.jpg" width="110px" height="110px" class="rounded-circle mx-auto" alt=""/>
          </div>
          <h6 class="text-center mt-2">NUrdine Aboo Bacar</h6>
          <span class="badge" id="typeUser">Morador</span>
          
        </div>
      </div>
      <div class="row gap-2 justify-content-center mt-3">
        <div class="col-md-10 rounded-pill text-center py-1 user-data">
          <h6>Nome</h6>
          <span class="">Nurdine Aboo Bacar</span>
        </div>
        <div class="col-md-10 rounded-pill text-center py-1 user-data">
          <h6>Contacto</h6>
          <span class="">845636664</span>
        </div>
        <div class="col-md-10 rounded-pill text-center py-1 user-data">
          <h6>Email</h6>
          <span class="">nurdinebacar@gmail.com</span>
        </div>
        <div class="col-md-10 rounded-pill text-center py-1 user-data">
          <h6>Casa</h6>
          <span class="">Nº 563</span>
        </div>
      </div>
    </div>

    <div class="col-md">
        <div class="container gap-2">
            <div class="row">
              <div class="col-md-10">
               <div class="d-flex gap-3">
                <uItem/>
                <uItem/>
                <uItem/>
               </div>
            </div>
            <div class="col-md">
              <button class="btn w-100  fw-semibold py-1" style="height: 100%;" id="visit"><i class="fa-solid fa-plus fs-5"></i> Visita</button>
            </div>
            </div>
            <div class="col-md-12 mt-3">
                <tProfile/>
            </div>
        </div>
        <userEditModal/>
    </div>
  </div>
</template>

<script setup>
import uItem from "../components/uItem.vue";
import tProfile from "../components/tableProfile.vue";
import userEditModal from "../components/userEditModal.vue";
</script>

<style scoped>
img {
  border: 2px solid rgba(128, 128, 128, 0.8);
  position: relative;
  left: 65px;
}

#data-profile{
    box-shadow: 0 0 5px rgba(0, 0, 0,.3),
    0 0 5px rgba(163, 163, 163,.5);
    background: white;
    border-radius: 10px;
    height: 440px;
}

#typeUser{
    margin-left: 90px;
    margin-top: 10px;
    background: var(--active-color);
}


#img-profile button {
  position: absolute;
  left: 140px;
  padding: 10px 12px;
  font-size: 13px;
  background: white;
  color: grayt;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3), 
                0 0 5px rgba(163, 163, 163, 0.5);
  z-index: 1;
}

#img-profile button:hover{
    transition: .32;
    background: rgb(231, 230, 230);
}

.user-data {
  border: 1px solid gray;
  background: rgba(218, 218, 218, 0.2);
  font-size: 13px;
}

.user-data h6{
    font-size: 13px;
    margin-bottom: -1px;
}


#visit{
    background: var(--inactive-color);
    color: var(--text-white);
  }

  #visit:hover{
    background: var(--active-color);
  }
</style>