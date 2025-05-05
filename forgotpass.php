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
    <h2>Forgot Password?</h2>

    <form action="send_otp.php" method="POST">
        <div class="input-group">
            <label for="contact">Contact Number or Email:</label>
            <input type="text" id="contact" name="contact" placeholder="Enter your contact number or email" required>
        </div>
    </form>

    <form action="changepass.php" method="POST">
        <div class="input-group">
            <label for="otp">OTP Verification Code:</label>
            <input type="text" id="otp" name="otp" placeholder="Enter OTP " required>
        </div>
        <div class="input-group">
            <button type="submit">Verify OTP</button>
        </div>
    </form>

    
</div>
</body>
</html>
