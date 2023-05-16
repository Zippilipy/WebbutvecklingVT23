<div class='topdiv'>
    <a class='homebutton' href='#'><h2 class='logotext1'>ChatNShop</h2></a>
    <!--<input class="search" type="text" placeholder="Search..">-->
<!-- Button to open the modal login form -->
<div class="logindiv"><img onclick="toggleLogIn()" class="avatarbutton" src="assets/th-3077032434.jpg" height="20px"><button onclick="selectModal('id02', 'block')" style="width: auto; margin: 1rem;">Register</button><button onclick="selectModal('id01', 'block')" style="width: auto; margin: 1rem;">Login</button></div>
<!-- The Modal -->
<div id="id02" class="modal">
  <span onclick="selectModal('id02', 'none')"
        class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate" action="includes/signup.inc.php" method="post">

        <div class="container">
            <h2 class="registerh2">Register</h2>

            <label for="email"><b>Email</b>
                <input type="text" placeholder="Enter Email" name="email" required></label>

            <label for="uid"><b>Username</b>
                <input type="text" placeholder="Enter Username" name="uid" required></label>

            <label for="pwd"><b>Password</b>
                <input type="password" placeholder="Enter Password" name="pwd" required></label>

            <label for="pwdrepeat"><b>Confirm password</b>
                <input type="password" placeholder="Enter Password" name="pwdrepeat" required></label>

            <button type="submit" name="submit">Register</button>
        </div>

        <div class="container">
            <button type="button" onclick="selectModal('id02    ', 'none')" class="cancelbtn">Cancel</button>
        </div>
    </form>
    <?php if ($displayErrorregister): ?>
        <div class="modal-error" onclick="hideThis()">
            <p id="error-message-register"><?php echo $display ?></p>
        </div>        <script>
            // Display the error message and keep the form open
            window.onload = function() {
                //document.getElementById('error-message-register').style.display = 'block';
                selectModal('id02', 'block');
            };
        </script>
    <?php endif; ?>
</div>


<div id="id01" class="modal">
  <span onclick="selectModal('id01', 'none')"
        class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate" action="includes/login.inc.php" method="post">

        <div class="container">
            <label for="logemail"><b>Email</b>
            <input type="text" placeholder="Enter Email" name="logemail" required></label>

            <label for="logpwd"><b>Password</b>
            <input type="password" placeholder="Enter Password" name="logpwd" required></label>

            <button type="submit" name="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container">
            <button type="button" onclick="selectModal('id01', 'none')" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
    <?php if (isset($_GET['login_error']) && $_GET['login_error'] == 'true'): ?>
        <div class="modal-error" onclick="hideThis()">
            <p id="error-message">Incorrect email or password.</p>
        </div>        <script>
            // Display the error message and keep the form open
            window.onload = function() {
                document.getElementById('error-message').style.display = 'block';
                selectModal('id01', 'block');
            };
        </script>
    <?php endif; ?>

</div>
</div>
<div class="loginorregister" id="loginorRegister" style="display: none;"><button class="registerbutton" onclick="selectModal('id02', 'block')" style="width: auto; margin: 1rem;">Register</button><button class="loginbutton" onclick="selectModal('id01', 'block')" style="width: auto; margin: 1rem;">Login</button></div>

<script>
    // Call selectModal function and pass the error flag as a parameter
    selectModal('id01', <?php echo $displayErrorlogin ? 'true' : 'false'; ?>);
</script>

<!DOCTYPE html>
<html>
<head>
    <title>Your List</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 16px;
        }
        h1 {
            text-align: center;
        }
        .tableform {
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
        .inputsubmit {
            margin-left: 8px;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .inputsubmit:hover {
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
        .labeltext{
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Your List</h1>
    <form class="tableform">
        <label for="item">Add Item:</label>
        <input type="text" id="item" name="item">
        <input class="inputsubmit" type="submit" value="Add">
    </form>
    <table id="list-table">
        <thead>
        <tr>
            <th>Item</th>
            <th>Count</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="list-body">
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var items = [];
        var itemCounts = {};

        function addItem(event) {
            event.preventDefault();
            var itemInput = document.getElementById('item');
            var itemName = itemInput.value.trim();

            if (itemName !== '') {
                items.push(itemName);
                itemCounts[itemName] = (itemCounts[itemName] || 0) + 1;
                itemInput.value = '';
                updateList();
            }
        }

        function removeItem(item) {
            var index = items.indexOf(item);
            if (index !== -1) {
                items.splice(index, 1);
                delete itemCounts[item];
                updateList();
            }
        }

        function updateItemCount(item, count) {
            itemCounts[item] = parseInt(count);
            updateList();
        }

        function updateList() {
            var listBody = document.getElementById('list-body');
            listBody.innerHTML = '';

            for (var item in itemCounts) {
                var count = itemCounts[item];

                var row = document.createElement('tr');
                var itemCell = document.createElement('td');
                var countCell = document.createElement('td');
                var actionCell = document.createElement('td');
                var removeButton = document.createElement('button');
                var countInput = document.createElement('input');

                itemCell.innerHTML = '<label class="labeltext">' + item + '</label>';

                countInput.type = 'number';
                countInput.min = '1';
                countInput.max = '3000';
                countInput.value = count;
                countInput.addEventListener('change', (function(item, countInput) {
                    return function() {
                        updateItemCount(item, countInput.value);
                    };
                })(item, countInput));

                removeButton.textContent = 'Remove';
                removeButton.classList.add('inputsubmit');
                removeButton.addEventListener('click', (function(item) {
                    return function() {
                        removeItem(item);
                    };
                })(item));

                countCell.appendChild(countInput);
                actionCell.appendChild(removeButton);
                row.appendChild(itemCell);
                row.appendChild(countCell);
                row.appendChild(actionCell);
                listBody.appendChild(row);
            }
        }

        var addItemForm = document.querySelector('.tableform');
        addItemForm.addEventListener('submit', addItem);

        updateList();
    });
</script>
</body>
</html>
