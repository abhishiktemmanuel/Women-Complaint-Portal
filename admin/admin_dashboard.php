<?php
//session_start();

// Check if the user is logged in (you should have a login system)
// if (!isset($_SESSION['admin_id'])) {
//     // Redirect the user to the login page if not logged in
//     header('Location: index.php');
//     exit();
// }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "complaint_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Use prepared statements to avoid SQL injection
$sql = "SELECT complaint_type, complaint_date, incident_date, complaint_description, pending, id, user_id FROM complaints ORDER BY complaint_date DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$activeComplaints = [];
$resolvedComplaints = [];

while ($row = $result->fetch_assoc()) {
    if ($row['pending'] == 1) {
        $activeComplaints[] = $row;
    } elseif ($row['pending'] == 0) {
        $resolvedComplaints[] = $row;
    }
}
$stmt->close();

// Check if the form has been submitted to update the status
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["userId"];
    $complain_id = $_POST["Complain_Id"];
    $status = $_POST["status"]; // Get the updated status from the form

    // Update the status in the database
    $sql = "UPDATE complaints SET pending = ? WHERE user_id = ? AND complain_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $status, $user_id, $complain_id);

    if ($stmt->execute()) {
        echo "Status updated successfully!";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<!-- ... rest of your HTML code ... -->

<?php
session_start();
// Check if the user is logged in (you should have a login system)
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header('Location: login1.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "complaint_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Use prepared statements to avoid SQL injection
$sql = "SELECT complaint_type, user_id, id, complaint_date, incident_date, complaint_description, pending FROM complaints ORDER BY complaint_date DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();


$activeComplaints = [];
$resolvedComplaints = [];

while ($row = $result->fetch_assoc()) {
    if ($row['pending'] == 1) {
        $activeComplaints[] = $row;
    } elseif ($row['pending'] == 0) {
        $resolvedComplaints[] = $row;
    }
}
$stmt->close();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS for styling -->
    <link rel="stylesheet" href="../residuals/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container">
            <img width = 46 height = 46 src="data:image/png;base64,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">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <ion-icon name="ellipsis-vertical-outline"></ion-icon>
</button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto ">

                        <button class="btn btn-primary" id="logoutButton">Logout</button>
                    </li>
                    
                </ul>
            </div>

        </div>
    </nav>
    <div class="main fluid row">

    <div class="container col-md-6" id="update" >
<h2 class="text-center">Update</h2>
<form class="wrapper" id="complaintForm" action="save_complaint.php" method="post">
   <div class="row">
      <div class="form-group col-md-6">
         <div class="form-group">
            <label for="userId">User ID</label>
            <input type="number" class="form-control" id="userId" name="userId" required>
         </div>
      </div>
      <div class="form-group">
         <label for="Complain_Id">Complain ID</label>
         <input type="number" class="form-control" id="Complain_Id" name="Complain_Id" required>
      </div>
   </div>
   <div class="form-group">
      <label>Status</label><br>
      <input type="radio" id="pending" name="status" value=1 required>
      <label for="pending">Pending</label><br>
      <input type="radio" id="resolved" name="status" value=0 required>
      <label for="resolved">Resolved</label>
   </div>
   <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

    
        <div class="container col-md-6">
            <h2 class="text-center">Active Complaints</h2>
            <div id="active-complaints">
            <?php
            // Display active complaints
            foreach ($activeComplaints as $complaint) {
                echo '<div class="complaint-card">' .
                    '<div class="card-header">' .
                        '<h5>' . $complaint['complaint_type'] . '</h5>' .
                        '<p>' . $complaint['incident_date'] . '</p>' .
                    '</div>' .
                    '<div class="card-body">' .

                        '<p>' . $complaint['complaint_description'] . '</p>' .
                        '<p>Registered: ' . $complaint['complaint_date'] . '</p>' .
                        '<p>complaint Id: ' . $complaint['id'] . '</p>' .
                        '<p>User ID: ' . $complaint['user_id'] . '</p>' .
                        '</div>' .
                    '</div>';
                    
            }
            ?>
            </div>

            <h2 class="text-center mt-6">Resolved Complaints</h2>
            <div id="resolved-complaints">
                <!-- Resolved Complaints will be displayed here -->
                <?php
                // Display active complaints
                foreach ($resolvedComplaints as $complaint) {
                    echo '<div class="complaint-card resolved">' .
                    '<div class="card-header">' .
                        '<h5>' . $complaint['complaint_type'] . '</h5>' .
                        '<p>' . $complaint['incident_date'] . '</p>' .
                    '</div>' .
                    '<div class="card-body">' .
                        '<p>' . $complaint['complaint_description'] . '</p>' .
                        '<p>Registered: ' . $complaint['complaint_date'] . '</p>' .
                        '<p>complaint Id: ' . $complaint['id'] . '</p>' .
                        '<p>User ID: ' . $complaint['user_id'] . '</p>' .
                        '</div>' .
                    '</div>';
                }
                ?>
            </div>
        </div>    
    </div>

    </div>

    <footer>
        <p>&copy; 2023 Women's Safety Hub</p>
    </footer>
    
    <!-- Include Bootstrap JS and jQuery -->
    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>














