<template>
    <div>
        <div class="d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked/>
        <label class="btn btn-outline-primary" for="btnradio1"><i class="fa-solid fa-list-check me-1"></i> Tarefas</label>

        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"/>
        <label class="btn btn-outline-primary" for="btnradio2"><i class="fa-solid fa-face-sad-tear me-1"></i> Reclamacoes</label>

        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off"/>
        <label class="btn btn-outline-primary" for="btnradio3"><i class="fa-solid fa-comment-dots me-1"></i> Comunicacoes</label>
      </div>
        </div>
      <canvas ref="myChart"></canvas>
    </div>
  </template>
  
  <script>
  import { Chart, registerables } from 'chart.js';
  
  // Registre todos os componentes necessários
  Chart.register(...registerables);
  
  export default {
    name: 'lineChart',
    data() {
      return {
        chartData: {
          labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
          datasets: [
            {
              label: 'My First dataset',
              backgroundColor: 'rgba(255, 3, 3, 0.2)', // Cor do preenchimento das áreas sob a linha
              borderColor: 'rgb(255, 3, 3)', // Cor da linha
              borderWidth: 2, // Largura da linha
              tension: 0.4, // Tension ajustado para criar efeito de onda
            //   fill: true, // Preencher a área abaixo da linha com a cor definida em backgroundColor
              data: [40, 20, 30, 60, 90, 50, 70]
            },
            {
              label: 'My First dataset',
              backgroundColor: 'rgba(66, 165, 245, 0.2)', // Cor do preenchimento das áreas sob a linha
              borderColor: '#42A5F5', // Cor da linha
              borderWidth: 2, // Largura da linha
              tension: 0.4, // Tension ajustado para criar efeito de onda
            //   fill: true, // Preencher a área abaixo da linha com a cor definida em backgroundColor
              data: [20, 30, 60, 30, 10, 90, 100]
            },

          ]
        },
        chartOptions: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: true,
              position: 'bottom', // Define a posição da legenda como direita
              align: 'bottom', // Alinha as labels da legenda ao início
              labels: {
                usePointStyle: true, // Usa estilo de ponto para labels
                padding: 10, // Espaçamento entre os itens da legenda
                boxWidth: 20, // Largura da caixa de cor ao lado do texto
              }
            },
            tooltip: {
              callbacks: {
                label: function(tooltipItem) {
                  return `${tooltipItem.label}: ${tooltipItem.raw}`;
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true // Começa o eixo Y do zero
            }
          }
        }
      };
    },
    mounted() {
      this.createChart();
    },
    methods: {
      createChart() {
        new Chart(this.$refs.myChart, {
          type: 'line', // Tipo de gráfico
          data: this.chartData,
          options: this.chartOptions
        });
      }
    }
  };
  </script>
  
  <style scoped>
  canvas {
    max-width: 100%;
    height: auto;
  }

  label{
    font-size: 13px;
  }
  </style>
  