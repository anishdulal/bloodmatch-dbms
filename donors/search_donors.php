<?php
include('../includes/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $group = $_POST["group"];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT id, name, `group`, location FROM donor WHERE `group` = ?");
    $stmt->bindParam(1, $group, PDO::PARAM_STR);
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
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Search Donors</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Blood Group:<br>
  <input type="text" name="group">
  <br><br>
  <input type="submit" value="Search">
</form>

</body>
</html>
