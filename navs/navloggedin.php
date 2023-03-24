<div class='topdiv'>
    <a class='homebutton' href='#'><h2 class='logotext1'>ChatNShop</h2></a>
        <?php echo "<div class='userandbutton'><li class='name'><a class='user' onclick=\"selectModal('id03', 'block')\">" . htmlspecialchars(ucfirst($_SESSION["userUid"])) . "</a></li>"; //ucfirst = versal som första ?>
        <li class='logoutbutton'><a href="includes/logout.inc.php">
                <button style='width: auto; margin: 1rem;'>Logga ut</button>
            </a></li>
    </div>
</div>
<div id="id03" class="modal">
  <span onclick="document.getElementById('id03').style.display='none'"
        class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate" action="includes/update.php" method="post">
        <div class="imgcontainer">
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
        </div>

        <?php echo "<div class='container'>
            <label for='cuser'><b>Change Username</b>
                <input type='text' placeholder='Enter New Username' name='cuser' value='". htmlspecialchars($_SESSION["userUid"]) ."'></label>

            <label for='cemail'><b>Change Email</b>
                <input type='text' placeholder='Enter New Email' name='cemail' value='". htmlspecialchars($_SESSION["userEmail"]) ."'></label>

            <label for='cpassword'><b>Change Password</b>
                <input type='password' placeholder='Enter New Password' name='cpassword'></label>

            <label for='cpasswordconf'><b>Repeat Change Password</b>
                <input type='password' placeholder='Enter New Password' name='cpasswordconf'></label>

            <label for='cpasswordold'><b>Old Password</b>
                <input type='password' placeholder='Enter Old Password' name='cpasswordold' required></label>

            <button type='submit' name='submit'>Change</button>
        </div>"?>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>
