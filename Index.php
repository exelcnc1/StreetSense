<?php
include('dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STREETSENSE Login</title>
    <link rel="icon" type="image/x-icon" href="ss2.png" >
    

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: black;
        }
         
        h1 {
            margin-bottom: 20px;
            color: white;
        }
        .logo {
            width: 150px;
            height: auto;
            margin-top: 10px ;
        }
        .container {
            background: black;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            display: flex;
            gap: 15px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            background-color: yellow;
            color: black;
        
        }
        .btn:hover {
    background-color: rgb(245, 192, 20); 
}
        
        .btn img {
            width: 200px;
            height: 200px;
        }
        p{
            color: white;
            font-size: 18px;
            text-align: center;
        }

        a {
    text-decoration: none;
}

        .connection-status {
            color: white;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            background-color: rgba(0, 255, 0, 0.2);
        }
        .error {
            background-color: rgba(255, 0, 0, 0.2);
        }
        
    </style>
</head>
<body>
    <?php if ($conn->connect_error): ?>
        
    <?php else: ?>
       
    <?php endif; ?>

    <img src="ss.jpeg.png" alt="StreetSense Logo" class="logo">
    <h1>STREETSENSE</h1>
    <p>
        Welcome to StreetSense, your comprehensive solution for road maintenance and safety.<br>
        Choose your role to get started.<br>
        <br>
        
        
    </p>
    <div class="container">
        <a href="loginuser.php" target="_blank">
        <button class="btn">
            <img src="user.png"   alt="User Icon">
            USERNAME LOGIN
        </button>
    </a>
    <a href="loginadmin.php" target="_blank">
        <button class="btn">
            <img src="admin.png"  alt="Admin Icon">
            ADMIN LOGIN
        </button>
        </a>
    
    </div>
</body>
</html>
