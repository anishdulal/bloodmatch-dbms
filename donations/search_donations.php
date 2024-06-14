<?php
include('../includes/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donor_id = $_POST["donor_id"];
    $stmt = $conn->prepare("SELECT donor_id, bloodBank_id FROM donation_event WHERE donor_id = ?");
    $stmt->bindParam(1, $donor_id, PDO::PARAM_INT);
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
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Search Donations</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Donor ID:<br>
  <input type="number" name="donor_id">
  <br><br>
  <input type="submit" value="Search">
</form>

</body>
</html>
