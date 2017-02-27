<?php
require('init.php');

# Create blank object
$campaign = new Campaign($user->username); 
$camps = $user->campaigns;
$camps[] = $campaign;
$user->campaigns = $camps;
$model->storeUser($user);  

header('Location: campaign.php?id='.$campaign->id, true, 303);
