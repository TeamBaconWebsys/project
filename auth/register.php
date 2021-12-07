<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap 5 stylesheet and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous" defer></script>

    <!--custom CSS and JS-->
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js" async></script>

    <title>Enter the Soup Kitchen</title>
  </head>

  <body class="first-time">
    <a><img src="images/soup_icon.svg" width="145" alt="" class="d-inline-block align-middle mr-2"></a>
    <h1 class="display-1 text-center">soup.kitchen</h1>

    <div id="wrapper">

      <div class="form_div">
        <p class="form_label">Get Your First Bowl of Soup</p>
        <form action="db.php" method="post">
          <?php if (isset($_GET['error'])) { ?>
          <p class="error">
            <?php echo $_GET['error']; ?>
          </p>
          <?php } ?>
          <input type="text" name="username" placeholder="Username" class="my-1"><br />
          <input type="text" name="email" placeholder="Email" class="my-1"><br />
          <input type="text" name="display_name" placeholder="Display Name (optional)" class="my-1"><br />
          <input type="password" name="password" placeholder="Password" class="my-1"><br />
          <button name="register" class="btn btn-warning btn-lg my-1" type="submit">Register</button>
        </form>

        <p>
          <a href="login.php" class="btn btn-danger mt-2">Or, login here</a>
        </p>
      </div>

    </div>
  </body>

</html>