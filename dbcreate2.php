<?php
include 'dbcreate.php';

if (isset($_POST['region_id'])) {
    $region_id = mysqli_real_escape_string($con, $_POST['region_id']);

    // Query to fetch cities based on region_id
    $sql = "SELECT * FROM cities WHERE region_id = '$region_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<option value="">Select City</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['city_id'] . '">' . $row['city_name'] . '</option>';
        }
    } else {
        echo '<option value="">No Cities Found</option>';
    }
}

mysqli_close($con);
?>