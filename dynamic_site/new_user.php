<?php
session_start();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

require_once("dbconn.php");

$username_exists = false; 

if (isset($_POST["username"]) && isset($_POST["password"])) {
  $username = trim($_POST["username"]);
  $password = $_POST["password"];
  $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

  if (exists($username)) {
    $username_exists = true;
  } else {
    $sql = "INSERT INTO User (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_pass);
    $stmt->execute();
    $stmt->close();

    echo "<p>Inserted user '<strong>$username</strong>' with a hashed password of <strong>$hashed_pass</strong></p>";
    exit;
  }
}

/** Optional improvement: Returns true if the given username is already in use. */
function exists($username)
{
  global $conn;
  $sql = "SELECT username FROM User WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->num_rows > 0;
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="author" content="replace_with_your_name">
  <link rel="stylesheet" href="styles/style.css">
  <title>Admin: Create New User</title>
</head>
<body>
  <div id="container">                               
    <main>
      <h2>Create New User</h2>

      <?php if ($username_exists): ?>
        <p class="error-message">Username already exists. Please choose a different username.</p>
      <?php endif; ?>

      <form class="editForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label class="form-label" for="username">Username</label>
        <input class="form-control" type="text" name="username" id="username" placeholder="Enter the new username" maxlength="10" required>
        <span class="error-message unused"></span>

        <label class="form-label">Password</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Enter their password" minlength="8" required>
        <span class="error-message unused"></span>

        <p class="col-span">
          <button type="submit" class="btn main-action">Add User</button>
        </p>
      </form>
      <p>Return to the <a href="login.php">login</a> page.</p>
    </main>
  </div>
</body>
</html>
