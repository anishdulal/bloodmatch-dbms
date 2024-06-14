<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../includes/db_connect.php');

$query = "SELECT h.name AS hospital_name, o.id AS order_id, bb.group AS blood_group, o.amount, o.date
          FROM hospital h
          JOIN `order` o ON h.id = o.hospital_id
          JOIN blood_bank bb ON o.bloodBank_id = bb.id
          ORDER BY h.name, o.date";
$stmt = $conn->prepare($query);
$stmt->execute();

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Hospital Orders</title>
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
    <h2>Hospital Orders</h2>
    <p>Here are the orders placed by each hospital, including blood group and amount.</p>

    <?php
    if ($stmt->rowCount() > 0) {
        echo "<table><tr><th>Hospital Name</th><th>Order ID</th><th>Blood Group</th><th>Amount</th><th>Date</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>".$row["hospital_name"]."</td><td>".$row["order_id"]."</td><td>".$row["blood_group"]."</td><td>".$row["amount"]."</td><td>".$row["date"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hospital orders found.</p>";
    }
    $conn = null;
    ?>
</div>

</body>
</html>
