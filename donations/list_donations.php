<?php
include('../includes/db_connect.php');

$stmt = $conn->prepare("SELECT donor_id, bloodBank_id FROM donation_event");
$stmt->execute();

if ($stmt->rowCount() > 0) {
  echo "<table><tr><th>Donor ID</th><th>Blood Bank ID</th></tr>";
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>".$row["donor_id"]."</td><td>".$row["bloodBank_id"]."</td></tr>";
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

<h2>Donation List</h2>

</body>
</html>
