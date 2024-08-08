<template>
  <div class="row rounded" id="box">
    <div class="col-md-5">
      <div class="d-flex gap-3 fw-semibold">
        <a href="">Tudo</a>
        <a href="">Visitas</a>
        <a href="">Reservas</a>
      </div>
    </div>
    <hr class="w-100 bg-secondary" />
    <div class="col-md-12" id="item">
      <div class="d-flex align-items-center py-1" id="info">
        <span><i class="fa-solid fa-home fs-3 ms-3 me-4"></i></span>
        <div>
          <h5>Lorem</h5>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio
            voluptatibus voluptatem laboriosam aspernatur labore consequuntur
            libero numquam iure delectus ullam! Molestiae, beatae enim doloribus
            amet voluptatum vero sunt! Unde, culpa!
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
#box {
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3), 
              0 0 5px rgba(163, 163, 163, 0.5);
  overflow: hidden;
}

a{
    text-decoration: none;
    padding: 8px 5px;
    color: var(--inactive-color);
}

a:hover{
  color:  var(--active-color);
}

h5 {
  font-size: 15px;
  margin-bottom: 0px;
}
p {
  font-size: 13px;
}

#info {
  border-bottom: 1px solid gray;
}

#info:last-child {
  border: none;
}

#item {
  height: 61vh;
  overflow-y: auto;
  scrollbar-width: thin;
  /* scrollbar-color: transparent transparent; */
}
</style>