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
      <?php
      require_once("dbconn.php");

      $query = "SELECT firstName, lastName, dateOfBirth, gender, priorExperience FROM Participant";
      $result = $conn->query($query);

      if (!$result) {
        echo "<p>Couldn't retrieve participants.</p>";
      } else {
        echo "<table class='participants-table' border='1'>";
        echo "<tr><th>First name</th><th>Last name</th><th>Experienced</th><th>DOB</th><th>Gender</th></tr>";

        while ($row = $result->fetch_assoc()) {
          $experience = $row['priorExperience'] ? "<strong>Yes</strong>" : "No";
          echo "<tr>
            <td>{$row['firstName']}</td>
            <td>{$row['lastName']}</td>
            <td>{$experience}</td>
            <td>{$row['dateOfBirth']}</td>
            <td>{$row['gender']}</td>
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
