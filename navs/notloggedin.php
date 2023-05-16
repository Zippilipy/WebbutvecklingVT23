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

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="selectModal('id02    ', 'none')" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>


<div id="id01" class="modal">
  <span onclick="selectModal('id01', 'none')"x  
        class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate" action="includes/login.inc.php" method="post">
        <div class="imgcontainer">
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
        </div>

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

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="selectModal('id01', 'none')" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</div>
</div>
<div class="loginorregister" id="loginorRegister" style="display: none;"><button class="registerbutton" onclick="selectModal('id02', 'block')" style="width: auto; margin: 1rem;">Register</button><button class="loginbutton" onclick="selectModal('id01', 'block')" style="width: auto; margin: 1rem;">Login</button></div>
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
    <p style="text-align: center; margin: 1em;">Register and sign in to save and share your list with others!</p>
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

        function addItem(event) {
            event.preventDefault();
            var itemInput = document.getElementById('item');
            var itemName = itemInput.value.trim();

            if (itemName !== '') {
                items.push(itemName);
                itemInput.value = '';
                updateList();
            }
        }

        function removeItem(index) {
            items.splice(index, 1);
            updateList();
        }

        function updateList() {
            var listBody = document.getElementById('list-body');
            listBody.innerHTML = '';

            var itemCounts = {};
            for (var i = 0; i < items.length; i++) {
                var item = items[i];
                itemCounts[item] = (itemCounts[item] || 0) + 1;
            }

            for (var item in itemCounts) {
                var count = itemCounts[item];

                var row = document.createElement('tr');
                var itemCell = document.createElement('td');
                var countCell = document.createElement('td');
                var actionCell = document.createElement('td');
                var removeButton = document.createElement('button');

                itemCell.innerHTML = '<label class="labeltext">' + item + '</label>';
                countCell.innerHTML = '<label>Count</label><input type="number" min="1" max="3000" value="' + count + '">';

                removeButton.textContent = 'Remove';
                removeButton.classList.add('inputsubmit'); // Add the "inputsubmit" class
                removeButton.style.margin = '0'; // Add the margin property
                removeButton.addEventListener('click', (function(index) {
                    return function() {
                        removeItem(index);
                    };
                })(i));

                actionCell.appendChild(removeButton);
                row.appendChild(itemCell);
                row.appendChild(countCell);
                row.appendChild(actionCell);
                listBody.appendChild(row);
            }
        }

        var addItemForm = document.querySelector('.tableform');
        addItemForm.addEventListener('submit', addItem);
    });
</script>
</body>
</html>
