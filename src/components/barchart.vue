<!-- BarChartComponent.vue -->
<template>
    <div>
      <div id="barchart" style="width: 100%; height: 500px;"></div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'barchart',
    mounted() {
      this.loadGoogleCharts();
    },
    methods: {
      loadGoogleCharts() {
        // Carregar o pacote do Google Charts
        google.charts.load('current', { packages: ['corechart', 'bar'] });
        google.charts.setOnLoadCallback(this.drawChart);
      },
      drawChart() {
        // Dados do gráfico
        const data = google.visualization.arrayToDataTable([
          ['City', '2010 Population', '2000 Population'],
          ['New York City, NY', 8175000, 8008000],
          ['Los Angeles, CA', 3792000, 3694000],
          ['Chicago, IL', 2695000, 2896000],
          ['Houston, TX', 2099000, 1953000],
          ['Philadelphia, PA', 1526000, 1517000],
        ]);
  
        // Opções de configuração do gráfico
        const options = {
          chart: {
            title: 'Population of Largest U.S. Cities',
            subtitle: 'Based on most recent and previous census data',
          },
          bars: 'horizontal' // Orientação horizontal
        };
  
        // Instanciar e desenhar o gráfico
        const chart = new google.visualization.BarChart(this.$refs.barchart);
        chart.draw(data, options);
      }
    }
  }
  </script>
  
  <style scoped>
  #barchart {
    width: 100%;
    height: 500px;
  }
  </style>
  