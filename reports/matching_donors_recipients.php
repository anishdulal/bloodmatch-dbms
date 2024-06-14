<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../includes/db_connect.php');

$query = "SELECT r.id AS recipient_id, r.name AS recipient_name, d.id AS donor_id, d.name AS donor_name
          FROM recipient r
          JOIN donor d ON r.group = d.group
          ORDER BY r.id, d.id";
$stmt = $conn->prepare($query);
$stmt->execute();

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Matching Donors and Recipients</title>
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
    <h2>Matching Donors and Recipients</h2>
    <p>Here are the suitable donors for recipients based on blood type compatibility.</p>

    <?php
    if ($stmt->rowCount() > 0) {
        echo "<table><tr><th>Recipient ID</th><th>Recipient Name</th><th>Donor ID</th><th>Donor Name</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>".$row["recipient_id"]."</td><td>".$row["recipient_name"]."</td><td>".$row["donor_id"]."</td><td>".$row["donor_name"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No matching donors and recipients found.</p>";
    }
    $conn = null;
    ?>
</div>

</body>
</html>
