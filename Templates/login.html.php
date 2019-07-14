<div class="login">
  <div class="login-container">
    <img src="images/logo.png" alt="Fotheby's Logo" style="height:150px; width:auto">
    <div class="form-areas">
      <div class="register-area">
        <h1>Register</h1>

        <form class="login-form" action="/register" method="post">
          <label>Name: </label><input type="text" name="name" value="" required>
          <label>Email: </label><input type="text" name="email" value="" required>
          <label>Phone Number: </label><input type="text" name="phone" value="" required>
          <label>Password: </label><input type="password" name="password" value="" required>
          <input type="submit" name="submit" value="Register">
        </form>
      </div>
      <div class="login-area">
        <h1>Login</h1>
        <form class="login-form" action="" method="post">
          <label>Username: </label><input type="text" name="username" value="">
          <label>Password: </label><input type="password" name="password" value="">
          <input type="submit" name="submit" value="Login">
        </form>
      </div>
    </div>
  </div>
</div>
