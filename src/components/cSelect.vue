<template>
    <select name="" id="" :value="modelValue" @change="onChange">
        <option value="">Selecione</option>
        <option v-for="opt in opts" :key="opt" :value="opt.val">{{ opt.name }}</option>
    </select>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

// Define props and emits
const props = defineProps({
  modelValue: String,
  opts: Array
});

const emit = defineEmits(['update:modelValue']);

// Handle change event
function onChange(event) {
  emit('update:modelValue', event.target.value);
}
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