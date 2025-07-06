<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservation_data = array(
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "building" => $_POST["building"],
        "date" => $_POST["date"],
        "time" => $_POST["time"]
    );

    setcookie("reservation_data", serialize($reservation_data), time() + (86400 * 30), "/");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reservation Confirmation</title>
<style>
    body {
        font-family: 'Quicksand', sans-serif;
        padding: 20px;
        color: #0554F2;
        background-color: white;
        margin-top: 20px;
        margin-left: 125px;
        margin-right: 125px;
    }

    .confirmation-box {
        border-radius: 25px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        background-color: #0554F2;
        padding: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: white;
    }

    p {
        margin-bottom: 10px;
        color: white;
    }
</style>
</head>
<body>
<div class="confirmation-box">
    <?php
    if (isset($_COOKIE["reservation_data"])) {
        $reservation_data = unserialize($_COOKIE["reservation_data"]);
        echo "<h2>Reservation Confirmation</h2>";
        echo "<p>Name: " . $reservation_data["name"] . "</p>";
        echo "<p>Email: " . $reservation_data["email"] . "</p>";
        echo "<p>Building/Room: " . $reservation_data["building"] . "</p>";
        echo "<p>Date: " . $reservation_data["date"] . "</p>";
        echo "<p>Time Slot: " . $reservation_data["time"] . "</p>";
        echo "<p>Your reservation has been confirmed. Thank you!</p>";
    } else {
        echo "<h2>Error</h2>";
        echo "<p>Sorry, there was an error processing your request.</p>";
    }
    ?>
</div>
</body>
</html>
