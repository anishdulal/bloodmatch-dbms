<?php
include('../includes/db_connect.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $group = $_POST["group"];
    $location = $_POST["location"];

    $stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM donor");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $next_id = $row['max_id'] + 1;

    $stmt = $conn->prepare("INSERT INTO donor (id, name, `group`, location) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $next_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $name, PDO::PARAM_STR);
    $stmt->bindParam(3, $group, PDO::PARAM_STR);
    $stmt->bindParam(4, $location, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "New donor registered successfully with ID " . $next_id;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];  
    }

    $stmt->closeCursor();
}

?>

<!DOCTYPE html>
<html>
<body>

<h2>Donor Registration Form</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name:<br>
  <input type="text" name="name">
  <br>
  Blood Group:<br>
  <input type="text" name="group">
  <br>
  Location:<br>
  <input type="text" name="location">
  <br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>
