<?php
include('../includes/db_connect.php');

$stmt = $conn->prepare("SELECT id, `group`, amount, phone, location FROM blood_bank");
$stmt->execute();

if ($stmt->rowCount() > 0) {
  echo "<table><tr><th>ID</th><th>Blood Group</th><th>Amount</th><th>Phone</th><th>Location</th></tr>";
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["group"]."</td><td>".$row["amount"]."</td><td>".$row["phone"]."</td><td>".$row["location"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn = null;
?>

<!DOCTYPE html>
<html>
<body>

<h2>Blood Bank List</h2>

</body>
</html>
