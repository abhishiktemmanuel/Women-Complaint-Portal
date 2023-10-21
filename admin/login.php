<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';

    // Check if the "login_submit" button was clicked
    if(isset($_POST['login_submit'])) {
        $phone = $_POST["id"];
        $password = $_POST["password"];
        $exists = false;

        // Use a prepared statement to retrieve the user's hashed password
        $sql = "SELECT * FROM `staff` WHERE admin_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $phone);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];

            // Use password_verify to check the password
            if (password_verify($password, $hashed_password)) {
                // Login successful, redirect to welcome.php
                session_start();
                $_SESSION['admin_id'] = $row['id']; // Store the user's ID in the session
                echo $_SESSION['admin_id'] ;
                // Redirect to a welcome page or user dashboard
                header('Location: admin_dashboard.php');
                exit();
            } 

            else {
                // Login failed, redirect to login-register.php with an error message
                echo '<script>
                window.location.href = "index.php";
                alert("Login failed. Invalid username or password!");
                </script>';
                exit();
            }
        } else {
            // Login failed, redirect to login-register.php with an error message
            echo '<script>
            window.location.href = "index.php";
            alert("Login failed. Invalid username or password!");
            </script>';
            exit();
        }
    }
}
?>