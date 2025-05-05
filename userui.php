<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STREETSENSE - Road Management System</title>
    <link rel="icon" type="image/x-icon" href="ss2.png" >   
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
            width: 80%;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px gray;
            border-radius: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
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
        .posts-container {
            width: 400px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: black;
            margin: 0 auto;
            margin-bottom: 60px;
        }
        .post-container {
            background: yellow;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            text-align: center;
        }
        .post-header {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .post-image {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .reactions span {
            cursor: pointer;
            margin-right: 10px;
        }
        .comments {
            margin-top: 10px;
        }
        .comment-box {
            width: 90%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <img src="ss.jpeg.png" class="logo" alt="StreetSense Logo">
        <h2>STREETSENSE - Road Management System</h2>
    </header>
    <nav>
        <a href="userui.php">Home</a>
        <a href="chooseinci.php">Report</a>
        <a href="contact.php">Contact</a>
    </nav>
    <div class="container">
        <h2>Welcome to STREETSENSE</h2>
        <p>A comprehensive road management system designed to improve traffic flow and city planning.</p>
    </div>
        <div class="posts-container">
            <div class="post-container">
                <div class="post-header">John Doe reported an incident</div>
                <img class="post-image" src="stop.jpg" alt="Incident Image">
                <p><strong>Location:</strong> Downtown Street</p>
                <p><strong>Description:</strong> A car accident happened near the traffic light.</p>
                <div class="reactions">
                    <span onclick="react(this, 'like')">👍 Like (<span class="likeCount">0</span>)</span>
                    <span onclick="react(this, 'angry')">😡 Angry (<span class="angryCount">0</span>)</span>
                    <span onclick="react(this, 'sad')">😢 Sad (<span class="sadCount">0</span>)</span>
                </div>
                <div class="comments">
                    <input type="text" class="comment-box" placeholder="Write a comment..." onkeypress="addComment(event, this)">
                    <div class="commentList"></div>
                </div>
            </div>
    
            <div class="post-container">
                <div class="post-header">Jane Smith reported an incident</div>
                <img class="post-image" src="block.webp" alt="Incident Image">
                <p><strong>Location:</strong> City Park</p>
                <p><strong>Description:</strong> A tree fell blocking the main pathway.</p>
                <div class="reactions">
                    <span onclick="react(this, 'like')">👍 Like (<span class="likeCount">0</span>)</span>
                    <span onclick="react(this, 'angry')">😡 Angry (<span class="angryCount">0</span>)</span>
                    <span onclick="react(this, 'sad')">😢 Sad (<span class="sadCount">0</span>)</span>
                </div>
                <div class="comments">
                    <input type="text" class="comment-box" placeholder="Write a comment..." onkeypress="addComment(event, this)">
                    <div class="commentList"></div>
                </div>
            </div>
        </div>
    
        <script>
            function react(element, type) {
                let parent = element.parentElement;
                let allReactions = parent.querySelectorAll("span");
                let countElement = element.querySelector("span");
                
                allReactions.forEach(span => {
                    span.style.opacity = "0.5";
                    let countSpan = span.querySelector("span");
                    if (countSpan) {
                        countSpan.textContent = "0";
                    }
                });
                element.style.opacity = "1";
                countElement.textContent = parseInt(countElement.textContent) + 1;
            }
            
            function addComment(event, inputElement) {
                if (event.key === "Enter" && inputElement.value.trim() !== "") {
                    let commentText = inputElement.value;
                    let commentList = inputElement.nextElementSibling;
                    let comment = document.createElement("p");
                    comment.textContent = commentText;
                    commentList.appendChild(comment);
                    inputElement.value = "";
                }
            }
        </script>
    
    <footer>
        &copy; 2025 STREETSENSE. All rights reserved.
    </footer>
</body>
</html>
