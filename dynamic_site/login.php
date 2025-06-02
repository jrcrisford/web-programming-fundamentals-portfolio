<?php
require_once("dbconn.php");
session_start();

$invalid_login = false;
if (isset($_POST["username"]) && isset($_POST["password"])) {
  $username = trim($_POST["username"]);
  $password = $_POST["password"];

  if (authenticate($username, $password)) {
    $_SESSION["user"] = $username;
    header("Location: participants.php");
    exit();
  } else {
    $invalid_login = true;
  }
}

/**
 * Queries the DBMS with the supplied user details
 * Returns true on successful authentication and false otherwise.
 */
function authenticate($user, $pass)
{
  global $conn;

  $sql = "SELECT password FROM User WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $user);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $row = $result->fetch_assoc()) {
    return password_verify($pass, $row["password"]);
  }

  return false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="author" content="replace_with_your_name">
  <link rel="stylesheet" href="styles/style.css">
  <title>Admin: Log in</title>
</head>
<body>
  <div id="container">
    <!-- Optional: You may choose to include common page components here -->
    <main>
      <h2>Log in</h2>
      <!-- $_SERVER["PHP_SELF"] represents the current page -->
      <form class="editForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label class="form-label" for="username">Username</label>
        <input class="form-control" type="text" name="username" id="username" placeholder="Enter your username" maxlength="10" required>
        <span class="error-message unused"></span>

        <label class="form-label">Password</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password" minlength="8" required>
        <span class="error-message unused"></span>

        <p class="col-span">
          <button type="submit" class="btn main-action">Log in</button>
        </p>
      </form>

      <?php if ($invalid_login): ?>
        <p class="error-message col-span">Invalid username or password. Please try again.</p>
      <?php endif; ?>
      <p>Try accessing a protected page like <a href="participants.php">participants.php</a> when are/are not logged in.</p>

    </main>
    <!-- Optional: You may choose to include a common page component here -->
  </div>
</body>
</html>