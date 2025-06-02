<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Josh Crisford">
  <link rel="stylesheet" href="styles/style.css"><!-- For later -->
  <title>Marathon 2025 Admin</title>
</head>
<body>
  <div id="container">
    <?php include("components/header.php"); ?>
    <?php include("components/nav.php"); ?>

    <main>
      <h2>Registered Participants</h2>
      <p><a href="add.html" class="btn main-action">Add</a></p>
      <?php
      require_once("dbconn.php");

      $query = "SELECT participantID, firstName, lastName, dateOfBirth, gender, priorExperience FROM Participant";
      $result = $conn->query($query);

      if (!$result) {
        echo "<p>Couldn't retrieve participants.</p>";
      } else {
        echo "<table class='participants-table' border='1'>";
        echo "<tr><th>First name</th><th>Last name</th><th>Experienced</th><th>DOB</th><th>Gender</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
          $experience = $row['priorExperience'] ? "<strong>Yes</strong>" : "No";
          $firstName = htmlspecialchars($row['firstName']);
          $lastName = htmlspecialchars($row['lastName']);
          $participantID = htmlspecialchars($row['participantID']);

          echo "<tr>
            <td>{$row['firstName']}</td>
            <td>{$row['lastName']}</td>
            <td>{$experience}</td>
            <td>{$row['dateOfBirth']}</td>
            <td>{$row['gender']}</td>
            <td><a href='edit.php?id={$participantID}' class='btn main-action'>Edit</a>
          </tr>";
        }

        echo "</table>";
      }

      $conn->close();
      ?>
    </main>
    
    <?php include("components/footer.php"); ?>
  </div>
</body>
</html>
