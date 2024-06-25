<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Set session timeout duration (10 minutes)
$timeout_duration = 600;

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /admin/login.php");
    exit();
}

if (isset($_SESSION['LAST_ACTIVITY']) && 
    (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    
    header("Location: /admin/logout.php?session_expired=1");

    exit();

}

function csrf_check($token) {
    if (!$token || $token !== $_SESSION['csrf-token']) {
        // return 405 http status code
        
        http_response_code(405);

        echo json_encode(array("status" => "error", "message" => "Invalid CSRF token"));

        exit;
    }
}

function check_email_and_matric($conn, $email, $matricno) {
    $emailCheckSql = "SELECT COUNT(*) FROM members WHERE email = ?";
    $stmt = $conn->prepare($emailCheckSql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $emailCount = $result->fetch_row()[0];
    
    if ($emailCount > 0) {
        echo json_encode(array("status" => "error", 'message' => 'Email already used'));
        exit;
    }
    
    $matCheckSql = "SELECT COUNT(*) FROM members WHERE matricno = ?";
    $stmt = $conn->prepare($matCheckSql);
    $stmt->bind_param('s', $matricno);
    $stmt->execute();
    $result = $stmt->get_result();
    $matCount = $result->fetch_row()[0];
    
    if ($matCount > 0) {
        echo json_encode(array("status" => "error", 'message' => 'Matric number already registered'));
        exit;
    }
}

$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time stamp

// Database configuration
$servername = "localhost";
$username = "root";
$password = "de462f49531c57e381374b88a91942f7789a7a65f9f156b4";
$dbname = "pembina";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle session timeout check
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['action']) && $_GET['action'] === 'check_session') {
    if (!isset($_SESSION['LAST_ACTIVITY'])) {
        echo json_encode(array("status" => "logged_out"));
    } else {
        echo json_encode(array("status" => "active"));
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['action']) && $_GET['action'] === 'get_members') {
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    $sql = "SELECT * FROM members";
    $result = $conn->query($sql);
    $members = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
        echo json_encode($members);
    } else {
        echo json_encode(array("error" => "No members found"));
    }

    exit();
}

