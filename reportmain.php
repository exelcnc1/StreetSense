<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Road Condition Report Form</title>
    <link rel="icon" type="image/x-icon" href="ss2.png" >
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            width: 300px;
            color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input, select, textarea {
            width: 95%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            background: yellow;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background: gold;
        }
    </style>
    <script>
        function checkOtherOption() {
            var incidentType = document.getElementById("incident-type");
            var otherInput = document.getElementById("other-incident");
            if (incidentType.value === "other") {
                otherInput.style.display = "block";
                otherInput.required = true;
            } else {
                otherInput.style.display = "none";
                otherInput.required = false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Report a Road Condition </h2>
        <form>
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="incident-type">Condition Type:</label>
            <select id="incident-type" name="incident-type" required onchange="checkOtherOption()">
                <option value="accident">Pothole Repairs</option>
                <option value="theft">Resurfacing</option>
                <option value="harassment">Bridge Inspection</option>
                <option value="harassment">Drainage Improvement</option>
                <option value="harassment">Lane Expansion</option>
                <option value="other">Other</option>
            </select>
            <input type="text" id="other-incident" name="other-incident" placeholder="Specify other incident" style="display: none;">

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <button type="submit">Submit Report</button>
        </form>
    </div>
</body>
</html>
