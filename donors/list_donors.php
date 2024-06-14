<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../includes/db_connect.php'); 

$sql = "SELECT id, name, `group`, location FROM donor";
$stmt = $conn->prepare($sql); 
$stmt->execute(); 

if ($stmt->rowCount() > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Blood Group</th><th>Location</th></tr>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["group"]."</td><td>".$row["location"]."</td></tr>";
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
<h2>Donor List</h2>
</body>
</html>
