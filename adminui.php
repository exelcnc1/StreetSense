<?php
include 'dbcreate.php';
if (isset($_POST['submit'])) {
    header("Location: reportinci.php");
    exit();
}

// Initialize search variables
$search = "";
$searchResults = array(
    'road' => array(),
    'maintenance' => array(),
    'incident' => array()
);
$isSearching = false;

// Process search query
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $isSearching = true;
    
    // Sanitize the search input
    $search = mysqli_real_escape_string($con, $search);
    $searchPattern = "%$search%";
    
    // Search in incident reporting
    $incidentQuery = "SELECT * FROM incident WHERE 
                 Region LIKE ? OR 
                 City LIKE ? OR 
                 Barangay LIKE ? OR 
                 Road LIKE ? OR 
                 Incident LIKE ? OR 
                 Severity LIKE ?";
    
    $stmt = $con->prepare($incidentQuery);
    if ($stmt) {
        $stmt->bind_param("ssssss", $searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern);
        $stmt->execute();
        $incidentResult = $stmt->get_result();
        $searchResults['incident'] = $incidentResult->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }
    
    // Search in maintenance tracking
    $maintenanceQuery = "SELECT * FROM maintenance WHERE 
                        Region LIKE ? OR 
                        City LIKE ? OR 
                        Barangay LIKE ? OR 
                        Project LIKE ? OR 
                        Road LIKE ? OR 
                        Status LIKE ?";
    
    $stmt = $con->prepare($maintenanceQuery);
    if ($stmt) {
        $stmt->bind_param("ssssss", $searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern);
        $stmt->execute();
        $maintenanceResult = $stmt->get_result();
        $searchResults['maintenance'] = $maintenanceResult->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }
    
    // Search in road inventory
    $roadQuery = "SELECT * FROM road WHERE 
                     Region LIKE ? OR 
                     City LIKE ? OR 
                     Barangay LIKE ? OR 
                     Road LIKE ? OR 
                     Km LIKE ? OR
                     Condition LIKE ?";
    
    $stmt = $con->prepare($roadQuery);
    if ($stmt) {
        $stmt->bind_param("ssssss", $searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern);
        $stmt->execute();
        $roadResult = $stmt->get_result();
        $searchResults['road'] = $roadResult->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }
    
    // Also search for the term 'road' itself or 'inventory'
    if (stripos('road', $search) !== false || stripos('inventory', $search) !== false) {
        // Get all roads if the search term contains 'road' or 'inventory'
        $allRoadsQuery = "SELECT * FROM road";
        $allRoadsResult = mysqli_query($con, $allRoadsQuery);
        if ($allRoadsResult) {
            // Merge with existing road results without duplicates
            $existingRoadIds = array_column($searchResults['road'], 'id');
            while ($row = mysqli_fetch_assoc($allRoadsResult)) {
                if (!isset($existingRoadIds) || !in_array($row['id'], $existingRoadIds)) {
                    $searchResults['road'][] = $row;
                    $existingRoadIds[] = $row['id'];
                }
            }
        }
    }
    
    // If searching for a specific road, get all related data
    if (!empty($searchResults['road'])) {
        foreach ($searchResults['road'] as $road) {
            $roadName = $road['Road'];
            
            // Get all maintenance records for this road
            $relatedMaintenanceQuery = "SELECT * FROM maintenance WHERE Road = ?";
            $stmt = $con->prepare($relatedMaintenanceQuery);
            if ($stmt) {
                $stmt->bind_param("s", $roadName);
                $stmt->execute();
                $relatedMaintenanceResult = $stmt->get_result();
                $relatedMaintenance = $relatedMaintenanceResult->fetch_all(MYSQLI_ASSOC);
                
                // Add to search results if not already there
                foreach ($relatedMaintenance as $maintenance) {
                    $found = false;
                    foreach ($searchResults['maintenance'] as $existingMaintenance) {
                        if ($existingMaintenance['id'] == $maintenance['id']) {
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $searchResults['maintenance'][] = $maintenance;
                    }
                }
                $stmt->close();
            }
            
            // Get all incident records for this road
            $relatedIncidentQuery = "SELECT * FROM incident WHERE Road = ?";
            $stmt = $con->prepare($relatedIncidentQuery);
            if ($stmt) {
                $stmt->bind_param("s", $roadName);
                $stmt->execute();
                $relatedIncidentResult = $stmt->get_result();
                $relatedIncidents = $relatedIncidentResult->fetch_all(MYSQLI_ASSOC);
                
                // Add to search results if not already there
                foreach ($relatedIncidents as $incident) {
                    $found = false;
                    foreach ($searchResults['incident'] as $existingIncident) {
                        if ($existingIncident['id'] == $incident['id']) {
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $searchResults['incident'][] = $incident;
                    }
                }
                $stmt->close();
            }
        }
    }
    
    // If searching for a specific region, show all tables for that region
    if (preg_match('/region\s*(\d+|[ivxlcdm]+)/i', $search, $matches) || 
        preg_match('/^(\d+|[ivxlcdm]+)$/i', $search, $matches)) {
        
        $regionPattern = "%{$matches[0]}%";
        
        // Get all roads in this region
        $regionRoadQuery = "SELECT * FROM road WHERE Region LIKE ?";
        $stmt = $con->prepare($regionRoadQuery);
        if ($stmt) {
            $stmt->bind_param("s", $regionPattern);
            $stmt->execute();
            $regionRoadResult = $stmt->get_result();
            $regionRoads = $regionRoadResult->fetch_all(MYSQLI_ASSOC);
            
            // Add to search results if not already there
            foreach ($regionRoads as $road) {
                $found = false;
                foreach ($searchResults['road'] as $existingRoad) {
                    if (isset($existingRoad['id']) && isset($road['id']) && $existingRoad['id'] == $road['id']) {
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $searchResults['road'][] = $road;
                }
            }
            $stmt->close();
        }
        
        // Get all maintenance projects in this region
        $regionMaintenanceQuery = "SELECT * FROM maintenance WHERE Region LIKE ?";
        $stmt = $con->prepare($regionMaintenanceQuery);
        if ($stmt) {
            $stmt->bind_param("s", $regionPattern);
            $stmt->execute();
            $regionMaintenanceResult = $stmt->get_result();
            $regionMaintenance = $regionMaintenanceResult->fetch_all(MYSQLI_ASSOC);
            
            // Add to search results if not already there
            foreach ($regionMaintenance as $maintenance) {
                $found = false;
                foreach ($searchResults['maintenance'] as $existingMaintenance) {
                    if (isset($existingMaintenance['id']) && isset($maintenance['id']) && $existingMaintenance['id'] == $maintenance['id']) {
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $searchResults['maintenance'][] = $maintenance;
                }
            }
            $stmt->close();
        }
        
        // Get all incidents in this region
        $regionIncidentQuery = "SELECT * FROM incident WHERE Region LIKE ?";
        $stmt = $con->prepare($regionIncidentQuery);
        if ($stmt) {
            $stmt->bind_param("s", $regionPattern);
            $stmt->execute();
            $regionIncidentResult = $stmt->get_result();
            $regionIncidents = $regionIncidentResult->fetch_all(MYSQLI_ASSOC);
            
            // Add to search results if not already there
            foreach ($regionIncidents as $incident) {
                $found = false;
                foreach ($searchResults['incident'] as $existingIncident) {
                    if (isset($existingIncident['id']) && isset($incident['id']) && $existingIncident['id'] == $incident['id']) {
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $searchResults['incident'][] = $incident;
                }
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Road Management System</title>
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
            width: 240px;
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
            font-size: 18px;
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
        .button {
  background-color: yellow; 
  border: none;
  color: black;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 13px;
  margin: 10px 10px;
  cursor: pointer;
  border-radius: 8px
  
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
            color: #00FF00;

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
        p {
            color: white;
            font-weight: bold;
        }
        .low {
            color: green;

        }
        .bad {
            color: red;

        }
        .high {
            
            color: red;
        }
        .medium {
            
            color: yellow;

        }
        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }
        .search-container input[type=text] {
            padding: 10px;
            width: 60%;
            border: none;
            border-radius: 5px 0 0 5px;
            font-size: 16px;
        }
        .search-container button {
            padding: 10px 15px;
            background: yellow;
            color: black;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 16px;
        }
        .search-container button:hover {
            background-color: rgb(245, 192, 20);
        }
        .search-results {
            background: #333;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(255, 255, 255, 0.1);
        }
        .search-results h3 {
            color: #FFD700;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#inventory"><i class="fas fa-road"></i> Road Inventory</a>
        <a href="#maintenance"><i class="fas fa-tools"></i> Maintenance Tracking</a>
        <a href="#reporting"><i class="fas fa-exclamation-triangle"></i> Incident Reporting</a>
        <a href="index.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    
    <div class="container">
        <div class="search-container">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Search regions, roads, incidents, or maintenance projects..." value="<?php echo $search; ?>">
                <button type="submit"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
        
        <?php if ($isSearching): ?>
        <div class="search-results section">
            <h2>Search Results for "<?php echo htmlspecialchars($search); ?>"</h2>
            
            <?php if (empty($searchResults['road']) && empty($searchResults['maintenance']) && empty($searchResults['incident'])): ?>
                <p>No results found for your search.</p>
            <?php else: ?>
                
                <?php if (!empty($searchResults['road'])): ?>
                    <h3>Road Inventory Results</h3>
                    <table>
                        <tr>
                            <th>Region</th>
                            <th>City</th>
                            <th>Barangay</th>
                            <th>Road Name</th>
                            <th>Length (km)</th>
                            <th>Condition</th>
                        </tr>
                        <?php foreach ($searchResults['road'] as $road): ?>
                            <tr>
                                <td><?php echo $road['Region']; ?></td>
                                <td><?php echo $road['City']; ?></td>
                                <td><?php echo $road['Barangay']; ?></td>
                                <td><?php echo $road['Road']; ?></td>
                                <td><?php echo $road['Km']; ?></td>
                                <td class="<?php echo strtolower($road['Condition']); ?>"><?php echo $road['Condition']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
                
                <?php if (!empty($searchResults['maintenance'])): ?>
                    <h3>Maintenance Tracking Results</h3>
                    <table>
                        <tr>
                            <th>Region</th>
                            <th>City</th>
                            <th>Barangay</th>
                            <th>Project</th>
                            <th>Road</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach ($searchResults['maintenance'] as $maintenance): ?>
                            <tr>
                                <td><?php echo $maintenance['Region']; ?></td>
                                <td><?php echo $maintenance['City']; ?></td>
                                <td><?php echo $maintenance['Barangay']; ?></td>
                                <td><?php echo $maintenance['Project']; ?></td>
                                <td><?php echo $maintenance['Road']; ?></td>
                                <td class="<?php echo strtolower($maintenance['Status']); ?>"><?php echo $maintenance['Status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
                
                <?php if (!empty($searchResults['incident'])): ?>
                    <h3>Incident Reporting Results</h3>
                    <table>
                        <tr>
                            <th>Incident</th>
                            <th>Region</th>
                            <th>City</th>
                            <th>Barangay</th>
                            <th>Road</th>
                            <th>Severity</th>
                        </tr>
                        <?php foreach ($searchResults['incident'] as $incident): ?>
                            <tr>
                                <td><?php echo $incident['Incident']; ?></td>
                                <td><?php echo $incident['Region']; ?></td>
                                <td><?php echo $incident['City']; ?></td>
                                <td><?php echo $incident['Barangay']; ?></td>
                                <td><?php echo $incident['Road']; ?></td>
                                <td class="<?php echo strtolower($incident['Severity']); ?>"><?php echo $incident['Severity']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
                
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <div id="dashboard" class="section">
            <h2>Dashboard</h2>
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h3>Total Roads Monitored</h3>
                    <p>
                        <?php
                        $roadCountQuery = "SELECT COUNT(*) as total FROM road";
                        $roadCountResult = mysqli_query($con, $roadCountQuery);
                        $roadCount = mysqli_fetch_assoc($roadCountResult);
                        echo $roadCount['total'];
                        ?>
                    </p>
                </div>
                <div class="dashboard-card">
                    <h3>Active Maintenance Projects</h3>
                    <p>
                        <?php
                        $maintenanceCountQuery = "SELECT COUNT(*) as total FROM maintenance WHERE Status = 'Ongoing'";
                        $maintenanceCountResult = mysqli_query($con, $maintenanceCountQuery);
                        $maintenanceCount = mysqli_fetch_assoc($maintenanceCountResult);
                        echo $maintenanceCount['total'];
                        ?>
                    </p>
                </div>
                <div class="dashboard-card">
                    <h3>Recent Incidents</h3>
                    <p>
                        <?php
                        $incidentCountQuery = "SELECT COUNT(*) as total FROM incident";
                        $incidentCountResult = mysqli_query($con, $incidentCountQuery);
                        $incidentCount = mysqli_fetch_assoc($incidentCountResult);
                        echo $incidentCount['total'];
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div id="inventory" class="section">
            <h2>Road Inventory
                <form action="reportinci.php" method="POST" style="display: inline;">
                    <button class="button" type="submit" name="submit">Add Road</button>
                </form>
            </h2>
            
            <table>
                <tr>
                    
                    <th>Region</th>
                    <th>City</th>
                    <th>Barangay</th>
                    <th>Road Name</th>
                    <th>Length (km)</th>
                    <th>Condition</th>
                </tr>
                <?php

$sql = "SELECT * FROM `road`";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        
        $Region = $row['Region'];
        $City = $row['City'];
        $Barangay = $row['Barangay'];
        $Road = $row['Road'];
        $Km = $row['Km'];
        $Condition = $row['Condition'];
        $conditionClass = strtolower($Condition);
        echo '<tr>
        <td>'.$Region.'</td>
        <td>'.$City.'</td>
        <td>'.$Barangay.'</td>
        <td>'.$Road.'</td>
        <td>'.$Km.'</td>
        <td class="'.$conditionClass.'">'.$Condition.'</td>
        </tr>';
    }
} else {
    echo "<tr><td colspan='6'>No data found.</td></tr>";
}

?>
                <!--<tr><td>7</td><td>Mandaue</td><td>Subangdako</td><td>M.L Quezon St.</td><td>5</td><td class="good">Good</td></tr>
                <tr><td>7</td><td>Mandaue</td><td>Tipolo</td><td>Lopez Jaena St.</td><td>8</td><td class="fair">Fair</td></tr>
                <tr><td>1</td><td>La Union</td><td>San Fernando</td><td>Marilag St.</td><td>12</td><td class="poor">Poor</td></tr>
                <tr><td>2</td><td>Mandaue</td><td>Tipolo</td><td>Elm Street</td><td>6</td><td class="good">Good</td></tr>
                <tr><td>4</td><td>Mandaue</td><td>Tipolo</td><td>Parkway</td><td>10</td><td class="fair">Fair</td></tr>-->
            </table>
        </div>

        <div id="maintenance" class="section">
            <h2>Maintenance Tracking
                <form action="reportinci.php" method="POST" style="display: inline;">
                    <button class="button" type="submit" name="submit">Add Road</button>
                </form>
            </h2>
            
            <table>
                <tr>
                 <th>Region</th>
                    <th>City</th>
                    <th>Barangay</th>
                    <th>Project</th>
                    <th>Road</th>
                    <th>Status</th>
                </tr>
                <?php

$sql = "SELECT * FROM `maintenance`";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        
        $Region=$row['Region'];
        $City=$row['City'];
        $Barangay=$row['Barangay'];
        $Project=$row['Project'];
        $Road=$row['Road'];
        $Status=$row['Status'];
        $statusClass = strtolower($Status);
        $statusDisplay = $Status;
        
        // Check if status is "inprogress" or similar and display percentage
        if (strtolower($Status) == 'inprogress' || strtolower($Status) == 'in progress' || strtolower($Status) == 'ongoing') {
            // Get the percentage from the database if it exists
            if (isset($row['Percentage'])) {
                $percentage = $row['Percentage'];
                $statusDisplay = $Status . ' (' . $percentage . '%)';
                
                // Add progress bar visualization
                $statusDisplay .= '<div class="progress-bar-container">
                                    <div class="progress-bar" style="width: '.$percentage.'%"></div>
                                   </div>';
            } else {
                // If percentage is not in the database, you need to add it
                $statusDisplay .= '<br><small>(Add percentage in maintenance table)</small>';
            }
        }
        
        echo '<tr>
        
        <td>'.$Region.'</td>
        <td>'.$City.'</td>
        <td>'.$Barangay.'</td>
        <td>'.$Project.'</td>
        <td>'.$Road.'</td>
        <td class="'.$statusClass.'">'.$statusDisplay.'</td></tr>';
    }
} else {
    echo "<tr><td colspan='6'>No data found.</td></tr>";
}

?>
                <!--<tr><td>7</td><td>Mandaue</td><td>Subangdako</td><td>Pothole Repairs</td><td>M.L Quezon St.</td><td class="completed">Completed</td></tr>
                <tr><td>7</td><td>Mandaue</td><td>Tipolo</td><td>Resurfacing</td><td>Lopez Jaena St.</td><td class="inprogress">In Progress</td></tr>
                <tr><td>1</td><td>La Union</td><td>San Fernando</td><td>Bridge Inspection</td><td>Marilag St.</td><td class="pending">Pending</td></tr>
                <tr><td>2</td><td>Mandaue</td><td>Tipolo</td><td>Drainage Improvement</td><td>Elm Street</td><td class="ongoing">Ongoing</td></tr>
                <tr><td>4</td><td>Mandaue</td><td>Tipolo</td><td>Lane Expansion</td><td>Parkway</td><td class="completed">Completed</td></tr>--->
            </table>
        </div>

        <div id="reporting" class="section">
        <div class="search-container">
        <h2>Incident Reporting
            <form action="reportinci.php" method="POST" style="display: inline;">
                    <button class="button" type="submit" name="submit">Add Road</button>
                </form>
                        
            </h2>
            </div>

            <div class="incident-container">
                <canvas id="incidentChart"></canvas>
                <table>
                    <tr>
                        <th>Incident</th>
                        <th>Region</th>
                        <th>City</th>
                        <th>Barangay</th>
                        <th>Road</th>
                        <th>Severity</th>

                    </tr>
                    <?php

                    $sql = "SELECT * FROM `incident`";
                    $result = mysqli_query($con, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $Incident=$row['Incident'];
                            $Region=$row['Region'];
                            $City=$row['City'];
                            $Barangay=$row['Barangay'];
                            $Road=$row['Road'];
                            $Severity=$row['Severity'];
                            $severityClass = strtolower($Severity);
                            echo '<tr>
                            <td>'.$Incident.'</td>
                            <td>'.$Region.'</td>
                            <td>'.$City.'</td>
                            <td>'.$Barangay.'</td>
                            <td>'.$Road.'</td>
                            <td class="'.$severityClass.'">'.$Severity.'</td></tr>';
                        }
                    } else {
                        echo "No data found.";
                    }

                    ?>
                    <!--<tr><td>Accident</td><td>7</td><td>Mandaue</td><td>Subangdako</td><td>M.L Quezon St.</td><td class="high">High</td></tr>
                    <tr><td>Roadblock</td><td>7</td><td>Mandaue</td><td>Tipolo</td><td>Lopez Jaena St.</td><td class="medium">Medium</td></tr>
                    <tr><td>Pothole</td><td>1</td><td>La Union</td><td>San Fernando</td><td>Marilag St.</td><td class="low">Low</td></tr>
                    <tr><td>Flooding</td><td>2</td><td>Mandaue</td><td>Tipolo</td><td>Elm Street</td><td class="high">High</td></tr>
                    <tr><td>Traffic Jam</td><td>4</td><td>Mandaue</td><td>Tipolo</td><td>Parkway</td><td class="medium">Medium</td></tr>-->
                </table>
            </div>
            <script>
                var ctx = document.getElementById('incidentChart').getContext('2d');
                var incidentChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Accident', 'Fallen Trees', 'Baug Ulo'],
                        datasets: [{
                            data: [3, 5, 2],
                            backgroundColor: ['gray', 'black', 'gray', 'black', 'gray']
                        }]
                    }
                });
            </script>
        </div>
    </div>
</body>
</html>