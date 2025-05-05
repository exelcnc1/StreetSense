<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "rms123");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize user inputs
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if inputs are not empty
    if (!empty($username) && !empty($password)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a matching user is found
        if ($result->num_rows > 0) {
            // Login successful, redirect to admin UI
            header("Location: adminui.php");
            exit();
        } else {
            // Store error message in a variable to display in the login form
            $error_message = '<span style="color: red;">Invalid username or password.</span>';
            echo $error_message; // Display the error message
        }

        // Close the statement
        $stmt->close();
    } else {
        // Store error message for empty fields
        $error_message = "Please fill in both fields.";
        echo $error_message; // Display the error message for empty fields
    }
}

// Close the database connection
mysqli_close($conn);
?>
