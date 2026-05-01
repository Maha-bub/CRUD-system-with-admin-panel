<?php
include_once "../database_config.php";

$message = "";
$messageType = "";

if(isset($_POST['register'])){

    $fullName = trim($_POST['full_name']);
    $userName = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $pass     = $_POST['password'];
    $repass   = $_POST['re_password'];

    // Empty check
    if(empty($fullName) || empty($userName) || empty($email) || empty($pass)){
        $message = "All fields are required!";
        $messageType = "error";
    }

    // Email validation
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message = "Invalid email format!";
        $messageType = "error";
    }

    // Password match
    elseif($pass !== $repass){
        $message = "Passwords do not match!";
        $messageType = "error";
    }

    // Password strength
    elseif(strlen($pass) < 8 || !preg_match("/[0-9]/", $pass) || !preg_match("/[A-Za-z]/", $pass)){
        $message = "Password must be 8+ chars with letters & numbers!";
        $messageType = "error";
    }

    else {

        // Email duplicate check
        $check = $database->prepare("SELECT id FROM register_info WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if($result->num_rows > 0){
            $message = "Email already exists!";
            $messageType = "error";
        } else {

            $encrypted_password = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $database->prepare("
                INSERT INTO register_info (full_name, user_name, email, encrypted_password)
                VALUES (?, ?, ?, ?)
            ");

            $stmt->bind_param("ssss", $fullName, $userName, $email, $encrypted_password);

            if($stmt->execute()){
                $message = "🎉 Registration Successful!";
                $messageType = "success";
            } else {
                $message = "Registration Failed!";
                $messageType = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register — GalleryHub</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap" <link rel="stylesheet" href="register.css">
<link rel="stylesheet" href="register.css">

</head>
<body>


<div class="card">


    <?php if(!empty($message)): ?>
        <div class="alert <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>


    <div class="brand">CRUD <span>SYSTEM</span></div>
    <p class="subtitle">Create your account</p>

    <form method="POST">
    <div class="field-row">
      <div class="field">
        <label>Full Name</label>
        <input type="text" name="full_name" placeholder="Full Name" required>
      </div>
      <div class="field">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter your Username"  required>
      </div>
    </div>

    <div class="field">
      <label>Email Address</label>
      <input type="text" name="email" placeholder="Enter your email"  required>
    </div>

<div class="field-row">

  <!-- PASSWORD -->
  <div class="field" style="position:relative;">
    <label>Password</label>

    <input type="password" id="password" name="password" placeholder="Create a password" required>

    <span onclick="togglePassword('password')"
      style="position:absolute; right:10px; top: 35%; cursor:pointer;">
      👁️
    </span>

    <div class="hint">Min 8 chars, 1 number, 1 symbol</div>
  </div>

  <!-- RE PASSWORD -->
  <div class="field" style="position:relative;">
    <label>Re-type Password</label>

    <input type="password" id="re_password" name="re_password" placeholder="Retype Password" required>

    <span onclick="togglePassword('re_password')"
      style="position:absolute; right:10px; top:35%; cursor:pointer;">
      👁️
    </span>
  </div>

</div>
    <button type="submit" class="btn" name="register">Create Account</button>
  </form>

  <div class="switch">
    Already have an account? <a href="../login/login.php">Sign in →</a>
  </div>
</div>
</body>
</html>


<script>
function togglePassword(id) {
  const input = document.getElementById(id);

  if (input.type === "password") {
    input.type = "text";
  } else {
    input.type = "password";
  }
}
</script>