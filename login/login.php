<?php
session_start();
include_once "../database_config.php";

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        $message = "All fields required!";
        $messageType = "error";
    } else {

        // Secure query
        $stmt = $database->prepare("SELECT * FROM register_info WHERE user_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();

            // 🔴 IMPORTANT FIX (no hashing here)
            if (password_verify($password, $user['encrypted_password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['user_name'];

                header("Location: ../admin_dashboard/index.php");
                exit();

            } else {
                $message = "Wrong password!";
                $messageType = "error";
            }

        } else {
            $message = "User not found!";
            $messageType = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Loging for access your account</title>
<link rel="stylesheet" href="login.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

</head>
<body>
<div class="wrapper">
  <div class="panel-left">
    <div class="brand">Login<span> Your system</span></div>
    <p>Your personal Crud system.
      Please sign in to access your account and manage your data efficiently.
    </p>
    <div class="dots">
      <div class="dot active"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>
  </div>

  <div class="panel-right">
    <h2>Welcome back</h2>
    <p class="sub">Sign in to your account</p>

       <form method="POST">
      <div class="field">
        <label>Username</label>
        <input type="text" name="username" placeholder="Your username" required autofocus>
      </div>
      <div class="field">
        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn">Sign In →</button>
    </form>

    <div class="switch">
      Don't have an account? <a href="register.php">Register here →</a>
    </div>
  </div>
</div>
</body>
</html>
