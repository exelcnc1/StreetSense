<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - STREETSENSE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: black;
        }
        header {
            background-color: black;
            color: white;
            text-align: center;
            padding: 1em;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        header img {
            width: 50px;
            height: 50px;
        }
        nav {
            background-color: yellow;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: black;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
        }
        nav a:hover {
            background-color: #666;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px gray;
            border-radius: 10px;
            text-align: center;
        }
        input, textarea {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .logo {
            width: 100px;
            height: auto;
            
                
            
        }
    </style>
</head>
<body>
    <header>
        <img src="ss.jpeg.png" class="logo" alt="StreetSense Logo">
        <h2>Contact Us - STREETSENSE</h2>   
    </header>
    <nav>
        <a href="userui.php">Home</a>
        <a href="chooseinci.php">Report</a>
        <a href="contact.php">Contact</a>
    </nav>
    <div class="container">
        <h2>Get in Touch</h2>
        <p>Have any questions? Reach out to us.</p>
        <form>
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
    <footer>
        &copy; 2025 STREETSENSE. All rights reserved.
    </footer>
</body>
</html>
