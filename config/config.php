<?php

return [
    'api_key' => [
        'value' => Settings::get('integrations.smsru.api_key'),
        'type' => 'text',
        'required' => true,
        'description' => 'Токен'
    ],
    'type' => [
        'value' => Settings::get('integrations.smsru.type', 'sms'),
        'type' => 'select',
        'values' => \Modules\SMSRU\App\Enums\Types::asSelectArray(),
        'required' => true,
        'description' => 'Выберите тип работы'
    ]
];
