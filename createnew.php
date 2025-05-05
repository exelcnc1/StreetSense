<?php
include 'dbcreate.php';
if (isset($_POST['Create'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobileno = $_POST['mobileno'];
    $password = $_POST['password'];
    $username = $_POST['username'];
   
    $sql = "INSERT INTO login (first_name, last_name, mobileno, password, username) 
    VALUES ('$first_name', '$last_name', '$mobileno', '$password', '$username')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "Account Created Successfully";
        header("Location: adminui.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    
    body {
        font-family: 'arial' Sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #F4E1C1;
    }
    
    .container {
        width: 350px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 18px;
        background: rgb(16, 16, 16);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    
    h1, h3 {
        text-align: center;
        color: #eee9e9;
    }
    
    label {
        display: block;
        margin: 10px 0 5px;
    }
    
    input {
        width: 94%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
    button {
        width: 100%;
        padding: 10px;
        background-color: #f0e000;
        color: rgb(3, 3, 3);
        border: none;
        border-radius: 4px;
        margin-bottom: 15px;
        cursor: pointer;
    }
    
    button:hover {
        background-color: #4cae4c;
    }
    </style>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Create New Account</title>
</head>
<body>
    <div class="container">
        <h1>Streetsense</h1>
        <h3 align ="center">Create New Account</h3>
        <form method="POST">
            
            <input type="text" name="username" placeholder="User Name" required>

            <input type="text"  name="first_name" placeholder="First Name" required>
            
            <input type="text" name="last_name" placeholder="Last Name" required>

            

            <input type="text" name="mobileno" placeholder="Mobile Number" autocomplete="off" required>


            <input type="password" placeholder="Password" name="password">

            <button type="submit" name="Create">Create</button>
        </form>
    </div>
</body>
</html>
