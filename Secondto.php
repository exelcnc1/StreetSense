<!DOCTYPE html>
<html lang="en">
<head>
    <style>body {
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
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);;
    }
    
    h1, h3 {
        text-align: center;
        color: #ffffff;
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
        color: rgb(0, 0, 0);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 15px;
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
        <form action="Lastuser.php" method="POST">
            
            <input type="tel" id="mobile-number" name="mobile-number" placeholder="Mobile Number" required>
            
            <button type="submit">Send OTP</button>
        </form>
        <form action="Lastuser.php" method="POST">
            <input type="text" id="otp" name="otp" placeholder="OTP Verification Code" required>
        

            <button type="submit">Next</button>
        </form>
    </div>
</body>
</html>

