<?php

return [
    'api_key' => [
        'value' => config('integrations.smsru.token'),
        'type' => 'text',
        'required' => true,
        'description' => 'Токен'
    ],
    'type' => [
        'value' => config('integrations.smsru.type', 'sms'),
        'type' => 'select',
        'values' => \Modules\SMSRU\App\Enums\Types::asSelectArray(),
        'required' => true,
        'description' => 'Выберите тип работы'
    ]
];
