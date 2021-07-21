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
        <p>Total number of orders:</p>
        <p id="ordersTotal"></p>
    </div>
</main>
<script src="js/main.js"></script>
</body>
</html>
