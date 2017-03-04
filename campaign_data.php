<?php
require('init.php');

if ($method === 'POST') {
    echo "Expected GET.";
    exit;
}

$id = reqGET('id');
$campaign = $model->getCampaignByID($id);
if ($campaign) {
    echo json_encode($campaign);
} else {
    $message = 'Campagin id '.$id.' not found.';
    require('status404.php');
    exit;
}
