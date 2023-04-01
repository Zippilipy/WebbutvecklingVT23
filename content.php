<div>

    <?php
    $json_data = json_encode($_SESSION["userItems"]);
    ?>

    <table id="output">
        <thead>
        <tr>
            <th>Item</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div>
        <label for="item">Item:</label>
        <input type="text" id="item">
        <label for="count">Count:</label>
        <input type="number" id="count" value="1">
        <button onclick="addItem()">Add</button>
    </div>
    <script defer>
        var data = <?php echo $json_data; ?>;
        const javascriptArray = JSON.parse(data).list;
        var counts = {};
        for (var i = 0; i < javascriptArray.length; i++) {
            var item = javascriptArray[i];
            counts[item] = counts[item] ? counts[item] + 1 : 1;
        }

        var outputTable = document.getElementById('output').getElementsByTagName('tbody')[0];
        for (var item in counts) {
            var count = counts[item];
            var row = document.createElement('tr');
            var itemCell = document.createElement('td');
            var countCell = document.createElement('td');
            var removeCell = document.createElement('td');
            var removeButton = document.createElement('button');
            itemCell.textContent = item;
            countCell.textContent = count;
            removeButton.textContent = 'Remove';
            removeButton.addEventListener('click', function() {
                delete counts[item];
                updateTable();
            });
            removeCell.appendChild(removeButton);
            row.appendChild(itemCell);
            row.appendChild(countCell);
            row.appendChild(removeCell);
            outputTable.appendChild(row);
        }

        function updateTable() {
            var outputTable = document.getElementById('output').getElementsByTagName('tbody')[0];
            outputTable.innerHTML = '';
            for (var item in counts) {
                var count = counts[item];
                var row = document.createElement('tr');
                var itemCell = document.createElement('td');
                var countCell = document.createElement('td');
                var removeCell = document.createElement('td');
                var removeButton = document.createElement('button');
                itemCell.textContent = item;
                countCell.textContent = count;
                removeButton.textContent = 'Remove';
                removeButton.addEventListener('click', function() {
                    delete counts[item];
                    updateTable();
                });
                removeCell.appendChild(removeButton);
                row.appendChild(itemCell);
                row.appendChild(countCell);
                row.appendChild(removeCell);
                outputTable.appendChild(row);
            }
        }

        function addItem() {
            console.log("test")
            var itemInput = document.getElementById('item');
            var countInput = document.getElementById('count');
            var item = itemInput.value;
            console.log(item)
            var count = parseInt(countInput.value, 10);
            console.log(count)
            if (!counts[item]) {
                counts[item] = count;
            } else {
                counts[item] += count;
            }
            document.write('<?php
                $serverName = "localhost";  //xampp
                $dBUsername = "root";
                $dBPassword = "";           // tom 'on default'
                $dBName = "DB";  // databas i php myadmin

                //mysqli_connect opens a connection to the MySQL Server.
                $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName); // function & uppkoppling

                if(!$conn) {    //om uppkoppling (!) INTE funkar
                    die("Uppkoppling misslyckades: " . mysqli_connect_error()); //'kill it' och visa meddelande
                }
                $sql = "UPDATE users
    SET userItems = JSON_ARRAY_APPEND(userItems,
                '$.list', 'Egg')
WHERE usersID = 2524;";

                if (mysqli_query($conn, $sql)) {
                    echo "Record updated successfully";
                    exit();
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                    exit();
                }


                ?>')

            updateTable();
            itemInput.value = '';
            countInput.value = 1;
        }
    </script>



</div>
