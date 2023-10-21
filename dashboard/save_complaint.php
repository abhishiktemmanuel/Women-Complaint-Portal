<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "complaint_portal";
session_start();
$user_id = $_SESSION['user_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the complaints table
$sql_create_table = "
    CREATE TABLE IF NOT EXISTS complaints (
        id INT AUTO_INCREMENT PRIMARY KEY,
        complaint_type VARCHAR(255),
        incident_date DATE,
        complaint_description TEXT,
        pending INT
    )
";

if ($conn->query($sql_create_table) === TRUE) {
    echo "Table 'complaints' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complaintType = $_POST['complaintType'];
    $incidentDate = $_POST['incidentDate'];
    $complaintDescription = $_POST['complaintDescription'];
    $complaintDate = date('Y-m-d H:i:s');
    $pending = 1;

    // Insert complaint into the database
    $sql_insert_complaint = "INSERT INTO complaints (complaint_date, user_id, complaint_type, incident_date, complaint_description, pending) VALUES ('$complaintDate','$user_id', '$complaintType', '$incidentDate', '$complaintDescription', 1)";

    if ($conn->query($sql_insert_complaint) === TRUE) {
        echo '<script>';
        echo 'alert("Complaint submitted successfully!");';
        echo 'window.location.href = "dashboard.php";'; // Redirect to the dashboard after submission
        echo '</script>';
    } else {
        echo "Error: " . $sql_insert_complaint . "<br>" . $conn->error;
    }
}

$conn->close();
?>
