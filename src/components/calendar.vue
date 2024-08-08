<template>
    <div class="box rounded pt-2 pb-3 px-1">
        <div class="d-flex justify-content-center mb-2 mt-1">
            <span class="me-2 fw-semibold">{{  month }} de {{ year }}</span>
        </div>
        <ul class="week mt-3">
            <li>Seg</li>
            <li>Ter</li>
            <li>Qua</li>
            <li>Qui</li>
            <li>Sex</li>
            <li>Sab</li>
            <li>Dom</li>
        </ul>
        <div class="">
            <carousel/>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            month:"",
            year:"",
            months:[
            'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro',
            'Outubro','Novembro','Dezembro'
                ]
        }
    },
    mounted(){
        let data= new Date();
        let diaNumero=data.getDay();
        let dia= data.getDate();

        let h2= document.createElement('h6');
        h2.innerHTML= dia;
        h2.style.cssText="text-align:center;"
        
        let activo= document.querySelector("ul li:nth-child("+diaNumero+")");
        activo.classList.add('active')

        activo.appendChild(h2);

        this.month=this.months[data.getMonth()];
        this.year=data.getFullYear();
    },
    method:{
      
    }
}
</script>

<style scoped>
    .box{
        background: var(--bg-box);
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
    }
    ul{
        margin: 0px;
        padding: 4px 10px;
        list-style: none;
        display: flex;
        justify-content: space-around;
    }

    ul li{
      margin: 0px 8px;
      font-weight: 700;
      font-size: 12px;
    }

    ul li.active{
        position: relative;
        font-size: 15px;
        top: -10px;
        padding: 5px 7px;
        background: var(--active-color);
        border: 2px solid var(--inactive-color);
        border-radius: 5px;
        color: var(--text-white);
    }

    ul li.active h6{
        text-align: center;
    }

</style>