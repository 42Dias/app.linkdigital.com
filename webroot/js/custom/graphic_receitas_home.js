var ctx = document.getElementById('myChart3').getContext('2d')

var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: receipt_labels,
    datasets: [
      {
        label: 'Receitas',
        data: receipt_values,
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
          const valor = currencyBRL(receipt_values[tooltipItem.index])
          const label = receipt_labels[tooltipItem.index]
          return `${label}: ${valor}`
        },
      },
    },
  },
})
