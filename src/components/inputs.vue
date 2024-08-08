<template>
    <div class="position-relative">
        <label for=""><i :class="icon"></i></label>
        <input :type="inputType" name="" id="" :placeholder="pHolder">
    </div>
</template>

<script setup>
defineProps(['icon','inputType','pHolder'])
</script>

<style scoped>
    input{
        width: 100%;
        height: 38px;
        border: 1px solid var(--inactive-color); 
        border-radius: 5px;
        outline: none;
        padding-left: 35px;
        font-weight: 500;
        color: var(--inactive-color);
    }

    label{
        position: absolute;
        top: 7px;
        left: 10px;
        color: var(--inactive-color);
    }
</style>