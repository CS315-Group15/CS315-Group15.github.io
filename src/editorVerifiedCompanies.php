<?php
include("session.php");

if (isset($_POST['logout'])) {
  session_destroy();
  header("location: editorLogin.php");
}

include("config.php");
$username = $_SESSION['editor_id'];

$rs_verified = $mysqli->query("" .
  "SELECT * " .
  "FROM Company " .
  "WHERE company_id IN ( " .
  "SELECT company_id " .
  "FROM verify)");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BilkentCodes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/style.css">

  <script>
    function verify(verified, id) {
      if (verified) {
        document.getElementById(id).innerHTML =
          "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-bookmarks' viewBox='0 0 16 16'>" +
          "<path d = 'M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z'/>" +
          "<path d = 'M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z'/>" +
          "</svg>";
      } else {
        document.getElementById(id).innerHTML =
          "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-bookmarks-fill' viewBox='0 0 16 16'>" +
          "<path d = 'M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z'/>" +
          "<path d = 'M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z'/>" +
          "</svg>";
      }
    }
  </script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="userHomePage.php" class="navbar-brand">BilkentCodes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bstarget="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item nav-links">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="yellow" class="bi bi-mailbox" viewBox="0 0 16 16">
                <path d="M4 4a3 3 0 0 0-3 3v6h6V7a3 3 0 0 0-3-3zm0-1h8a4 4 0 0 1 4 4v6a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V7a4 4 0 0 1 4-4zm2.646 1A3.99 3.99 0 0 1 8 7v6h7V7a3 3 0 0 0-3-3H6.646z" />
                <path d="M11.793 8.5H9v-1h5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.354-.146l-.853-.854zM5 7c0 .552-.448 0-1 0s-1 .552-1 0a1 1 0 0 1 2 0z" />
              </svg>
            </a>
          </li>
          <li class="nav-item nav-links">
            <a class="nav-link" href="userProfile.php">Your Profile</a>
          </li>
          <li class="nav-item nav-links">
            <form action="userHomePage.php" method="POST" id="logout">
              <div>
                <button class="btn btn-primary btn-large" type="submit" name="logout">Log Out</button>
              </div>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="user-old-submission">
    <div class="user-old-submission-header">
      <h1 class="user-old-submission-header-top" title="Scroll down to see more">
        Verified Companies
      </h1>
    </div>
    <div class="user-all-announcements-content">
      <div class="user-all-announcements-content-bottom">
        <?php
        while ($row = mysqli_fetch_array($rs_verified)) :
          $company_name = $row['name'];
          $company_id = $row['company_id'];
          echo "<div class=\"new-verify-company-footer\">" .
            "<a href=\"#\" class=\"btn btn-outline-secondary btn-lg user-all-announcements-content-bottom-links\" style=\"height: 42px;\">$company_id - $company_name</a>" .
            "<a href=\"#\" class=\"btn btn-primary\" style=\"height: 42px;\">Cancel</a>" .
            "</div>";
        endwhile;
        ?>
      </div>
      <div class="user-all-announcements-content-footer">
        <a href="editorUnverifiedCompanies.php" class="btn btn-primary">View unverified companies</a>
      </div>
    </div>
  </div>


</body>

</html>