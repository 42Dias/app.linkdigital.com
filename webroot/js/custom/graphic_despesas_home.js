var ctx = document.getElementById('myChart4').getContext('2d')
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: payment_labels,
    datasets: [
      {
        label: 'Despesas',
        data: payment_values,
        backgroundColor: [
          '#DFFF00',
          '#FFBF00',
          '#FF7F50',
          '#DE3163',
          '#9FE2BF',
          '#40E0D0',
          '#6495ED',
          '#CCCCFF',
          '#DFFF00',
          '#FFBF00',
          '#FF7F50',
          '#DE3163',
          '#9FE2BF',
          '#40E0D0',
          '#6495ED',
          '#CCCCFF',
        ],
      },
    ],
  },
  options: {
    scales: {
      display: '',
    },
    legend: {
      display: true,
      position: 'bottom',
      align: 'left',
      labels: {
        boxWidth: 10,
      },
    },
    tooltips: {
      titleFontFamily: 'Open Sans',
      backgroundColor: 'rgba(0,0,0,0.7)',
      titleFontColor: 'white',
      caretSize: 5,
      cornerRadius: 2,
      xPadding: 10,
      yPadding: 10,
      callbacks: {
        label: (tooltipItem, data) => {
          const valor = currencyBRL(payment_values[tooltipItem.index])
          const label = payment_labels[tooltipItem.index]
          return `${label}: ${valor}`
        },
      },
    },
  },
})
