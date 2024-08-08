<template>
  <div class="row py-2 align-items-center">
    <div class="col-md">
        <h4>{{ page }}</h4>
    </div>
    <div class="col-md-auto  align-self-end">
      <div class="d-flex align-items-center">
        <span><i class="fa-regular fa-moon fs-5"></i></span>
        <button type="button" class="btn position-relative me-3">
            <i class="fa-regular fa-bell fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            99+
            <span class="visually-hidden">unread messages</span>
          </span>
        </button>

        <div class="d-flex align-items-center">
            <span class="mx-2 badge text-dark">Nurdine Aboo Bacar</span>
            <img src="/img/cat.jpg" class="rounded-circle" width="35px" height="35px" alt="">
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps(['page',])
</script>

<style scoped>
    img{
        border: 1px solid var(--profile-border-color);
    }
</style>