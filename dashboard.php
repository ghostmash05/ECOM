<?php
include 'components/header.php';

$query = "SELECT * FROM users WHERE email = '$_SESSION[email]'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$name = $row['full_name'];
$email = $row['email'];
$phone = $row['phone'];
$username = $row['username'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    <div class="home">
        <a href="index.php"><ion-icon name="home-outline"></ion-icon></a>
    </div>
<div class="card">
    <div class="card-body">
        <h2 class="card-title">Personal Information</h2>
        <p class="card-text">Name: <?php echo $name; ?></p>
        <p class="card-text">Email: <?php echo $email; ?></p>
        <p class="card-text">Phone: <?php echo $phone; ?></p>
        <p class="card-text">Username: <?php echo $username; ?></p>
    </div>
</div>
</body>
</html>