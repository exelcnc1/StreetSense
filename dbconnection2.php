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
        $stmt = $conn->prepare("SELECT * FROM login2 WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a matching user is found
        if ($result->num_rows > 0) {
            echo "Login successful!";
            header("Location: userui.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Please fill in both fields.";
    }
}

// Close the database connection
mysqli_close($conn);
?>

