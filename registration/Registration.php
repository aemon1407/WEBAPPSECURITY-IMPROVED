<?php

// Database connection
$host = 'localhost'; // Database host
$dbname = 'pembina'; // Database name
$username = 'root'; // Database username
$password = 'de462f49531c57e381374b88a91942f7789a7a65f9f156b4'; // Database password

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(array('error' => 'Connection failed: ' . $e->getMessage()));
    exit;
}

// Handle POST request (store member data)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'store') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate and sanitize input data
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $matricno = htmlspecialchars($data['matricno']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT); // Hash password for security
    $bureau = htmlspecialchars($data['bureau']);

    // Check if email already exists
    $emailCheckSql = "SELECT COUNT(*) FROM members WHERE email = :email";
    $stmt = $db->prepare($emailCheckSql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $emailCount = $stmt->fetchColumn();

    if ($emailCount > 0) {
        echo json_encode(array('error' => 'Email already used'));
        exit;
    }

    // Insert into database
    try {
        $sql = "INSERT INTO members (name, email, matricno, password, bureau) 
                VALUES (:name, :email, :matricno, :password, :bureau)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':matricno', $matricno);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':bureau', $bureau);
        $stmt->execute();

        echo json_encode(array('message' => 'Member data stored successfully'));
    } catch (PDOException $e) {
        echo json_encode(array('error' => 'Failed to store member data: ' . $e->getMessage()));
    }
}

// Handle GET request (fetch members)
else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'search') {
    if (isset($_GET['search'])) {
        $search = htmlspecialchars($_GET['search']);

        try {
            $sql = "SELECT id, name, matricno, bureau FROM members WHERE 
                    name LIKE :search OR matricno LIKE :search OR bureau LIKE :search";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':search', "%$search%");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($results);
        } catch (PDOException $e) {
            echo json_encode(array('error' => 'Failed to fetch members: ' . $e->getMessage()));
        }
    } else {
        echo json_encode(array('error' => 'Search parameter not provided'));
    }
}

// Handle GET request (check email uniqueness)
else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'check_email') {
    if (isset($_GET['email'])) {
        $email = htmlspecialchars($_GET['email']);

        try {
            $sql = "SELECT COUNT(*) FROM members WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $emailCount = $stmt->fetchColumn();

            echo json_encode(array('isUnique' => $emailCount == 0));
        } catch (PDOException $e) {
            echo json_encode(array('error' => 'Failed to check email: ' . $e->getMessage()));
        }
    } else {
        echo json_encode(array('error' => 'Email parameter not provided'));
    }
}

?>
