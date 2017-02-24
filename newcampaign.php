<?php
require('init.php');

# Create blank object
$campaign = new Campaign($user->username);
$user->campaigns[] = $campaign;
$model->storeUser($user);  

header('Location: campaign.php?id='.$campaign->id, true, 303);
