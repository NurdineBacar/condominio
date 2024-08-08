<template>
    <div id="" class="box rounded">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="d-flex align-items-center ps-4 pe-1 py-2">
            <span><i class="fa-solid fa-warning fs-4"></i></span>
            <div class="px-2 mx-2">
                <h6>Lorem</h6>
                <span class="text text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit...</span>
            </div>
        </div>
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden ">Next</span>
  </button>
</div>
    </div>
</template>

<style scoped>
    .box{
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
        height: 80px;
    }
     span i{
        color: var(--inactive-color);
     }
    h6{
        margin-bottom: -1px;
        font-size: 16px;
        color: var(--inactive-color);
    }
    .text{
        font-size: 12px;
    }

    .carousel-control-prev,
.carousel-control-next {
  width: 15px;
  height: 20px;
  top: 30px;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-color: var(--inactive-color);
}


</style>