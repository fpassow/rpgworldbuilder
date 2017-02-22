<?php
require('init.php');

if ($method != 'GET') {
    echo "Expected GET.";
    exit;
}

if (!$isloggedin) {
    $message = 'Must be logged in.';
    require('status401.php');
    exit;
}
$importto = reqGET('importto');
$importfrom = tryGET('importfrom'); #might not be chosen yet
if (!$importfrom) {
    require('import_view.php'); # Choose the campaign to import 
    exit;
}
$to = $model->getCampaignByID($importto);
$from = $model->getCampaignByID($importfrom);

if (!$to) {
    $message = 'Campagin id '.$_GET['importto'].' not found.';
    require('status400.php');
    exit;
}
if ($to->username != $username) {
    $message = 'Destingation campaign belongs to a different user.';
    require('status403.php');
    exit;
}
if (!$from) {
    $message = 'Campagin id '.$_GET['importfrom'].' not found.';
    require('status400.php');
    exit;
}

# Don't change the title.
# Add imported simple field's text to the end of the destination field.
# Add imported array items to the destination array. But don't create duplicates.
foreach ($model->getDef()->fields as $field) {
    $name = $field->name;
    if ($field->isarrayfield) {
        foreach ($from->$name as $val) {
            if (!in_array($val, $to->$name)) {
                $temp = $to->$name;
                $temp[] = $val;
                $to->$name = $temp;
            }
        }
    } else {
        if ($name != 'title') {
            if ($from->$name) {
                if ($to->$name) {
                    $to->$name = $to->$name.' '.$from->$name;
                } else {
                    $to->$name = $from->$name;
                }
            }
        }
    }
}

$user->updateCampaign($to);
$model->storeUser($user);

header('Location: campaign.php?id='.$to->id, true, 303);
