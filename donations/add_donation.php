<?php
include('../includes/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donor_id = $_POST["donor_id"];
    $bloodBank_id = $_POST["bloodBank_id"];

    $stmt = $conn->prepare("INSERT INTO donation_event (donor_id, bloodBank_id) VALUES (?, ?)");
    $stmt->bindParam(1, $donor_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $bloodBank_id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "New donation recorded successfully";
    } else {
        echo "Error: " . join(", ", $stmt->errorInfo());
    }
    $conn = null;
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Record a Donation</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Donor ID:<br>
  <input type="number" name="donor_id">
  <br>
  Blood Bank ID:<br>
  <input type="number" name="bloodBank_id">
  <br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>
