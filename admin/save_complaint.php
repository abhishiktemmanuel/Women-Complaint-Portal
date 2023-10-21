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




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["userId"];
    $complain_id = $_POST["Complain_Id"];
    $status = $_POST["status"]; // Get the updated status from the form

    // Check if the user and complaint exist in the database
    $checkSql = "SELECT * FROM complaints WHERE user_id = ? AND id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $user_id, $complain_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows == 1) {
        // The user ID and complaint ID exist, proceed with the update
        $updateSql = "UPDATE complaints SET pending = ? WHERE user_id = ? AND id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("sii", $status, $user_id, $complain_id);

        if ($stmt->execute()) {
            echo '<script>';
            echo 'alert("Status updated successfully!");';
            echo 'window.location.href = "dashboard.php";'; // Redirect to the dashboard after submission
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("Error updating status!");';
            echo 'window.location.href = "dashboard.php";'; // Redirect to the dashboard after submission
            echo '</script>';
        }

        $stmt->close();
    } else {
        // The user ID or complaint ID was not found
        echo '<script>';
        echo 'alert("User ID or Complaint ID not found!");';
        echo 'window.location.href = "admin_dashboard.php";'; // Redirect to the dashboard after submission
        echo '</script>';
    }

    $checkStmt->close();
}


$conn->close();






