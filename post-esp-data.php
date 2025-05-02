<?php
$servername = "localhost";
// REPLACE with your Database name
$dbname = "example_esp_data";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = "Kittisak644245001";
// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";
$api_key = $sensor = $location = $value1 = $value2 = $value3 = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $api_key = "tPmAT5Ab3j7F9"; // Default API Key value
    // $api_key = isset($_GET["api_key"]) ? test_input($_GET["api_key"]) : "";
    if($api_key_value == $api_key) {
        $sensor = isset($_GET["sensor"]) ? test_input($_GET["sensor"]) : "";
        $location = isset($_GET["location"]) ? test_input($_GET["location"]) : "";
        $value1 = isset($_GET["value1"]) ? test_input($_GET["value1"]) : "";
        $value2 = isset($_GET["value2"]) ? test_input($_GET["value2"]) : "";
        $value3 = isset($_GET["value3"]) ? test_input($_GET["value3"]) : "";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO sensordata (sensor, location, value1, value2, value3)
        VALUES ('" . $sensor . "', '" . $location . "', '" . $value1 . "', '" . $value2 . "', '" . $value3 . "')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        }
        else {
            echo "Error: " . $sql . "
" . $conn->error;
        }
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }
}
else {
    echo "No data sent with HTTP GET.";
}
function test_input($data) {
    $data = trim($data ?? "");
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>