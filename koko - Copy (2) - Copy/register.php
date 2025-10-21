<?php
require_once 'config.php';

if (is_customer_logged_in()) {
    redirect('index_user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kokobap - Register</title>
<?php include 'visuals/returnlogin.php'; ?>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Permanent+Marker&display=swap');
    
    * {
      box-sizing: border-box;
    }
    <style>
.login-header {
  padding: 15px;
}

.return-button {
  display: flex;
  justify-content: flex-start;
}

.home-btn {
  right: 1px;
  top: 50px;
  position: absolute;
  align-items: center;
  gap: 10px;
  padding: 10px 16px;
  background: #d44521;  
  color: #fff;
  font-weight: bold;
  text-decoration: none;
  border-radius: 8px;
}

.home-btn img {
  width: 24px;   /* logo as icon */
  height: 24px;
}

.home-btn:hover {
  background: #a83218;
}
    body {
      background-color: #f1e6da;
      background-image: url("WEB_KOKOBAP/pics/SUSHIBG.jpg");
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 20px;
      font-family: 'Montserrat', sans-serif;
    }
    
    .register-container {
      background-color: white;
      padding: 30px;
      border: 2px solid #d44521;
      border-radius: 12px;
      width: 100%;
      max-width: 450px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    h1 {
      font-family: 'Permanent Marker', 'Montserrat', sans-serif;
      color: #da5437;
      font-size: clamp(1.5rem, 5vw, 2rem);
      margin-bottom: 20px;
      font-weight: 900;
      text-transform: uppercase;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      text-align: left;
    }

    label {
      font-size: 12px;
      font-weight: bold;
      margin-bottom: 5px;
      text-transform: uppercase;
    }

    input {
      background-color: #fff;
      border: 1px solid #d44521;
      padding: 12px;
      border-radius: 25px;
      font-size: 14px;
      width: 100%;
      outline: none;
    }
    
    input::placeholder {
      color: gray;
      font-size: 13px;
    }

    .btn-submit {
      margin-top: 15px;
      background-color: #d44521;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 25px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-submit:hover {
      background-color: #a83218;
    }
    
    @media (max-width: 480px) {
      body {
        padding: 15px;
      }
      
      .register-container {
        padding: 20px;
      }
      
      input {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>
 
  <div class="register-container">
    <h1>Create Account</h1>
   
    <form action="register_process.php" method="POST">
      <div>
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="fname" placeholder="John" required minlength="2" maxlength="50">
      </div>
      <div>
        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lname" placeholder="Doe" required minlength="2" maxlength="50">
      </div>
      <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="john@email.com" required>
      </div>
      <div>
        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" placeholder="8765 4321" required pattern="[0-9\s\-\+$$$$]{7,20}">
      </div>
      <div>
        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" required max="<?php echo date('Y-m-d'); ?>">
      </div>
      <div>
        <label for="referral">Referral Code (Optional)</label>
        <input type="text" id="referral" name="referral" placeholder="Enter referral code" maxlength="20">
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Have at least 8 characters" required minlength="8" maxlength="100">
      </div>
      
      <button type="submit" class="btn-submit">Create</button>
    </form>
  </div>

</body>
</html>
