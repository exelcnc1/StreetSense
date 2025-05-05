<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreetSense: Road Management System</title>
    <link rel="icon" type="image/x-icon" href="ss2.png" >
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000;
            color: white;
            display: flex;
        }
        .sidebar {
            background-color: #111;
            width: 220px;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            font-size: 15px;
            transition: background 0.3s;
        }
        .sidebar a i {
            margin-right: 12px;
        }
        .sidebar a:hover {
            background-color: #1E73BE;
        }
        .container {
            margin-left: 260px;
            padding: 20px;
            flex-grow: 1;
        }
        .section {
            background: #222;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(255, 255, 255, 0.1);
        }
        h2 {
            color: #FFD700;
        }
        .dashboard-grid {
            display: flex;
            gap: 20px;
        }
        .dashboard-card {
            background: #333;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            flex: 1;
        }
        .incident-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        #incidentChart {
            max-width: 300px;
            max-height: 300px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #444;
        }

        

        .good  {
            
            color: green;

        }
        .completed {
    
            color: green;

        }


        .fair  {
           
            color: yellow;

        }
        
        .inprogress  {
            color: yellow;

        }
        .pending {
            color: yellow;

        }

        .poor {
            
            color: red;
        }
        .ongoing {
            color: red;
        }
        .high {
            color: red;
        }
        .medium {
            color: yellow;
        }
        .low {
            color: green;
        }
        p {
            color: white;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#inventory"><i class="fas fa-road"></i> Road Inventory</a>
        <a href="#maintenance"><i class="fas fa-tools"></i> Maintenance Tracking</a>
        <a href="#reporting"><i class="fas fa-exclamation-triangle"></i> Incident Reporting</a>
        
    </div>
    
    <div class="container">
        <div id="dashboard" class="section">
            <h2>Dashboard</h2>
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h3>Total Roads Monitored</h3>
                    <p>120</p>
                </div>
                <div class="dashboard-card">
                    <h3>Active Maintenance Projects</h3>
                    <p>5</p>
                </div>
                <div class="dashboard-card">
                    <h3>Recent Incidents</h3>
                    <p>3</p>
                </div>
            </div>
        </div>

        <div id="inventory" class="section">
            <h2>Road Inventory</h2>
            <table>
                <tr>
                    <th>Road Name</th>
                    <th>Length (km)</th>
                    <th>Condition</th>
                </tr>
                <tr><td>Main Street</td><td>5</td><td class="good">Good</td></tr>
                <tr><td>Broadway</td><td>8</td><td class="fair">Fair</td></tr>
                <tr><td>5th Avenue</td><td>12</td><td class="poor">Poor</td></tr>
                <tr><td>Elm Street</td><td>6</td><td class="good">Good</td></tr>
                <tr><td>Parkway</td><td>10</td><td class="fair">Fair</td></tr>
            </table>
        </div>

        <div id="maintenance" class="section">
            <h2>Maintenance Tracking</h2>
            <table>
                <tr>
                    <th>Project</th>
                    <th>Road</th>
                    <th>Status</th>
                </tr>
                <tr><td>Pothole Repairs</td><td>Main Street</td><td class="completed">Completed</td></tr>
                <tr><td>Resurfacing</td><td>Broadway</td><td class="inprogress">In Progress</td></tr>
                <tr><td>Bridge Inspection</td><td>5th Avenue</td><td class="pending">Pending</td></tr>
                <tr><td>Drainage Improvement</td><td>Elm Street</td><td class="ongoing">Ongoing</td></tr>
                <tr><td>Lane Expansion</td><td>Parkway</td><td class="completed">Completed</td></tr>
            </table>
        </div>

        <div id="reporting" class="section">
            <h2>Incident Reporting</h2>
            <div class="incident-container">
                <canvas id="incidentChart"></canvas>
                <table>
                    <tr>
                        <th>Incident</th>
                        <th>Location</th>
                        <th>Severity</th>
                    </tr>
                    <tr><td>Accident</td><td>Main Street</td><td class="high">High</td></tr>
                    <tr><td>Roadblock</td><td>Broadway</td><td class="medium">Medium</td></tr>
                    <tr><td>Pothole</td><td>5th Avenue</td><td class="low">Low</td></tr>
                    <tr><td>Flooding</td><td>Elm Street</td><td class="high">High</td></tr>
                    <tr><td>Traffic Jam</td><td>Parkway</td><td class="medium">Medium</td></tr>
                </table>
            </div>
            <script>
                var ctx = document.getElementById('incidentChart').getContext('2d');
                var incidentChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Accident', 'Roadblock', 'Pothole', 'Flooding', 'Traffic Jam'],
                        datasets: [{
                            data: [3, 5, 2, 4, 6],
                            backgroundColor: ['gray', 'black', 'gray', 'black', 'gray']
                        }]
                    }
                });
            </script>
        </div>
    </div>
</body>
</html>
