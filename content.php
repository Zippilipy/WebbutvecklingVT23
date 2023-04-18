<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DB";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form submitted to add item
$userID = $_SESSION["userid"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST["item"];
    // Retrieve array from database for specific user
    $query = "SELECT userItems FROM users WHERE usersID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $items = [];
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $items = json_decode($row["userItems"], true);
    }
    // Add item to array and update in database
    $items[] = $item;
    $query = "UPDATE users SET userItems = ? WHERE usersID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", json_encode($items), $userID);
    $stmt->execute();
    $stmt->close();
    echo "<script>window.location.reload();</script>";
    header("Location: ".$_SERVER["PHP_SELF"]);
    exit();
}

// Retrieve array from database for specific user
$query = "SELECT userItems FROM users WHERE usersID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$items = [];
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $items = json_decode($row["userItems"], true);
}
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Items List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
<h1>Items List</h1>
<form method="post">
    <label for="item">Add Item: </label>
    <input type="text" id="item" name="item">
    <input type="submit" value="Add">
</form>
<br>
<table>
    <tr>
        <th>Item</th>
        <th>Count</th>
    </tr>
    <?php
    // Count occurrences of each item
    $itemCounts = array_count_values($items);
    foreach ($itemCounts as $item => $count) {
        echo "<tr>";
        echo "<td>" . $item . "</td>";
        echo "<td>" . $count . "</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>

</html>
