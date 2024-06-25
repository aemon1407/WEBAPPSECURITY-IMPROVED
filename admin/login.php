<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php");
    exit;
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($inputPassword, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $inputUsername;
            $_SESSION['csrf-token'] = md5(uniqid(mt_rand(), true));
            header("Location: /admin/dashboard.php");
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="adminlog.css">
    <link rel="icon" href="/images/logo pembina.png" type="image/x-icon">
    <title>Login</title>
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
    <form id="loginForm" class="login" method="POST">
        <h2>Welcome, Admin!</h2>
        <p>Please log in</p>
        <input type="text" id="username" name="username" placeholder="User Name" required />
        <input type="password" id="password" name="password" placeholder="Password" required />
        <input type="submit" value="Log In" />
        <div class="links">
            <a href="#">Forgot password</a>
        </div>
    </form>    
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

<script>
    function redirectToAdminView() {
   
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username === "admin" && password === "password") {

            window.location.href = "/path/to/adminview.html";
            return false;
        } else {

            alert("Invalid username or password");
            return false; 
        }
    }
</script>

</body>
</html>