// Handle POST requests for CRUD operations
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Set headers to allow cross-origin requests (if needed)
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    
    $token = filter_input(INPUT_POST, 'csrf', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $action = $_POST["action"];

    switch ($action) {
        case "create":

            csrf_check($token);

            $name = htmlspecialchars($_POST["name"]);
            $matricno = htmlspecialchars($_POST["matricno"]);
            $email = htmlspecialchars($_POST["email"]);
            $bureau = htmlspecialchars($_POST["bureau"]);

            check_email_and_matric($conn, $email, $matricno);

            // Prepare the SQL statement
            $sql = "INSERT INTO members (name, matricno, email, bureau) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Bind the parameters
            $stmt->bind_param("ssss", $name, $matricno, $email, $bureau);

            // Execute the statement
            if ($stmt->execute()) {
                echo json_encode(array("status" => "success", "message" => "Member added successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
            }

            // Close the statement
            $stmt->close();

            break;

        case "update":

            csrf_check($token);

            $id = htmlspecialchars($_POST["id"]);
            $name = htmlspecialchars($_POST["name"]);
            $matricno = htmlspecialchars($_POST["matricno"]);
            $email = htmlspecialchars($_POST["email"]);
            $bureau = htmlspecialchars($_POST["bureau"]);

            check_email_and_matric($conn, $email, $matricno);
            
            $sql = "UPDATE members SET name=?, matricno=?, email=?, bureau=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $name, $matricno, $email, $bureau, $id);
            
            if ($stmt->execute()) {
                echo json_encode(array("status" => "success", "message" => "Member updated successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
            }

            $stmt->close();
            break;

        case "delete":
            $ids = $_POST["id"];
            
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $sql = "DELETE FROM members WHERE id IN ($placeholders)";
            $stmt = $conn->prepare($sql);
            $types = str_repeat('i', count($ids));
            $stmt->bind_param($types, ...$ids);

            if ($stmt->execute()) {
                echo json_encode(array("status" => "success", "message" => $stmt->affected_rows . " member(s) deleted successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
            }

            $stmt->close();
            break;

        default:
            echo json_encode(array("error" => "Invalid action"));
            break;
    }

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/images/logo pembina.png" type="image/x-icon">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="adminview.js" defer></script>
    <link rel="stylesheet" href="adminview.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="/images/logo pembina.png" alt="Logo">
        </div>
        <h1>PEMBINA IIUM</h1>
        <div class="navigation">
            <nav>
                <ul>
                    <li><a href="/home/home.html">Home</a></li>
                    <li><a href="/about/About.html">About</a></li>
                    <li><a href="/passion/ourpassion.html">Objectives</a></li>
                    <li><a href="/activity/activity.html">Activities</a></li>
                    <li><a href="/achievement/achievement.html">Achievements</a></li>
                    <li><a href="/organization/Organization.html">Organization</a></li>
                    <li><a href="/registration/Registration.html">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="greeting">
            <span>Welcome, <?php echo $_SESSION['username']; ?>!</span>
            <a class="logout" href="/admin/logout.php" style="text-transform: none; font-size: 16px;">
                Log Out
            </a>
        </div>    
        <div class="container">
        <h2>PEMBINA Committee</h2>
            <!-- An alert banner to update user what is happening -->
            <!-- <div class="banner warning" role="alert">
            <p class="banner-title">Be Warned</p>
            <p>Something not ideal might be happening.</p>
            </div> -->

            <div class="banner success" style="display:none" role="alert">
                <p class="banner-title">Success</p>
                <p id="banner-description">Your action has been completed successfully.</p>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Matric No</th>
                        <th>Email</th>
                        <th>Bureau</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM members";
                    $result = $conn->query($sql);

                    $i = 0;

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {

                            $i++;

                            echo "<tr>";
                            echo "<td><input id='" . $row["id"] . "' class='select-member' type='checkbox' value='" . $row["id"] . "'></td>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["matricno"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . ucfirst($row["bureau"]) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No members found</td></tr>";
                    }
                    ?>             
                </tbody>
            </table>
            <div class="buttons">
                <button class="add-btn">Add</button>
                <button class="edit-btn">Edit</button>
                <button class="delete-btn">Delete</button>
            </div>
        </div>
    </main>
    <footer>
        Follow us on socials:
        <div class="social-icons">
            <a href="https://www.facebook.com/pembina.uiam" class="fa fa-facebook"></a>
            <a href="https://x.com/PEMBINAUIAM?t=StRzLEQRBE4ARnwWPImkGw&s=35" class="fa fa-twitter"></a>
            <a href="https://www.instagram.com/pembina.uiam?igsh=MTI5d2p0emE3ejYwMw==" class="fa fa-instagram"></a>
            <a href="https://www.tiktok.com/@pembina.uiam?_t=8jRTpey8fAu&_r=1" class="fa fa-tumblr"></a>
        </div>
    </footer>

    <!-- Add Member Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Member</h2>
            <form id="addForm">
                <div>
                    <label for="addName">Name:</label>
                    <input class="input" type="text" id="addName" name="name" required><br><br>
                </div>
                <div>
                    <label for="addMatricNo">Matric No:</label>
                    <input class="input" type="text" id="addMatricNo" name="matricno" required><br><br>
                </div>
                <div>
                    <label for="addEmail">Email:</label>
                    <input class="input" type="email" id="addEmail" name="email" required><br><br>
                </div>
                <div>
                    <label for="addBureau">Bureau:</label>
                    <select class="input" name="bureau" id="addBureau" required>
                        <option value="" disabled>[Choose your bureau]</option>
                        <option value="intellectual">Intellectual</option>
                        <option value="islamization">Islamization</option>
                        <option value="activisme">Activism</option>
                        <option value="multimedia">Multimedia</option>
                    </select>
                </div>
                <input type="hidden" id="csrf" name="csrf" value="<?php echo $_SESSION['csrf-token'] ?? '' ?>">
                <button type="submit">Add</button>
            </form>
        </div>
    </div>

    <!-- Edit Member Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Member</h2>
            <form id="editForm">
                <input class="input" type="hidden" id="editId" name="id">
                <div>
                    <label for="editName">Name:</label>
                    <input class="input" type="text" id="editName" name="name" required><br><br>
                </div>
                <div>
                    <label for="editMatricNo">Matric No:</label>
                    <input class="input" type="text" id="editMatricNo" name="matricno" required><br><br>
                </div>
                <div>
                    <label for="editEmail">Email:</label>
                    <input class="input" type="email" id="editEmail" name="email" required><br><br>
                </div>
                <div>
                    <label for="editBureau">Bureau:</label>
                    <select class="input" name="bureau" id="editBureau" required>
                        <option value="" disabled>[Choose your bureau]</option>
                        <option value="intellectual">Intellectual</option>
                        <option value="islamization">Islamization</option>
                        <option value="activisme">Activism</option>
                        <option value="multimedia">Multimedia</option>
                    </select>
                </div>
                <input type="hidden" id="csrf" name="csrf" value="<?php echo $_SESSION['csrf-token'] ?? '' ?>">
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php 
$conn->close();
?>
