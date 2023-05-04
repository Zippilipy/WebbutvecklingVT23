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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["item"])) {
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
    $variable = json_encode($items);
    $stmt->bind_param("si", $variable, $userID);
    $stmt->execute();
    $stmt->close();
    echo "<script>window.location.reload();</script>";
    header("Location: ".$_SERVER["PHP_SELF"]);
    exit();
}
// Check if form submitted to remove item
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["remove_item"])) {
        $remove_item = $_POST["remove_item"];
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
        // Remove item from array and update in database
        $countarray = array_count_values($items);
        $count = $countarray["$remove_item"];
        for ($i = 0; $i < $count; $i++){
        $index = array_search($remove_item, $items);
            if ($index !== false) {

                    array_splice($items, $index, 1);
                    }}
                    $query = "UPDATE users SET userItems = ? WHERE usersID = ?";
                    $stmt = $conn->prepare($query);
                    $variable = json_encode($items);
                    $stmt->bind_param("si", $variable, $userID);
                    $stmt->execute();
                    $stmt->close();
                echo "<script>window.location.reload();</script>";
                echo "test";
                header("Location: ".$_SERVER["PHP_SELF"]);
                exit();


    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["quantity"])) {
    $newcount = $_POST["quantity"];
    $name = $_POST["name"];
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
    $countarray = array_count_values($items);
    $count = $countarray["$name"];
    $deltacount = $newcount - $count;
    if($deltacount < 0){ //Remove items
        for ($i = 0; $i < abs($deltacount); $i++){
            $index = array_search($name, $items);
            if ($index !== false) {

                array_splice($items, $index, 1);
                }}
                $query = "UPDATE users SET userItems = ? WHERE usersID = ?";
                $stmt = $conn->prepare($query);
                $variable = json_encode($items);
                $stmt->bind_param("si", $variable, $userID);
                $stmt->execute();
                $stmt->close();

        echo "<script>window.location.reload();</script>";
        echo "test";
        header("Location: ".$_SERVER["PHP_SELF"]);
        exit();

    }
    if($deltacount == 0){
    }
    else{ //Add items
        for ($i = 0; $i < $deltacount; $i++) {
            $items[] = $name;
        }
            $query = "UPDATE users SET userItems = ? WHERE usersID = ?";
            $stmt = $conn->prepare($query);
            $variable = json_encode($items);
            $stmt->bind_param("si", $variable, $userID);
            $stmt->execute();
            $stmt->close();
        echo "<script>window.location.reload();</script>";
        header("Location: ".$_SERVER["PHP_SELF"]);
        exit();
    }
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 16px;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            margin-bottom: 16px;
        }
        label {
            font-weight: bold;
            margin-right: 8px;
        }
        input[type="text"],
        input[type="number"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"],
        button {
            margin-left: 8px;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover,
        button:hover {
            background-color: #3E8E41;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td:first-child {
            width: 70%;
        }
        td:last-child {
            text-align: center;
        }
        .debug {
            margin-top: 16px;
            background-color: #f1f1f1;
            padding: 16px;
            font-size: 14px;
            color: #666;
            line-height: 1.4;
            word-break: break-all;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Items List</h1>
    <form method="post">
        <label for="item">Add Item:</label>
        <input type="text" id="item" name="item">
        <input type="submit" value="Add">
    </form>
    <table>
        <thead>
        <tr>
            <th>Item</th>
            <th>Count</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
    <?php
    // Count occurrences of each item
    echo '<div id="debug">';
    //print_r($items);
    echo '</div>';
    $itemCounts = array_count_values($items);
    $counter = 0;
    foreach ($itemCounts as $item => $count) {
        echo "<tr>";
        echo "<td> <form method='post' id='form" . $counter . "'><label for='name'>" . $item . "</label><input type='hidden' id='name' name='name' value='" . $item . "'

</td><td><label for='quantity'>Count</label>
<input id='submit" . $counter . "' type='number' id='quantity' name='quantity' min='1' value='" . $count . "'> </form> </td> ";
        echo "<td><form method='post'><input type='hidden' name='remove_item' value='" . $item . "'><button type='submit'>Remove</button></form></td>";
        echo "</tr>";
        echo "<script>
                const myForm = document.getElementById('form" . $counter . "');
document.getElementById('submit" . $counter . "').addEventListener('change', function(){

  myForm.submit();

});
              </script>";
        $counter++;
    }
    ?>
</table>

</body>

</html>
