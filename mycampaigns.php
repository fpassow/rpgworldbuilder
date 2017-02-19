<?php
require_once('init.php');

if (!$isloggedin) {
    require('login.php');
    exit;
}
require('mycampaigns_view.php');
