<!-- Insecure login form -->

<!DOCTYPE html>

<html>
<head>
  <title>Insecure login form</title>
</head>

<body>
  <h4>Please log in</h4>
  <form action="db.php" method="post">
    <?php if (isset($_GET['error'])) { ?>
      <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <input type="text" name="username_email" placeholder="Username or Email"><br />
    <input type="password" name="password" placeholder="Password"><br />
    <button name="login" type="submit">Login</button>
  </form>
  <p>
    <a href="register.php">Or, register here</a>
  </p>
</body>
</html>