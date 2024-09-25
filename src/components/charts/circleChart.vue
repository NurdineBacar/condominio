<template>
    <div>
      <canvas ref="myChart"></canvas>
    </div>
  </template>
  
  <script>
  import { Chart, registerables } from 'chart.js';
  
  // Registre todos os componentes necessários
  Chart.register(...registerables);
  
  export default {
    name: 'circleChart',
    data() {
      return {
        chartData: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [
            {
              label: 'My First dataset',
              backgroundColor: ['#42A5F5', '#66BB6A', '#FFA726', '#FF7043', '#8E24AA', '#7E57C2', '#26C6DA'],
              data: [40, 20, 30, 60, 90, 50, 70]
            }
          ]
        },
        chartOptions: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: true,
              position: 'right', // Define a posição da legenda como esquerda
              align: 'start', // Alinha as labels da legenda ao início
              labels: {
                usePointStyle: true, // Usa estilo de ponto para labels
                padding: 20, // Espaçamento entre os itens da legenda
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
          type: 'pie', // Tipo de gráfico
          data: this.chartData,
          options: this.chartOptions
        });
      }
    }
  };
  </script>
  
  <style scoped>
  /* Adicione estilos personalizados aqui, se necessário */
  canvas {
    max-width: 100%;
    height: auto;
  }
  </style>
  