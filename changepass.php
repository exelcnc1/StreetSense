<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #F4E1C1;
        }
        .container {
            background: black;
            padding: 20px;
            border-radius: 18px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: white;
        }
        .input-group {
            margin-bottom: 10px;
        }
        .input-group input {
            width: 95%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid black;
            border-radius: 10px;
        }
        .input-group button {
            width: 100%;
            padding: 10px;
            background-color: yellow;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .input-group button:hover {
            background-color: green;
        }
    </style>
</head>
<body>
<div class="container">
    

    <form action="adminui.php" method="POST">
        <h2>Change Password</h2>
        <div class="input-group">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
        </div>
        
        <div class="input-group">
            
            <button type="submit">Confirm</button>
            
        </div>
    </form>
</div>
</body>
</html>
