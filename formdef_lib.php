<?php

# JSON format:
#
# FORM_DEF = {
#     name:
#     label:
#     description:
#     fields: [FIELD, FIELD...]
# }
# 
# FIELD = {
#     name:
#     label:
#     description:
#     isarrayfield: true|false
#     hints: [HINT, HINT,...]
# }
# 
# HINT = {
#     label
#     description:
# }
#     

$json = file_get_contents('lists/campaign_form_def.json');
#var_dump($json);
$def = json_decode($json);
var_dump($def);