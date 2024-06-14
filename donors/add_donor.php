<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Add Donor</title>
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
        <!-- <li><a href="../donations/add_donation.php">Add Donation</a></li> -->
        <li><a href="../reports/top_donors.php">Top Donors</a></li>
        <li><a href="../reports/blood_availability.php">Blood Availability</a></li>
        <li><a href="../reports/matching_donors_recipients.php">Matching Donors and Recipients</a></li>
        <li><a href="../reports/total_donations_by_blood_type.php">Total Donations by Blood Type</a></li>
        <li><a href="../reports/blood_bank_donations.php">Blood Bank Donations</a></li>
        <li><a href="../reports/blood_stock_alerts.php">Blood Stock Alerts</a></li>
    </ul>
</nav>

<div class="container">
    <h2>Donor Registration Form</h2>
    <p>Fill in the details below to register a new donor in the system. Make sure all information is accurate and complete.</p>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name"><br><br>

      <label for="group">Blood Group:</label><br>
      <input type="text" id="group" name="group"><br><br>

      <label for="location">Location:</label><br>
      <input type="text" id="location" name="location"><br><br>

      <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
