<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Record a Donation</title>
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
    <h2>Record a Donation</h2>
    <p>Fill in the details below to record a new donation event in the system.</p>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <label for="donor_id">Donor ID:</label><br>
      <input type="number" id="donor_id" name="donor_id"><br><br>

      <label for="bloodBank_id">Blood Bank ID:</label><br>
      <input type="number" id="bloodBank_id" name="bloodBank_id"><br><br>

      <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
