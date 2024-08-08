<template>
    <div class="row box rounded align-items-center px-2 py-2 my-2">
        <div class="col-md-auto">
            <span id="icon"><i class="fa-regular fa-file-lines fs-1 " ></i></span>
        </div>

        <div class="col-md">
            <h5>Lorem</h5>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio voluptatibus
                voluptatem laboriosam aspernatur labore consequuntur libero numquam 
                iure delectus ullam! Molestiae, 
                beatae enim doloribus amet voluptatum vero sunt! Unde, culpa!
            </p>
        </div>
    </div>    
</template>

<style scoped>
.box{
        width: 43em;
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                     0 0 5px rgba(163, 163, 163,.5);
    }

    h5{
        font-size: 18px;
        margin-bottom: -0px;
    }

    h5, #icon{
        color: var(--inactive-color);
    }
    p{
        font-size: 13px;
    }
</style>