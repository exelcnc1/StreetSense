<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
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
            gap: 30px;
            background-color: yellow;
            color: black;
        
        }
        .btn:hover {
    background-color: green; 
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
        
        
    </style>
</head>
<body>
    <img src="ss.jpeg.png" alt="StreetSense Logo" class="logo">
    <h1>STREETSENSE</h1>
    <p>
       What kind of report you want to make?<br>
        <br>
        
        
    </p>
    <div class="container">
        <a href="reportinci.php" target="_blank">
        <button class="btn">
            <img src="incident.png"   alt="User Icon">
            INCIDENT REPORT
        </button>
    </a>
    <a href="reportmain.php" target="_blank">
        <button class="btn">
            <img src="maintenance.png"   alt="Admin Icon">
            ROAD CONDITION REPORT
        </button>
        </a>
    
    </div>
</body>
</html>

  