<?php
require('init.php');

if ($isloggedin) {
    require('mycampaigns_view.php');
} else {
    header('Location: login.php', true, 303);
}

