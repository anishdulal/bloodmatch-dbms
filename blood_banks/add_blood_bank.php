<?php
include('../includes/db_connect.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $group = $_POST["group"];
    $amount = $_POST["amount"];
    $phone = $_POST["phone"];
    $location = $_POST["location"];

    // Fetch the highest ID currently in use and add 1
    $stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM blood_bank");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $next_id = (int)$row['max_id'] + 1;  

    // Prepare the SQL statement with the new ID
    $stmt = $conn->prepare("INSERT INTO blood_bank (id, `group`, amount, phone, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $next_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $group, PDO::PARAM_STR);
    $stmt->bindParam(3, $amount, PDO::PARAM_STR);
    $stmt->bindParam(4, $phone, PDO::PARAM_STR);
    $stmt->bindParam(5, $location, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "New blood bank added successfully with ID " . $next_id;
    } else {
        echo "Error: " . join(", ", $stmt->errorInfo());
    }

    $stmt->closeCursor();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Add Blood Bank</title>
</head>
<body>

<header>
    <h1>Blood Donation System</h1>
</header>

<nav>
<ul>
        <li><a href="donors/add_donor.php">Add Donor</a></li>
        <li><a href="donors/list_donors.php">List Donors</a></li>
        <li><a href="donors/search_donors.php">Search Donors</a></li>
        <li><a href="recipients/add_recipient.php">Add Recipient</a></li>
        <li><a href="recipients/list_recipients.php">List Recipients</a></li>
        <li><a href="recipients/search_recipients.php">Search Recipients</a></li>
        <li><a href="blood_banks/add_blood_bank.php">Add Blood Bank</a></li>
        <li><a href="blood_banks/list_blood_banks.php">List Blood Banks</a></li>
        <li><a href="blood_banks/search_blood_banks.php">Search Blood Banks</a></li>
        <li><a href="donations/add_donation.php">Add Donation</a></li>
        <li><a href="reports/top_donors.php">Top Donors</a></li>
        <li><a href="reports/blood_availability.php">Blood Availability</a></li>
        <li><a href="reports/matching_donors_recipients.php">Matching Donors and Recipients</a></li>
        <li><a href="reports/total_donations_by_blood_type.php">Total Donations by Blood Type</a></li>
        <li><a href="reports/blood_bank_donations.php">Blood Bank Donations</a></li>
        <li><a href="reports/blood_stock_alerts.php">Blood Stock Alerts</a></li>
    </ul>
</nav>

<div class="container">
    <h2>Blood Bank Registration Form</h2>
    <p>Fill in the details below to register a new blood bank in the system. Ensure all information is accurate and complete.</p>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <label for="group">Blood Group:</label><br>
      <input type="text" id="group" name="group"><br><br>

      <label for="amount">Amount:</label><br>
      <input type="text" id="amount" name="amount"><br><br>

      <label for="phone">Phone:</label><br>
      <input type="text" id="phone" name="phone"><br><br>

      <label for="location">Location:</label><br>
      <input type="text" id="location" name="location"><br><br>

      <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
