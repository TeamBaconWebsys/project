<?php 
  session_start();
  if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Page title and meta tags -->
    <title>Lab 8</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- getting fonts and fontawesome icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Roboto+Slab&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4bfa365d66.js" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous" defer></script>

    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>

    <!-- import custom CSS/JS -->
    <link rel="stylesheet" href="assets/styles.css">
    <script src="assets/page_builder.js" defer></script>
    <script src="assets/scripts.js" defer></script>
  </head>

  <body id="top">
    <main>
      <div class="container">
        <div class="row">
          <div class="col-auto">
            <!-- Author for sidebar: Mark Otto, Jacob Thornton, and Bootstrap contributors -->
            <div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
              <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                <span class="fs-5 fw-semibold">Lab 8</span>
              </a>
              <ul class="list-unstyled ps-0" id="sidebar-items">
                <!-- Sidebar content gets filled in here -->
              </ul>
              <ul class="list-unstyled ps-0">
                <li class="mb-1">
                  <a class="btn align-items-center rounded" id="refresh">
                    Refresh
                  </a>
                </li>
                <li class="mb-1">
                  <a href="logout.php" class="btn align-items-center rounded">
                    Logout
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-auto">
            <div class="b-example-divider"></div>
          </div>
          <div class="col">
            <div id="content"></div>
          </div>
        </div>
      </div>
    </main>
  </body>

</html>

<?php 
} else {
  header("Location: login.php");
  exit();
}
?>
