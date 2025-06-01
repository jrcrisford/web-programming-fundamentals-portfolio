<?php
require_once("dbconn.php");

//Check if appropriate GET (and POST) data has been received.
//If not then redirect the browser, which can only happen before ordinary content is generated.
if (!isset($_GET["id"])) {
  redirect("participants.php");
}
$id = $_GET["id"];

if (empty($_POST)) {
  // No POST data. Retrieve record for editing.
  $row = retrieve();
  // print_r($row); // Useful for debugging
} else {
  // POST data available. Update the database table.
  update();
  $conn->close();
  redirect("participants.php");
}

/** Redirect the user to another URL.  */
function redirect($url)
{
  header("location: $url");
  exit;
}

/** Queries the database for the record matching the global id and returns the result set. */
function retrieve()
{
  global $conn;
  global $id;

  $sql = "SELECT firstName, lastName, dateOfBirth, gender, priorExperience FROM Participant WHERE participantID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

/** Updates the database with parsed values from the POST data. */
function update()
{
  global $conn;
  global $id;

  $sql = "UPDATE Participant 
          SET firstName = ?, lastName = ?, dateOfBirth = ?, gender = ?, priorExperience = ?
          WHERE participantID = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssii",
    $_POST["fname"],
    $_POST["lname"],
    $_POST["dob"],
    $_POST["gender"],
    $_POST["experienced"],
    $id
  );
  $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="author" content="replace_with_your_name">
  <link rel="stylesheet" href="styles/style.css">
  <title>Admin: Edit Participant</title>
</head>
<body>
  <div id="container">
    <!-- Optional: You may choose to include common page components here -->
    <main>
      <h2>Edit Participant</h2>
      <!-- $_SERVER["PHP_SELF"] represents the current page -->
      <form class="editForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id"); ?>">
        <label class="form-label" for="fname">First name</label>
        <input class="form-control" type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($row["firstName"]) ?>">
        <span class="error-message unused"></span>

        <label class="form-label">Last name</label>
        <input class="form-control" type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($row["lastName"]) ?>">
        <span class="error-message unused"></span>

        <fieldset class="col-span">
          <legend class="form-label">Prior race experience?</legend>
          <label class="form-label"><input type="radio" name="experienced" value="1" <?php echo ($row["priorExperience"] == 1 ? "checked" : "") ?> required> Yes</label>
          <label class="form-label"><input type="radio" name="experienced" value="0" <?php echo ($row["priorExperience"] == 0 ? "checked" : "") ?> required> No</label>
        </fieldset>

        <label class="form-label">Date of birth</label>
        <input class="form-control" type="date" name="dob" id="dob" value="<?php echo $row["dateOfBirth"]; ?>">
        <span class="error-message unused"></span>

        <label class="form-label">Gender</label>
        <select class="form-control" id="gender" name="gender">
          <option value="undisclosed" <?php echo ($row['gender'] === "undisclosed" ? "selected" : ""); ?>>Prefer not to disclose</option>
          <option value="male" <?php echo ($row['gender'] === "male" ? "selected" : ""); ?>>Male</option>
          <option value="female" <?php echo ($row['gender'] === "female" ? "selected" : ""); ?>>Female</option>
          <option value="neither" <?php echo ($row['gender'] === "neither" ? "selected" : ""); ?>>Non-Binary, Gender Fluid, Gender non-conforming, or Gender queer</option>
        </select>

        <p class="col-span">
          <button type="submit" class="btn main-action">Update</button>
          <a href="participants.php" class="btn btn-cancel">Cancel</a>
        </p>
      </form>
    </main>
    <!-- Optional: You may choose to include a common page component here -->
  </div>
</body>
</html>
