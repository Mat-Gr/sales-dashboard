function init () {
  updateOrdersTotal()
}

function updateOrdersTotal(from, to) {
  return fetchAllOrders(from, to)
    .then(data => {
      document.getElementById('ordersTotal').innerText = data.total
    })
    .catch(err => console.error(err))
}

function fetchAllOrders(from, to) {
  return axios.get('/api/orders')
    .then(res => res.data)
    .catch(err => console.error(err))
}

init()
