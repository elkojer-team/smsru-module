<?php

namespace Modules\SMSRU\Services;

use GuzzleHttp\Client;

class SmsruService
{
    protected $client;
    protected $apiKey;
    protected $url = 'https://sms.ru/';
    protected $type = 'sms'

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('smsru.api_key');
        $this->type = config('smsru.type');

        $this->checkAuth();
    }


    /**
 * Проверка данных через SMSRU.
 *
 * @return array Результат проверки.
    */
    public function checkAuth(): array
    {
        $url = $this->url . 'auth/check';
        $params = [
            'api_id' => $this->apiKey,
            'json' => 1,
        ];

        try {
            $response = $this->client->get($url, ['query' => $params]);
            $body = json_decode($response->getBody(), true);
            return $body;
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'error' => $e->getMessage(),
            ];
        }
    }

   /**
     * Универсальная функция для отправки SMS или звонка через SMSRU.
     *
     * @param string $to Номер телефона получателя.
     * @param string|null $message Сообщение для отправки (только для SMS).
     * @return array Результат отправки.
     */
    public function send(string $to, string $message = null, string $ip = null): array
    {
        // Общие параметры
        $params = [
            'api_id' => $this->apiKey,
            'json' => 1,
        ];

        // Определение URL и уникальных параметров в зависимости от типа
        switch ($this->type) {
            case 'sms':
                $url = $this->url . 'sms/send';
                $params['to'] = $to;
                $params['msg'] = $message;
                break;

            case 'call':
                $url = $this->url . 'code/call';
                if ($ip === null) {
                    return [
                        'status' => 'error',
                        'error' => 'IP address is required for calls.',
                    ];
                }
                $params['phone'] = $to;
                $params['ip'] = $ip;
                break;

            default:
                return [
                    'status' => 'error',
                    'error' => 'Unsupported message type: ' . $this->type,
                ];
        }

        // Выполнение запроса
        try {
            $response = $this->client->post($url, ['form_params' => $params]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'error' => $e->getMessage(),
            ];
        }
    }
}
