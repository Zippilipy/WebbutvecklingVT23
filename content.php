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
    <script>
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
            updateTable();


            //$stmt = mysqli_stmt_init($conn); //initialize a new prep stmt
            //check if it's actually possible
            //if (!mysqli_stmt_prepare($stmt, $sql)) {
            //    header("location: ../index.php?error=stmtfailed");
            //    exit();
            //}
            //if it does not fail, bind paremeters to it
            //mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashedPwd);   //ssss: 4 pieces of data
            //mysqli_stmt_execute($stmt);
            //mysqli_stmt_close($stmt); //closing down the prepared statement
            ?>
            itemInput.value = '';
            countInput.value = 1;
        }
    </script>



</div>
