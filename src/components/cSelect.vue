<template>
    <select name="" id="">
        <option v-for="opt in opts" :key="opt" :value="opt.val">{{ opt.name }}</option>
    </select>
</template>

<script setup>
import inputs from "../components/inputs.vue";
defineProps(['opts',])
</script>

<style scoped>
    select{
        width: 100%;
        height: 38px;
        border: 1px solid var(--inactive-color); 
        border-radius: 5px;
        outline: none;
        font-weight: 500;
        text-align: center;
        text-transform: capitalize;
        color: var(--inactive-color);
    }

    select option{
        font-weight: 500;
        text-transform: capitalize;
    }
</style>