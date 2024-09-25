<template>
    <div class="d-flex gap-2 rounded py-3 px-3 align-items-center justify-content-between" id="box">
        <div>
            <h5>{{ val }}</h5>
            <span>{{ title }}</span>
        </div>
        <span class="ms-1"><i class="fa-solid fa-chart-simple" id="icon"></i></span>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const props= defineProps(['val','title'])
</script>

<style scoped>
    #box{
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3), 
                    0 0 5px rgba(163, 163, 163, 0.5);
                    width: 150px;
    }

    #icon{
        font-size: 50px;
    }
</style>