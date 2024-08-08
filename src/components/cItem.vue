<template>
    <div>
       <label class="">
        <input type="radio" name="item" value="one">
        <div class="d-flex py-4 px-3 rounded box">
            <span><i :class="icon+' fs-5 me-2'"></i></span>
            <span class="fw-semibold">{{ evento }}</span>
        </div>
       </label>  
    </div>
</template>

<script setup>
defineProps(['icon','evento']);
</script>

<script>
export default {
    mounted(){
        let input= document.querySelector('input:nth-child(1)');
        input.setAttribute('checked',"")
    }
}
</script>

<style scoped>
div input{
    display: none;
}

.box{
    border: 2px solid var(--inactive-color);
    cursor: pointer;
    background: var(--text-white);
    
}

span{
    color: var(--inactive-color);
}

div input:checked + .box{
   border-color: var(--active-color);
   
 
}

div input:checked + .box span{
    color: #247d82;
}

  
</style>