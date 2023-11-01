<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../residuals/_dbconnect.php';

    if (isset($_POST['register_submit'])) {
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpass = $_POST["cpassword"];
        $terms = $_POST["agree_terms"];
        $exists = false;

        // Add a check to compare password and cpassword
        if ($password === $cpass) {
            if ($terms) {
                // Check if the phone number already exists in the database
                $check_sql = "SELECT * FROM `admin` WHERE phone = ?";
                $check_stmt = mysqli_prepare($conn, $check_sql);
                mysqli_stmt_bind_param($check_stmt, "s", $phone);
                mysqli_stmt_execute($check_stmt);
                $result = mysqli_stmt_get_result($check_stmt);

                if (mysqli_num_rows($result) > 0) {
                    // Phone number already exists, show an error message
                    echo '<script>
                    alert("Phone number already exists. Please use a different phone number.");
                    </script>';
                } else {
                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Use prepared statement to avoid SQL injection
                    $insert_sql = "INSERT INTO `admin` (`phone`, `email`, `password`) VALUES (?, ?, ?)";
                    $insert_stmt = mysqli_prepare($conn, $insert_sql);
                    // Bind parameters
                    mysqli_stmt_bind_param($insert_stmt, "sss", $phone, $email, $hashed_password);
                    
                    // Execute the statement
                    if (mysqli_stmt_execute($insert_stmt)) {
                        echo "f2";
                        // Registration successful, redirect to login-register.php
                        echo '<script>
                        window.location.href = "index.html";
                        alert("User registered");
                        </script>';
                        exit();
                    } else {
                        echo "f1";
                        // Registration failed
                        die("Registration failed: " . mysqli_error($conn));
                    }

                    // Close the prepared statement for insertion
                    mysqli_stmt_close($insert_stmt);
                }

                // Close the prepared statement for checking
                mysqli_stmt_close($check_stmt);
            
            }
            else {
                // Agree to tearms is neccessary
                echo '<script>
                window.location.href = "index.html";
                alert("Agree to terms is neccessary");
                </script>';
            }
        }
        else {
            // Passwords do not match, show an error message
            echo '<script>
            alert("Passwords do not match. Please try again.");
            </script>';
        }
    }   
}
?>
