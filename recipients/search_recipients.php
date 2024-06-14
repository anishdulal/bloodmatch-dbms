<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../includes/db_connect.php');

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Search Recipients</title>
</head>
<body>

<header>
    <h1>Blood Donation System</h1>
</header>

<nav>
    <ul>
        <li><a href="../donors/add_donor.php">Add Donor</a></li>
        <li><a href="../donors/list_donors.php">List Donors</a></li>
        <li><a href="../donors/search_donors.php">Search Donors</a></li>
        <li><a href="../recipients/add_recipient.php">Add Recipient</a></li>
        <li><a href="../recipients/list_recipients.php">List Recipients</a></li>
        <li><a href="../recipients/search_recipients.php">Search Recipients</a></li>
        <li><a href="../blood_banks/add_blood_bank.php">Add Blood Bank</a></li>
        <li><a href="../blood_banks/list_blood_banks.php">List Blood Banks</a></li>
        <li><a href="../blood_banks/search_blood_banks.php">Search Blood Banks</a></li>
        <li><a href="../donations/add_donation.php">Add Donation</a></li>
        <li><a href="../donations/list_donations.php">List Donations</a></li>
        <li><a href="../donations/search_donations.php">Search Donations</a></li>
    </ul>
</nav>

<div class="container">
    <h2>Search Recipients</h2>
    <p>Enter the blood group to search for recipients. The results will show the ID, name, blood group, location, and hospital ID of each recipient.</p>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <label for="group">Blood Group:</label><br>
      <input type="text" id="group" name="group">
      <br><br>
      <input type="submit" value="Search">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $group = $_POST["group"];

        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT id, name, `group`, location, hospital_id1 FROM recipient WHERE `group` = ?");
        $stmt->bindParam(1, $group, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<table><tr><th>ID</th><th>Name</th><th>Blood Group</th><th>Location</th><th>Hospital ID</th></tr>";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["group"]."</td><td>".$row["location"]."</td><td>".$row["hospital_id1"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No recipients found for the blood group <strong>" . htmlspecialchars($group) . "</strong>.</p>";
        }
        $conn = null;
    }
    ?>
</div>

</body>
</html>
