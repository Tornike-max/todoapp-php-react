<?php

var_dump($_POST);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Car Details Form</h2>
        <form action="/addtodo" method="POST">
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" id="model" name="model" required>
            </div>
            <div class="form-group">
                <label for="car_engine">Car Engine:</label>
                <input type="number" id="car_engine" name="car_engine" step="0.1" required>
            </div>
            <div class="form-group">
                <label for="variant">Variant:</label>
                <input type="text" id="variant" name="variant" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>