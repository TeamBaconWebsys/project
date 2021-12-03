<!-- Insecure login form -->

<!DOCTYPE html>

<html>
<head>
  <title>Insecure login form</title>
</head>

<body>
  <h4>Please register</h4>
  <form action="db.php" method="post">
    <?php if (isset($_GET['error'])) { ?>
      <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <input type="text" name="username" placeholder="Username"><br />
    <input type="text" name="email" placeholder="Email"><br />
    <input type="text" name="display_name" placeholder="Display Name (optional)"><br />
    <input type="password" name="password" placeholder="Password"><br />
    <button name="register" type="submit">Register</button>
  </form>
</body>
</html>
