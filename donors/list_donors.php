<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../includes/db_connect.php');

$sql = "SELECT id, name, `group`, location FROM donor";
$stmt = $conn->prepare($sql); 
$stmt->execute(); 

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Donor List</title>
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
    <h2>Donor List</h2>
    <p>Below is a list of all the donors currently registered in our system. You can see their ID, name, blood group, and location.</p>

    <?php
    if ($stmt->rowCount() > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Blood Group</th><th>Location</th></tr>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["group"]."</td><td>".$row["location"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No donors found.</p>";
    }

    $conn = null; 
    ?>
</div>
</body>
</html>
