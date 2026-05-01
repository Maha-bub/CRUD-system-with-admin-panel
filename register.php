<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register — GalleryHub</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="register.css">
</head>
<body>
<div class="card">
  <div class="brand">CRUD <span>SYSTEM</span></div>
  <p class="subtitle">Create your account</p>



  <form method="POST" >
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
      <div class="field">
        <label>Password</label>
        <input type="password" name="password" placeholder="Create a password" required>
        <div class="hint">Min 8 chars,1 number, 1 symbol</div>
      </div>
      <div class="field">
        <label>Re-type Password</label>
        <input type="password" name="re_password" placeholder="Retype Password" required>
      </div>
    </div>

    <button type="submit" class="btn">Create Account</button>
  </form>

  <div class="switch">
    Already have an account? <a href="login.php">Sign in →</a>
  </div>
</div>
</body>
</html>
