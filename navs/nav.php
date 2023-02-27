<nav class="nav">
        <?php
        if (isset($_SESSION["userUid"])) {  //checking if there is a user logged in
            include_once 'navloggedin.php';
        }
        else {
            include_once 'notloggedin.php';
        }
            ?>
    <!--
    <div class="navdiv">
        <a href="">
            <div><p>1</p></div>
        </a>
        <a href="">
            <div><p>2</p></div>
        </a>
        <a href="">
            <div><p>3</p></div>
        </a>
        <a href="">
            <div><p>4</p></div>
        </a>
    </div>
    -->
</nav>
<div class="sidebar" id="sideBar" style="height: 0; display: none;"></div>