<?php
session_start();

// Set session timeout duration (10 minutes)
$timeout_duration = 600;

if (isset($_SESSION['LAST_ACTIVITY']) && 
    (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Last request was more than 10 minutes ago
    session_unset();     // Unset $_SESSION variable for this page
    session_destroy();   // Destroy session data
}

$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time stamp

// Your existing database configuration and CRUD logic here...

// Handle session timeout check
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['action']) && $_GET['action'] === 'check_session') {
    if (!isset($_SESSION['LAST_ACTIVITY'])) {
        echo json_encode(array("status" => "logged_out"));
    } else {
        echo json_encode(array("status" => "active"));
    }
    exit();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pembina";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set headers to allow cross-origin requests (if needed)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Handle POST requests for CRUD operations
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"];

    switch ($action) {
        case "create":
            $name = $_POST["name"];
            $matricno = $_POST["matricno"];
            $email = $_POST["email"];
            $bureau = $_POST["bureau"];
            
            $sql = "INSERT INTO members (name, matricno, email, bureau) VALUES ('$name', '$matricno', '$email', '$bureau')";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(array("message" => "Member added successfully"));
            } else {
                echo json_encode(array("error" => $conn->error));
            }
            break;

        case "update":
            $id = $_POST["id"];
            $name = $_POST["name"];
            $matricno = $_POST["matricno"];
            $email = $_POST["email"];
            $bureau = $_POST["bureau"];
            
            $sql = "UPDATE members SET name='$name', matricno='$matricno', email='$email', bureau='$bureau' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(array("message" => "Member updated successfully"));
            } else {
                echo json_encode(array("error" => $conn->error));
            }
            break;

        case "delete":
            $ids = $_POST["id"];
            $ids = implode(",", array_map('intval', $ids));
            
            $sql = "DELETE FROM members WHERE id IN ($ids)";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(array("message" => "Member(s) deleted successfully"));
            } else {
                echo json_encode(array("error" => $conn->error));
            }
            break;

        default:
            echo json_encode(array("error" => "Invalid action"));
    }
}

// Handle GET request to fetch members data
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM members";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $members = array();
        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
        echo json_encode($members);
    } else {
        echo json_encode(array());
    }
}

$conn->close();
?>
