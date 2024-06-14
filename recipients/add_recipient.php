<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../includes/db_connect.php');

// Fetching hospital IDs and locations for the dropdown
$stmt = $conn->prepare("SELECT id, location FROM hospital");
$stmt->execute();
$hospitals = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $group = $_POST["group"];
    $location = $_POST["location"];
    $hospital_id1 = $_POST["hospital_id1"];

    $stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM recipient");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $next_id = (int)$row['max_id'] + 1;  

    $stmt = $conn->prepare("INSERT INTO recipient (id, name, `group`, location, hospital_id1) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $next_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $name, PDO::PARAM_STR);
    $stmt->bindParam(3, $group, PDO::PARAM_STR);
    $stmt->bindParam(4, $location, PDO::PARAM_STR);
    $stmt->bindParam(5, $hospital_id1, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "New recipient registered successfully with ID " . $next_id;
    } else {
        echo "Error: " . join(", ", $stmt->errorInfo());
    }

    $stmt->closeCursor();
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Recipient Registration Form</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name:<br>
  <input type="text" name="name">
  <br>
  Blood Group:<br>
  <input type="text" name="group">
  <br>
  Location:<br>
  <input type="text" name="location">
  <br>
  Hospital:<br>
  <select name="hospital_id1">
    <?php foreach ($hospitals as $hospital): ?>
        <option value="<?php echo $hospital['id']; ?>"><?php echo $hospital['location']; ?></option>
    <?php endforeach; ?>
  </select>
  <br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>
