<div id="nav">
    <a href="home.php">Home</a>
    <?php
        if (isset($_SESSION['isloggedin']) and $_SESSION['isloggedin']) {
            echo '<a href="mycampaigns.php">My Campaigns</a> ';
            echo '<a href="newcampaign.php">New Campaign</a> <a href="logout.php">Logout</a> ';
            echo 'Logged in as '.$_SESSION['username'].'.';
        
        } else {
            echo '<a href="login.php">Login</a> <a href="newuser.php">New User</a>';
        }
    ?>
</div>