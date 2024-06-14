<?php
include('../includes/db_connect.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $group = $_POST["group"];
    $amount = $_POST["amount"];
    $phone = $_POST["phone"];
    $location = $_POST["location"];

    // Fetch the highest ID currently in use and add 1
    $stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM blood_bank");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $next_id = (int)$row['max_id'] + 1;  

    // Prepare the SQL statement with the new ID
    $stmt = $conn->prepare("INSERT INTO blood_bank (id, `group`, amount, phone, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $next_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $group, PDO::PARAM_STR);
    $stmt->bindParam(3, $amount, PDO::PARAM_STR);
    $stmt->bindParam(4, $phone, PDO::PARAM_STR);
    $stmt->bindParam(5, $location, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "New blood bank added successfully with ID " . $next_id;
    } else {
        echo "Error: " . join(", ", $stmt->errorInfo());
    }

    $stmt->closeCursor();
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Blood Bank Registration Form</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Blood Group:<br>
  <input type="text" name="group">
  <br>
  Amount:<br>
  <input type="text" name="amount">
  <br>
  Phone:<br>
  <input type="text" name="phone">
  <br>
  Location:<br>
  <input type="text" name="location">
  <br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>
