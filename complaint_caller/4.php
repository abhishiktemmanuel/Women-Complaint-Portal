<!DOCTYPE html>
<html>
<head>
    <title>Shelter Name Lookup</title>
</head>
<body>
    <h1>Shelter Name Lookup</h1>

    <form method="POST" action="">
        <label for="area">Enter Area:</label>
        <input type="text" name="area" id="area" required>
        <button type="submit">Search</button>
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the entered area
        $area = $_POST["area"];

        // Database connection settings
        $host = "localhost"; // Change to your database host
        $username = "root"; // Change to your database username
        $password = ""; // Change to your database password
        $database = "shelter_names"; // Change to your database name

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement to search for shelter names by area
        $sql = "SELECT shelter_name FROM shelters WHERE area = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $area);
        $stmt->execute();
        $stmt->bind_result($shelter_name);

        // Display the results
        if ($stmt->fetch()) {
            echo "<p>Shelters in $area:</p>";
            echo "<ul>";
            do {
                echo "<li>$shelter_name</li>";
            } while ($stmt->fetch());
            echo "</ul>";
        } else {
            echo "<p>No shelters found in $area.</p>";
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
    ?>
    <a href="1.html">Back to Search</a>
</body>
</html>
