<?php if (isset($_GET["success"]) && (isset($_SESSION["newName"]))) {
    if ($_GET["success"] == "add") {
        $shareChange = true;
        $display = "Successfully added " . $_SESSION["newName"] . " to your friend list!";
        $color = "#4BB543";
    } elseif ($_GET["success"] == "remove") {
        $shareChange = true;
        $display = "Successfully removed " . $_SESSION["newName"] . " from your friend list!";
        $color = "red";
    } else {
        $shareChange = false;
    }
} else {
    $shareChange = false;
}
?>
    <div class='topdiv'>
        <a class='homebutton' href='#'><h2 class='logotext1'>ChatNShop</h2></a>
        <?php echo "<div class='userandbutton'><li class='name'><a class='user' onclick=\"selectModal('id03', 'block')\">" . htmlspecialchars($_SESSION["userUid"]) . "</a></li>"; //ucfirst = versal som första ?>
        <li class='logoutbutton'><a href="includes/logout.inc.php">
                <button style='width: auto; margin: 1rem;'>Logga ut</button>
            </a></li>
    </div>
<?php if ($shareChange): ?>
    <div class="modal-error" onclick="hideThis()">
        <p id="sharechange" style="color: <?php echo $color ?>"><?php echo $display ?></p>
    </div>
    <script>
        // Display the error message
    </script>
<?php endif; ?>
    <div class="logout" id="logOut" style="display: none;">
        <button class="logoutbutton" onclick="selectModal('id03', 'block')"
                style="width: auto; margin: 1rem;"><?php echo htmlspecialchars(ucfirst($_SESSION["userUid"])); ?></button>
    </div>
    </div>

    <div id="id03" class="modal">
  <span onclick="document.getElementById('id03').style.display='none'"
        class="close" title="Close Modal">&times;</span>

        <!-- Modal Content -->
        <form class="modal-content animate" action="includes/update.php" method="post" style="margin: 0 auto 15% auto;">
            <div class="imgcontainer">
                <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.kindpng.com%2Fpicc%2Fm%2F105-1055656_account-user-profile-avatar-avatar-user-profile-icon.png&f=1&nofb=1&ipt=528008f54e4233c5ce784493c61c6c5c0345f840d0a4fda2c7d5005d79f87564&ipo=images"
                     alt="Avatar" class="avatar">
            </div>

            <?php echo "<div class='container'>
            <label for='cuser'><b>Change Username</b>
                <input type='text' placeholder='Enter New Username' name='cuser' value='" . htmlspecialchars($_SESSION["userUid"]) . "'></label>

            <label for='cemail'><b>Change Email</b>
                <input type='text' placeholder='Enter New Email' name='cemail' value='" . htmlspecialchars($_SESSION["userEmail"]) . "'></label>

            <label for='cpassword'><b>Change Password</b>
                <input type='password' placeholder='Enter New Password' name='cpassword' value=''></label>

            <label for='cpasswordconf'><b>Repeat Change Password</b>
                <input type='password' placeholder='Enter New Password' name='cpasswordconf' value=''></label>
                
            <label for='sharelist'><b>Add or Remove Users</b>
                <input type='text' placeholder='Enter the users email you want to share with, or remove' name='sharelist' value=''</label>         
            <label for='cpasswordold'><b>Old Password</b>
                <input type='password' placeholder='Enter Old Password' name='cpasswordold' required></label>
            <button type='submit' name='submit' onclick='return confirmAction()'>Change</button>        </div>" ?>

            <div class="container">
                <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">
                    Cancel
                </button>
            </div>
        </form>

        <?php if ($displayErrorupdate): ?>
            <div class="modal-error" onclick="hideThis()">
                <p id="error-message-register"><?php echo $display ?></p>
            </div>
            <script>
                // Display the error message and keep the form open
                window.onload = function () {
                    //document.getElementById('error-message-register').style.display = 'block';
                    selectModal('id03', 'block');
                };
            </script>
        <?php endif; ?>
    </div>
<?php
include_once 'content.php';
?>