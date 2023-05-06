<template>
  <h4>Product Views</h4>
  <canvas id="myChart" width="400" height="200"></canvas>
</template>

<script>
import Chart from 'chart.js/auto';

export default {
  name: 'Chart',
  props: {
    data: [],
    labels : []
  },
  
  mounted() {
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: this.labels,
          datasets: [{
              label: 'Product',
              data: this.data,
              fill: true,
              backgroundColor: [
                  'rgba(226, 243, 244, 0.5)',
              ],
              borderColor: [
                  'rgb(75, 192, 192)',
              ],
              borderWidth: 1,
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          },
          plugins: {
            legend: { display: false },
          }
        }
      });
      myChart;
  }
}
</script>