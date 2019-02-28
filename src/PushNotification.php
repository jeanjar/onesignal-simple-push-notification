<?php

namespace JeanJar\OneSignal;

/**
 * Class PushNotification
 *
 * @package App\OneSignal
 * @property string $app_id
 * @property string $rest_api_key
 * @property string $body
 * @property string|null $subject
 * @property array|null $filters
 * @property array|null $players_id
 * @property array|null $data
 * @property array|null $segments
 * @property string|null $json_data
 */
class PushNotification
{
    public function __construct(string $app_id, string $rest_api_key)
    {
        $this->app_id = $app_id;
        $this->rest_api_key = $rest_api_key;
        $this->filters = [];
        $this->segments = [];
        $this->players_id = [];
    }

    public function setBody(string $body = ''): self
    {
        $this->body = $body;

        return $this;
    }

    public function setSubtitle(string $subject = ''): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function setFilter(array $filter): self
    {
        $this->filters[] = $filter;

        return $this;
    }

    public function setPlayersId($player_id): self
    {
        $this->players_id = array_merge($this->players_id, (array)$player_id);

        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = array_merge($this->data, $data);

        return $this;
    }

    public function setSegments($segment): self
    {
        $this->segments = array_merge($this->segments, (array)$segment);

        return $this;
    }

    public function prepare(): self
    {
        $array_data = [
            'app_id' => $this->app_id,
            'contents' => [
                'en' => $this->body,
            ],
        ];

        if (!empty($this->filters)) {
            $array_data['filters'] = $this->filters;
        }

        if (!empty($this->players_id)) {
            $array_data['include_player_ids'] = $this->players_id;
        }

        if (!empty($this->segments)) {
            $array_data['included_segments'] = $this->segments;
        }

        $this->json_data = \json_encode($array_data);

        return $this;
    }

    public function send()
    {
        $curlOptions = [
            CURLOPT_URL => 'https://onesignal.com/api/v1/notifications',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic ' . $this->rest_api_key,
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->json_data,
            CURLOPT_SSL_VERIFYPEER => false,
        ];
        $ch = curl_init();
        curl_setopt_array($ch, $curlOptions);

        $response = curl_exec($ch);
        curl_reset($ch);
        curl_close($ch);

        return $response;
    }
}