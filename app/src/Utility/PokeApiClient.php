<?php


namespace App\Utility;


class PokeApiClient
{
    /**
     * @var string
     */
    private const BASE_URL = 'https://pokeapi.co/api/v2/';

    /**
     * @param $url
     * @return mixed
     * @throws \JsonException
     */
    private function sendRequest($url): mixed
    {
        $ch = curl_init();

        $timeout = 5;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($http_code !== 200) {
            // return http code and error message
            return [
                'code' => $http_code,
                'message' => $data,
            ];
        }

        return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \JsonException
     */
    public function pokemon(int $id): mixed
    {
        $url = self::BASE_URL . 'pokemon/' . $id;
        return $this->sendRequest($url);
    }
}