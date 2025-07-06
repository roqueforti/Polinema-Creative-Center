<?php
// Start a session to potentially store messages or data, though for this direct confirmation, it's not strictly necessary.
// session_start(); // Uncomment if you need session management beyond direct display.

// Set content type to HTML
header('Content-Type: text/html; charset=utf-8');

// Initialize variables to hold reservation data
$name = '';
$email = '';
$building = '';
$date = '';
$time = '';
$message = '';
$is_success = false;

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    // Using htmlspecialchars to prevent XSS attacks when displaying data
    $name = htmlspecialchars($_POST["name"] ?? '');
    $email = htmlspecialchars($_POST["email"] ?? '');
    $building = htmlspecialchars($_POST["building"] ?? '');
    $date = htmlspecialchars($_POST["date"] ?? '');
    $time = htmlspecialchars($_POST["time"] ?? '');

    // Basic validation
    if (empty($name) || empty($email) || empty($building) || empty($date) || empty($time)) {
        $message = "Error: All fields are required. Please go back and fill out the form.";
        $is_success = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Error: Invalid email format.";
        $is_success = false;
    } else {
        // Data is valid, proceed with "reservation"
        // In a real application, you would save this data to a database, send an email, etc.
        // For this example, we'll just prepare it for display.
        $message = "Your reservation has been confirmed. Thank you!";
        $is_success = true;

        // Example of how you might set a cookie if you needed to persist data across multiple pages
        // For a direct confirmation page, passing data directly is generally simpler.
        /*
        $reservation_data = [
            "name" => $name,
            "email" => $email,
            "building" => $building,
            "date" => $date,
            "time" => $time
        ];
        setcookie("reservation_data", serialize($reservation_data), time() + (86400 * 30), "/"); // 86400 = 1 day
        */
    }
} else {
    // If accessed directly without POST data
    $message = "Error: This page should be accessed via the reservation form submission.";
    $is_success = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for Inter font */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md">
        <?php if ($is_success): ?>
            <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">Reservation Confirmed!</h2>
            <div class="space-y-3 text-gray-700">
                <p><span class="font-semibold text-blue-600">Name:</span> <?php echo $name; ?></p>
                <p><span class="font-semibold text-blue-600">Email:</span> <?php echo $email; ?></p>
                <p><span class="font-semibold text-blue-600">Building/Room:</span> <?php echo $building; ?></p>
                <p><span class="font-semibold text-blue-600">Date:</span> <?php echo $date; ?></p>
                <p><span class="font-semibold text-blue-600">Time Slot:</span> <?php echo $time; ?></p>
                <p class="text-center text-lg text-green-600 font-medium mt-6"><?php echo $message; ?></p>
            </div>
        <?php else: ?>
            <h2 class="text-3xl font-bold text-center text-red-600 mb-6">Reservation Error</h2>
            <p class="text-center text-lg text-red-700 font-medium"><?php echo $message; ?></p>
            <div class="mt-6 text-center">
                <a href="index.html" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full shadow-md transition duration-300">
                    Go Back to Form
                </a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
