<template>
    <div class="position-relative">
        <label for=""><i :class="icon"></i></label>
        <input type="password" name="" id="" :placeholder="pHolder" v-model="internalValue">
    </div>
</template>

<script setup>
import { defineProps, defineEmits, ref, watch } from 'vue';

// Definindo as props recebidas
const props = defineProps(['icon', 'inputType', 'pHolder', 'modelValue']);

// Definindo o emit para emitir eventos de atualização
const emit = defineEmits(['update:modelValue']);

// Definindo uma ref para o valor interno do input
const internalValue = ref(props.modelValue);

// Observando mudanças no internalValue e emitindo um evento de atualização
watch(internalValue, (newValue, oldValue) => {
    emit('update:modelValue', newValue);
});

//Sincronizando o valor da prop modelValue com o valor interno
watch(() => props.modelValue, (newValue) => {
    internalValue.value = newValue;
});
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