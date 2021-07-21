function init () {
  initDateFilters()
  initSeedButton()
  updateOrdersTotal()
  updateOrdersChart()
}

function updateOrdersTotal () {
  return fetchAllOrders()
    .then(data => {
      document.getElementById('ordersTotal').innerText = data.total
    })
    .catch(err => console.error(err))
}

function updateOrdersChart () {
  return fetchGroupedOrders()
    .then(data => {
      const ctx = document.getElementById('myChart')
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: data.collection.map(obj => obj.purchase_date),
          datasets: [{
            data: data.collection.map(obj => obj.total),
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                stepSize: 1,
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false
          }
        }
      })

    })
    .catch(err => console.error(err))
}

function seedDatabase(e) {
  e.target.disabled = true

  return axios.get('/api/seed')
    .then(res => {
      e.target.disabled = false

      if (res.data.success) {
        alert('Database seeded succesfully');
      }

      onDateChange()
    })
    .catch(err => console.error(err))
}

function fetchAllOrders () {
  return axios.get('/api/orders', { params: getDateParams() })
    .then(res => res.data)
    .catch(err => console.error(err))
}

function fetchGroupedOrders () {
  return axios.get('/api/orders/grouped', { params: getDateParams() })
    .then(res => res.data)
    .catch(err => console.error(err))
}

function getDateParams() {
  const params = new URLSearchParams()
  const from   = document.getElementById('fromDate').value
  const to     = document.getElementById('toDate').value

  if (from) {
    params.append('from', `${from} 00:00:00`)
  }

  if (to) {
    params.append('to', `${to} 23:59:59`)
  }

  return params;
}

function initDateFilters () {
  const from = document.getElementById('fromDate')
  const to   = document.getElementById('toDate')

  const date = new Date()
  from.value = formatDate(new Date(date.getFullYear(), date.getMonth() - 1, 1))
  to.value   = formatDate(new Date(date.getFullYear(), date.getMonth(), 0))

  from.addEventListener('change', onDateChange)
  to.addEventListener('change', onDateChange)
}

function initSeedButton() {
  document.getElementById('seedBtn').addEventListener('click', seedDatabase)
}

function formatDate (date) {
  const d = date.getDate()
  const m = date.getMonth() + 1 //Month from 0 to 11
  const y = date.getFullYear()
  return '' + y + '-' + (m <= 9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d)
}

function onDateChange (e) {
  updateOrdersTotal()
  updateOrdersChart()
}

init()
