<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge, chrome=1"/>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="py-4">
<main>
    <div class="container">
        <h1>Welcome to the Dashboard</h1>
        <label for="fromDate">From date:</label>
        <input id="fromDate" type="date" name="from" value="today"/>
        <label for="toDate">To date:</label>
        <input id="toDate" type="date" name="to" value="today"/>

        <h3>Total number of orders:</h3>
        <p id="ordersTotal"></p>

        <h3>Number of orders over time:</h3>
        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

        <h3>Seed the database</h3>
        <p>If there are no Orders, you might need to seed the database:</p>
        <p>(You can do this multiple times, to get additional data & more interesting results)</p>
        <button id="seedBtn" class="btn btn-primary">Seed DB</button>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>'
<script src="js/main.js"></script>
</body>
</html>
