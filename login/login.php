
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
