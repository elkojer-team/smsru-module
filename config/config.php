<?php

return [
    'api_key' => custom_env('integrations.smsru.token'),
    'type' => custom_env('integrations.smsru.type', 'sms')
];
