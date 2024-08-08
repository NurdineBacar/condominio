<template>
    <div>
        <table >
            <thead>
                <tr>
                    <td>Nome do Morador</td>
                    <td>Nome do Visitante</td>
                    <td>Casa</td>
                    <td>Data</td>
                    <td>Hora</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span><i class="fa-solid fa-house-user me-2"></i>
                            Nurdine Aboo Bacar</span>
                    </td>
                    <td>
                        Zulmira Macuacua
                    </td>
                    <td>
                        <span class="fw-semibold">Nº 562</span>
                    </td>
                    <td>
                       13/08/2024
                    </td>
                    <td>
                        13:00:00
                    </td>
                    <td>
                        <div class="d-flex gap-3 justify-content-center">
                           <button class="btn btn-danger rounded-circle"><i class="fa-solid fa-xmark"></i></button>
                           <button class="btn rounded-circle" id="visit-check"><i class="fa-solid fa-check"></i></button>
                        </div>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</template>



<style scoped>
    button{
        width: 35px;
        height: 35px;
        text-align: center;
        border: 1px solid var(--border-color);
        padding: 5px;
    }
    table{
        border-collapse: collapse;
        font-size: 16px;
        text-align: center;
        font-weight: 600;
        width: 100%;
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
        border-radius: 5px;
    }

    table thead tr{
        text-align: center;
        border-bottom: 1px solid var(--border-color);
    }

    tbody tr td{
        padding: 10px 0;
    }

    tbody tr{
        border-bottom: 1px solid var(--border-color);
    }
    tbody tr:last-child{
        border-bottom: none;
    }

    #visit-check{
        background: var(--inactive-color);
        color: var(--text-white);
    }

    a{
        text-decoration: none;
        color: var(--inactive-color);
    }
     a:hover{
        color: var(--active-color);
     }
</style>