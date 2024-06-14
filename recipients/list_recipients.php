<?php
include('../includes/db_connect.php');

$stmt = $conn->prepare("SELECT id, name, `group`, location, hospital_id1 FROM recipient");
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Blood Group</th><th>Location</th><th>Hospital ID</th></tr>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["group"]."</td><td>".$row["location"]."</td><td>".$row["hospital_id1"]."</td></tr>";
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

<h2>Recipient List</h2>

</body>
</html>
