var chart = document.getElementById('myChart1').getContext('2d'),
  gradient_green = chart.createLinearGradient(0, 0, 0, 450)
gradient_green.addColorStop(0, 'rgba(46, 210, 66, 1)')
gradient_green.addColorStop(0.5, 'rgba(180, 255, 60, 0.2)')
gradient_green.addColorStop(1, 'rgba(180, 255, 60, 0)')

gradient_red = chart.createLinearGradient(0, 0, 0, 450)
gradient_red.addColorStop(0, 'rgba(255, 206, 44, 1)')
gradient_red.addColorStop(0.5, 'rgba(255, 206, 44, 0.2)')
gradient_red.addColorStop(1, 'rgba(255, 206, 44, 0)')

gradient_purple = chart.createLinearGradient(0, 0, 0, 450)
gradient_purple.addColorStop(0, 'rgba(255, 206, 44, 1)')
gradient_purple.addColorStop(0.5, 'rgba(255, 206, 44, 0.2)')
gradient_purple.addColorStop(1, 'rgba(255, 206, 44, 0)')
moment.locale('pt-BR')

let countDiffDays = 0
let countDiffMonth = 0
let labels = []

let dataFinances = []

const diffYears = moment(inputEndDate, 'DD/MM/YYYY').diff(moment(inputBeginDate, 'DD/MM/YYYY'), 'years')
const diffMonths = moment(inputEndDate, 'DD/MM/YYYY').diff(moment(inputBeginDate, 'DD/MM/YYYY'), 'months')
const diffDays = moment(inputEndDate, 'DD/MM/YYYY').diff(moment(inputBeginDate, 'DD/MM/YYYY'), 'days')

if (diffDays > 31) {
  for (const key in queryData) {
    const month = String(moment(queryData[key].created).format('MMM/YY'))
    const index = labels.indexOf(month.toUpperCase())

    if (index < 0) {
      labels.push(month.toUpperCase())
      const dataFinanceTemp = {
        reference: month.toUpperCase(),
        receipt: 0,
        payment: 0,
      }
      if (queryData[key].type === 'receipt') dataFinanceTemp.receipt = queryData[key].value
      if (queryData[key].type === 'payment') dataFinanceTemp.payment = queryData[key].value
      dataFinances.push(dataFinanceTemp)
    } else {
      const refer = dataFinances[index]
      if (queryData[key].type === 'receipt') refer.receipt = refer.receipt + queryData[key].value
      if (queryData[key].type === 'payment') refer.payment = refer.payment + queryData[key].value
    }
  }
} else {
  for (const key in queryData) {
    const month = String(moment(queryData[key].created).format('DD/MMM'))
    const index = labels.indexOf(month.toUpperCase())

    if (index < 0) {
      labels.push(month.toUpperCase())
      const dataFinanceTemp = {
        reference: month.toUpperCase(),
        receipt: 0,
        payment: 0,
      }
      if (queryData[key].type === 'receipt') dataFinanceTemp.receipt = queryData[key].value
      if (queryData[key].type === 'payment') dataFinanceTemp.payment = queryData[key].value
      dataFinances.push(dataFinanceTemp)
    } else {
      const refer = dataFinances[index]
      if (queryData[key].type === 'receipt') refer.receipt = refer.receipt + queryData[key].value
      if (queryData[key].type === 'payment') refer.payment = refer.payment + queryData[key].value
    }
  }
}

let dataReceita = [...dataFinances.map((finance) => finance.receipt)]
let dataDespesas = [...dataFinances.map((finance) => finance.payment)]
let dataLucratividade = [...dataFinances.map((finance) => finance.payment - finance.receipt * -1)]

var data = {
  labels,
  datasets: [
    {
      label: 'Lucratividade',
      backgroundColor: 'transparent',
      pointBackgroundColor: '#999',
      borderWidth: 2,
      borderColor: '#999',
      data: dataLucratividade,
      pointStyle: 'cross',
    },
    {
      label: 'Despesas',
      backgroundColor: gradient_red,
      pointBackgroundColor: '#333',
      borderWidth: 1,
      borderColor: 'transparent',
      data: dataDespesas,
      pointStyle: 'cross',
    },
    {
      label: 'Receitas',
      backgroundColor: gradient_green,
      pointBackgroundColor: '#41d242',
      borderWidth: 1,
      borderColor: 'transparent',
      data: dataReceita,
      pointStyle: 'cross',
    },
  ],
}

var options = {
  responsive: true,
  maintainAspectRatio: true,
  animation: {
    easing: 'easeInOutQuad',
    duration: 520,
  },
  scales: {
    xAxes: [
      {
        gridLines: {
          color: 'rgba(200, 200, 200, 0.05)',
          lineWidth: 1,
        },
      },
    ],
    yAxes: [
      {
        gridLines: {
          color: 'rgba(200, 200, 200, 0.08)',
          lineWidth: 1,
        },
        ticks: {
          callback: (value) => {
            return currencyBRL(value)
          },
        },
      },
    ],
  },
  elements: {
    line: {
      tension: 0.4,
    },
  },
  legend: {},
  point: {
    backgroundColor: 'white',
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
      label: (tooltipItem) => {
        return currencyBRL(tooltipItem.value)
      },
    },
  },
}

var chartInstance = new Chart(chart, {
  type: 'line',
  data: data,
  options: options,
})
