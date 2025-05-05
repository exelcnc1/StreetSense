<?php
// Database connection
$host = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$database = "rms123";

$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch regions
function fetchRegions($con) {
    $regions = [];
    $query = "SELECT regCode, regDesc FROM refregion ORDER BY regDesc ASC";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $regions[] = $row;
    }
    return $regions;
}

// Handle AJAX requests for provinces
if (isset($_POST['region_id'])) {
    $region_id = intval($_POST['region_id']);
    $query = "SELECT provCode, provDesc FROM refprovince WHERE regCode = $region_id ORDER BY provDesc ASC";
    $result = mysqli_query($con, $query);

    echo '<option value="">Select Province</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['provCode'] . '">' . $row['provDesc'] . '</option>';
    }
    exit;
}

// Handle AJAX requests for cities
if (isset($_POST['province_id'])) {
    $province_id = intval($_POST['province_id']);
    $query = "SELECT citymunCode, citymunDesc FROM refcitymun WHERE provCode = $province_id ORDER BY citymunDesc ASC";
    $result = mysqli_query($con, $query);

    echo '<option value="">Select City</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['citymunCode'] . '">' . $row['citymunDesc'] . '</option>';
    }
    exit;
}

// Handle AJAX requests for barangays
if (isset($_POST['city_id'])) {
    $city_id = intval($_POST['city_id']);
    $query = "SELECT brgyCode, brgyDesc FROM refbrgy WHERE citymunCode = $city_id ORDER BY brgyDesc ASC";
    $result = mysqli_query($con, $query);

    echo '<option value="">Select Barangay</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['brgyCode'] . '">' . $row['brgyDesc'] . '</option>';
    }
    exit;
}

$regions = fetchRegions($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report Form</title>
    <link rel="icon" type="image/x-icon" href="ss2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            min-height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            width: 500px;
            color: black;
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        select, input, textarea {
            width: 100%;
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
</head>
<body>
    <div class="container">
        <h2>Incident Report Form</h2>
        <form method="POST" action="submit_incident.php"></form>
            
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="region">Region:</label>
        <select id="region" name="region" required>
            <option value="">Select Region</option>
            <?php foreach ($regions as $region): ?>
            <option value="<?= $region['regCode'] ?>"><?= $region['regDesc'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="province">Province:</label>
        <select id="province" name="province" required>
            <option value="">Select Province</option>
        </select>

        <label for="city">City:</label>
        <select id="city" name="city" required>
            <option value="">Select City</option>
        </select>

        <label for="barangay">Barangay:</label>
        <select id="barangay" name="barangay" required>
            <option value="">Select Barangay</option>
        </select>

        <label for="road">Road:</label>
        <input type="text" id="road" name="road" required>

        <label for="incident">Incident Type:</label>
        <select id="incident" name="incident" required>
            <option value="">Select Incident Type</option>
            <option value="Accident">Accident</option>
            <option value="Crime">Crime</option>
            <option value="Natural Disaster">Natural Disaster</option>
        </select>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <button type="submit">Submit</button>
        </form>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#region').change(function() {
                var region_id = $(this).val();
                if (region_id != '') {
                    $.ajax({
                        url: "reportinci.php",
                        method: "POST",
                        data: {region_id: region_id},
                        success: function(data) {
                            $('#province').html(data);
                            $('#city').html('<option value="">Select City</option>'); // Clear city
                            $('#barangay').html('<option value="">Select Barangay</option>'); // Clear barangay
                        }
                    });
                } else {
                    $('#province').html('<option value="">Select Province</option>');
                    $('#city').html('<option value="">Select City</option>');
                    $('#barangay').html('<option value="">Select Barangay</option>');
                }
            });

            $('#province').change(function() {
                var province_id = $(this).val();
                if (province_id != '') {
                    $.ajax({
                        url: "reportinci.php",
                        method: "POST",
                        data: {province_id: province_id},
                        success: function(data) {
                            $('#city').html(data);
                            $('#barangay').html('<option value="">Select Barangay</option>'); // Clear barangay
                        }
                    });
                } else {
                    $('#city').html('<option value="">Select City</option>');
                    $('#barangay').html('<option value="">Select Barangay</option>');
                }
            });

            $('#city').change(function() {
                var city_id = $(this).val();
                if (city_id != '') {
                    $.ajax({
                        url: "reportinci.php",
                        method: "POST",
                        data: {city_id: city_id},
                        success: function(data) {
                            $('#barangay').html(data);
                        }
                    });
                } else {
                    $('#barangay').html('<option value="">Select Barangay</option>');
                }
            });
        });
    </script>
</body>
</html>
