<?php
// Database connection settings
$servername = "localhost";
$dbname = "test_db"; // Replace with database
$dbusername = "root"; // Replace with user
$dbpassword = ""; // Replace with pass

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Login successful! Welcome, " . htmlspecialchars($username) . ".";
} else {
    echo "Invalid username or password.";
}

$stmt->close();
$conn->close();
?>
