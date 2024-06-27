<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SignIn&SignUp</title>
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <script
    src="https://kit.fontawesome.com/64d58efce2.js"
    crossorigin="anonymous"
  ></script>
</head>
<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="../controller/loginController.php" class="sign-in-form" method="POST">
          <h2 class="title">Sign In</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" name="username"/>
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password"/>
          </div>
          <input type="submit" value="Login" class="btn solid" />
        </form>

        <form action="../controller/signupController.php" class="sign-up-form" method="POST">
          <h2 class="title">Sign Up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" name="username"/>
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="email"/>
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password"/>
          </div>
          <input type="submit" value="Sign Up" class="btn solid" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here?</h3>
          <p>Silahkan buat akunmu disini terlebih dahulu.</p>
          <button class="btn transparent" id="sign-up-btn">Sign Up</button>
        </div>
        <img src="./img/log.svg" class="image" alt="">
      </div>

      <div class="panel right-panel">
        <div class="content">
          <h3>Sudah memiliki akun?</h3>
          <p>Silahkan login untuk temukan barangmu.</p>
          <button class="btn transparent" id="sign-in-btn">Sign In</button>
        </div>
        <img src="./img/register.svg" class="image" alt="">
      </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
      <div class="footer-content">
        <p>Muhammad Zayan Hafizh Hadaya &copy; 2024</p>
        <p>222212776@stis.ac.id</p>
      </div>
    </footer>
    <!-- End of Footer -->
  </div>
  <script src="app.js"></script>
</body>
</html>
