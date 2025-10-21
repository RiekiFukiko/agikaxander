<?php
require_once 'config.php';

if (is_admin_logged_in()) {
    redirect('index_admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kokobap - Admin Login</title>
<?php include 'visuals/returnlogin.php'; ?>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Permanent+Marker&display=swap');
    
    * {
      box-sizing: border-box;
    }
    
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      padding: 20px;
      background: #F8F5EF;
      background-image: url("WEB_KOKOBAP/pics/SUSHIBG.jpg");
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Montserrat', sans-serif;
      color: #333;
      text-align: center;
    }
    
    .login-container {
      background: #fff; 
      padding: 30px 20px;
      border: 2px solid #d44521; 
      border-radius: 10px;       
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .social-links {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      justify-content: center;
    }
    
    .social-links a img {
      width: 40px;   
      height: 40px;
      transition: transform 0.2s ease;
    }

    .social-links a img:hover {
      transform: scale(1.2);
    }
    
    .login-container img.logo {
      width: 100%;
      max-width: 200px;
      height: auto;
      margin-bottom: 10px;
    }
    
    .input-field {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
    }
    
    .login-btn {
      width: 100%;
      max-width: 185px;
      padding: 14px 0;
      background: #d44521; 
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.2s;
    }
    
    .login-btn:hover {
      background: #a83218;
    }
    
    .register-link {
      margin-top: 10px;
      font-size: 13px;
    }
    
    .register-link a {
      color: #d44521;
      text-decoration: none;
    }
    
    .register-link a:hover {
      text-decoration: underline;
    }

    h2 {
      font-family: 'Permanent Marker', 'Montserrat', sans-serif;
      color: #da5437;
      margin: 0;
      font-size: clamp(1.5rem, 4vw, 2rem);
    }
    
    form {
      width: 100%;
    }
    
    @media (max-width: 480px) {
      body {
        padding: 15px;
      }
      
      .login-container {
        padding: 25px 15px;
      }
      
      .social-links a img {
        width: 35px;
        height: 35px;
      }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <img src="WEB_KOKOBAP/pics/LOGO.png" alt="Kokobap Logo" class="logo">
    <h2>ADMIN LOGIN</h2>


    <form action="admin_auth.php" method="POST" style="width:100%; display:flex; flex-direction:column; gap:15px;">
      <input type="text" name="username" placeholder="Username" required class="input-field" autocomplete="username">
      <input type="password" name="password" placeholder="Password" required class="input-field" autocomplete="current-password">
      <button type="submit" class="login-btn">Login</button>
    </form>

    <div class="register-link">
      Not registered yet? <a href="register.php">Register</a>
    </div>

    <div class="social-links">
      <a href="https://www.facebook.com/KokobapBCD" target="_blank" rel="noopener noreferrer">
        <img src="WEB_KOKOBAP/pics/FB.png" alt="Facebook">
      </a>
      <a href="https://www.twitter.com/YourProfile" target="_blank" rel="noopener noreferrer">
        <img src="WEB_KOKOBAP/pics/3.png" alt="Twitter">
      </a>
      <a href="https://www.instagram.com/YourProfile" target="_blank" rel="noopener noreferrer">
        <img src="WEB_KOKOBAP/pics/2.png" alt="Instagram">
      </a>
      <a href="https://www.youtube.com/YourChannel" target="_blank" rel="noopener noreferrer">
        <img src="WEB_KOKOBAP/pics/4.png" alt="YouTube">
      </a>
    </div>
  </div>

</body>
</html>
