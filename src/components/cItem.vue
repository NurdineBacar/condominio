<template>
    <div>
      <label>
        <input type="radio" :value="value" name="item" v-model="selected" @change="emitValue"/>
        <div class="d-flex py-4 px-3 rounded box">
          <span><i :class="icon + ' fs-5 me-2'"></i></span>
          <span class="fw-semibold">{{ evento }}</span>
        </div>
      </label>  
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  const props = defineProps(['icon', 'evento', 'value']);
  const emit = defineEmits(['update:selected']);
  
  const selected = ref(false);
  
  const emitValue = () => {
    emit('update:selected', props.value); // Emite o valor quando o item é selecionado
  };
  </script>
  
  <style scoped>
  div input {
    display: none;
  }
  
  .box {
    border: 2px solid var(--inactive-color);
    cursor: pointer;
    background: var(--text-white);
  }
  
  span {
    color: var(--inactive-color);
  }
  
  div input:checked + .box {
    border-color: var(--active-color);
  }
  
  div input:checked + .box span {
    color: #247d82;
  }
  
  .box:hover {
    border-color: var(--active-color);
  }
  </style>
  