<?php
include 'dbcreate.php';

if (isset($_POST['city_id'])) {
    $city_id = mysqli_real_escape_string($con, $_POST['city_id']);

    // Query to fetch barangays based on city_id
    $sql = "SELECT * FROM barangays WHERE city_id = '$city_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<option value="">Select Barangay</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['barangay_id'] . '">' . $row['barangay_name'] . '</option>';
        }
    } else {
        echo '<option value="">No Barangays Found</option>';
    }
}

mysqli_close($con);
?>
