<header class="login-header">
  <div class="return-button">
    <a class="home-btn" href="javascript:history.back()">
      <img src="WEB_KOKOBAP/pics/LOGO.png" alt="Back Logo">
      <span>Return</span>
    </a>
  </div>
</header>

<style>
.login-header {
  padding: 15px;
}

.return-button {
  display: flex;
  justify-content: flex-start;
}

.home-btn {
  display: inline-flex;
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
</style>
