<!DOCTYPE html>
<html>
<head>
    <title>Hospital Name Lookup</title>
</head>
<body>
    <h1>Hospital Name Lookup</h1>

    <form method="POST" action="">
        <label for="location">Enter Location:</label>
        <input type="text" name="location" id="location" required>
        <button type="submit">Search</button>
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the entered location
        $location = $_POST["location"];

        // Database connection settings
        include '../residuals/_dbconnect.php';

        // Prepare the SQL statement to search for hospital names by location
        $sql = "SELECT NameofHospital FROM hospital_names WHERE location = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $location);
        $stmt->execute();
        $stmt->bind_result($NameofHospital);

        // Display the results
        if ($stmt->fetch()) {
            echo "<p>Emergency Hospital in $location:</p>";
            echo "<ul>";
            do {
                echo "<li>$NameofHospital</li>";
            } while ($stmt->fetch());
            echo "</ul>";
        } else {
            echo "<p>No hospitals found in $location.</p>";
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
    ?>
<a href="1.html">Back to Search</a>
</body>
</html>
