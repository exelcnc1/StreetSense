
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SS USER Log in</title>
    <link rel="icon" type="image/x-icon" href="ss2.png" >
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #F4E1C1;
            color: white
        }
        .login-container {
            text-align: center;
            background: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            
        }
        .login-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .login-container input {
            width: 80%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container button {
            width: 87%;
            padding: 10px;
            background-color: yellow;
            color: black;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin: 8px 0;
        }
        
        .login-container button:hover {
            background-color: rgb(245, 192, 20); 
        }

        .button {
  background-color: #04AA6D; /* Green */
  border: none;
  color: white;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 13px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px
}

.h2 {
    font-size: 30px;
    margin-bottom: 10px;
}

.img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 15px;
    object-position: 80% 100%;
}
a {
  color: white;
}
    </style>
</head>
<body>
<form method="post" action="loginuser.php">
    <div class="login-container">
        <img class="img" src="ss.jpeg.png" alt="RMS"> 
        <h2 class="h2">StreetSense</h2>
        <p><a href="forgotpass.php">Forgot Password?</a></p>

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
            // Login successful, redirect to admin UI
            header("Location: userui.php");
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
        
            <input type="text" placeholder="Username" name="username" >
            <input type="password" placeholder="Password" name="password">
            <button type="submit"  class="button" name="submit">Login</button>
        </form>
        <form action="createnew2.php" method="POST">
            <button type="submit" class="button"> Create New Account </button>
        </form>
    </div>
</body>
</html>
