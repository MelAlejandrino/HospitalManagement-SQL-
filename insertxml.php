<?php

include 'connect.php';

$xmlFilePath = 'datamart.xml';
$xmlContent = file_get_contents($xmlFilePath);
$xml = new SimpleXMLElement($xmlContent);

foreach ($xml->record as $record) {
    $departmentName = $record->department_name;
    $departmentLocation = $record->department_location;
    $facilitiesAvailable = $record->facilities_available;

    $sql = "INSERT INTO DEPARTMENT (department_name, department_location, facilities_available) 
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $departmentName, $departmentLocation, $facilitiesAvailable);

    if ($stmt->execute()) {
        echo "Data inserted successfully for department: $departmentName<br>";
    } else {
        echo "Error inserting data for department: $departmentName<br>";
    }
}

$conn->close();
?>
