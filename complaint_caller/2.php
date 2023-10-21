<!DOCTYPE html>
<html>
<head>
    <title>Police Station Phone Number Lookup</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Police Station Phone Number Lookup</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stationName = $_POST["stationName"];
        
        // Connect to your database (replace with your database credentials)
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "police_station_numbers";
        
        $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query the database for the phone number
        $sql = "SELECT phone_number FROM police_stations WHERE station_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $stationName);
        $stmt->execute();
        $stmt->bind_result($phoneNumber);
        $stmt->fetch();

        if ($phoneNumber) {
            echo "<p>Phone Number for $stationName: $phoneNumber</p>";
        } else {
            echo "<p>No phone number found for $stationName.</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    <a href="1.html">Back to Search</a>
</body>
</html>
