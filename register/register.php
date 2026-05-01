<?php
include_once "../database_config.php";

 if(isset($_POST['register'])){
  $fullName=$_POST['full_name'];
  $userName=$_POST['username'];
  $email=$_POST['email'];
  $pass=$_POST['password'];
  $retype_pass=$_POST['re_password'];




 if($pass !==$retype_pass){
  echo "Password does match!";
 }else{
  // hash password for ensure security concern

  $encrypted_password=password_hash($pass,PASSWORD_DEFAULT);
  
  $insert_query="INSERT INTO register_info (full_name, user_name, email,encrypted_password) values('$fullName','$userName','$email','$encrypted_password')";

  if($database->query($insert_query)){
    echo "Congratulations Your Registration Successfull!";

  }else{
    echo"Registration Failed:".$database->error;
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
        <div class="alert alert-<?php echo $messageType; ?>">
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