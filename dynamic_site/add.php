<?php
require_once("dbconn.php");

if (isset($_POST["fname"], $_POST["lname"], $_POST["dob"], $_POST["gender"], $_POST["experienced"])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $experienced = (int)$_POST["experienced"];

    $sql = "INSERT INTO Participant (firstName, lastName, dateOfBirth, gender, priorExperience)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fname, $lname, $dob, $gender, $experienced);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: participants.php");
        exit;
    } else {
        die("Error inseting data.");
    }

} else {
    header("Location: add.html");
    exit;   
}
?>