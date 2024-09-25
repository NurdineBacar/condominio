<template>
    <div class="row box rounded align-items-center px-2 py-2 my-2">
        <div class="col-md-auto">
            <span id="icon"><i :class="list.icon+' fs-3'" ></i></span>
        </div>

        <div class="col-md">
            <h5>{{ list.title }}</h5>
            <p>
                {{ list.details }}
            </p>
        </div>
    </div>    
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps(['list'])

</script>

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