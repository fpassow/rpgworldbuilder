<?php
require('init.php');

# Campaign state is POSTed as a JSON object.
# Store it on this User, iff it's legal and correct to do so.

if ($method != 'POST') {
    echo "Expected POST.";
    exit;
}

$campaign_data = json_decode(file_get_contents('php://input'));

$id = $campaign_data->id;
$campaign = $model->getCampaignByID($id);

if ($campaign) {
    if ($campaign->username != $username) {
        http_response_code(403);
        exit;
    }
} else {
    http_response_code(404);
    exit;
}
$campaign->campaign_data = $campaign_data
$user = $model->getUser($username);
$user->updateCampaign($campaign);
$model->storeUser($user);

